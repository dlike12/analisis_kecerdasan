<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\HasilAnalisis;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportSingle($id)
    {
        $hasil = HasilAnalisis::with('siswa')->findOrFail($id);
        $skorPerKategori = json_decode($hasil->skor_per_kategori, true);
        $chartImage = $this->generateSpiderChartImage($skorPerKategori);
        $pdf = Pdf::loadView('pdf.hasil', compact('hasil', 'skorPerKategori', 'chartImage'));
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'dpi' => 150,
            'isPhpEnabled' => true,
            'enable_remote' => true,
            'chroot' => public_path(),
        ]);
        return $pdf->download('laporan_hasil_' . $hasil->siswa->nama . '.pdf');
    }

    private function generateSpiderChartImage($skorPerKategori)
    {
        $skor = array_values($skorPerKategori);
        $labels = ['Linguistik', 'Logis-Matematis', 'Visual-Spasial', 'Kinestetik', 'Musikal', 'Interpersonal', 'Intrapersonal', 'Naturalis'];
        $config = [
            'type' => 'radar',
            'data' => [
                'labels' => $labels,
                'datasets' => [[
                    'label' => 'Skor Kecerdasan',
                    'data' => $skor,
                    'backgroundColor' => 'rgba(46, 204, 113, 0.2)',
                    'borderColor' => '#2ecc71',
                    'borderWidth' => 2,
                    'pointBackgroundColor' => '#2ecc71',
                    'pointBorderColor' => '#ffffff',
                    'pointRadius' => 5,
                    'pointHoverRadius' => 7
                ]]
            ],
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => true,
                'scales' => ['r' => ['beginAtZero' => true, 'max' => 100, 'ticks' => ['stepSize' => 20, 'backdropColor' => 'transparent']]],
                'plugins' => ['legend' => ['position' => 'bottom', 'labels' => ['font' => ['size' => 12]]]]
            ]
        ];
        $jsonConfig = json_encode($config);
        $encodedConfig = urlencode($jsonConfig);
        $url = "https://quickchart.io/chart?c={$encodedConfig}&width=500&height=400&devicePixelRatio=2.0&format=png";
        $client = new \GuzzleHttp\Client(['timeout' => 30]);
        try {
            $response = $client->get($url);
            $imageData = base64_encode($response->getBody());
            return 'data:image/png;base64,' . $imageData;
        } catch (\Exception $e) {
            \Log::error('QuickChart error: ' . $e->getMessage());
            return $this->generateFallbackChartHTML($skor, $labels);
        }
    }

    private function generateFallbackChartHTML($skor, $labels)
    {
        $html = '<div style="text-align:center; padding:20px; background:#f9fafb; border-radius:12px;">';
        $html .= '<p style="font-size:14px; font-weight:bold; margin-bottom:15px;">Grafik Kecerdasan (Data Numerik)</p>';
        $html .= '<table style="width:100%; border-collapse:collapse;">';
        $html .= '<thead><tr><th style="border:1px solid #ddd; padding:8px;">Kategori</th><th style="border:1px solid #ddd; padding:8px;">Skor</th></tr></thead><tbody>';
        foreach ($labels as $i => $label) {
            $html .= '<tr><td style="border:1px solid #ddd; padding:8px;">'.$label.'</td><td style="border:1px solid #ddd; padding:8px;">'.$skor[$i].' / 100</td></tr>';
        }
        $html .= '</tbody></table></div>';
        return $html;
    }

    public function exportAllSiswa()
    {
        $siswa = Siswa::with('hasilAnalisis')->get();
        $data = [];
        foreach ($siswa as $s) {
            if ($s->hasilAnalisis) {
                $data[] = [
                    'nama' => $s->nama,
                    'nik' => $s->nik,
                    'kelas' => $s->kelas,
                    'jk' => $s->jenis_kelamin,
                    'umur' => $s->umur,
                    'tipe_kecerdasan' => $s->hasilAnalisis->tipe_kecerdasan_utama,
                    'cluster' => $s->hasilAnalisis->cluster,
                    'tanggal' => $s->hasilAnalisis->tanggal_tes
                ];
            } else {
                $data[] = [
                    'nama' => $s->nama,
                    'nik' => $s->nik,
                    'kelas' => $s->kelas,
                    'jk' => $s->jenis_kelamin,
                    'umur' => $s->umur,
                    'tipe_kecerdasan' => 'Belum Tes',
                    'cluster' => null,
                    'tanggal' => null
                ];
            }
        }

        // Urutkan data berdasarkan kelas (numeric lalu alfabet)
        usort($data, function($a, $b) {
            $numA = (int) preg_replace('/[^0-9]/', '', $a['kelas']);
            $numB = (int) preg_replace('/[^0-9]/', '', $b['kelas']);
            if ($numA != $numB) return $numA - $numB;
            return strcmp($a['kelas'], $b['kelas']);
        });

        $totalSiswa = count($data);
        $totalSudah = count(array_filter($data, fn($d) => $d['tipe_kecerdasan'] != 'Belum Tes'));
        $totalBelum = $totalSiswa - $totalSudah;
        $cluster1 = count(array_filter($data, fn($d) => $d['cluster'] == 1));
        $cluster2 = count(array_filter($data, fn($d) => $d['cluster'] == 2));
        $cluster3 = count(array_filter($data, fn($d) => $d['cluster'] == 3));

        $pdf = Pdf::loadView('pdf.semua_siswa', compact('data', 'totalSiswa', 'totalSudah', 'totalBelum', 'cluster1', 'cluster2', 'cluster3'));
        $pdf->setPaper('A4', 'landscape');
        $pdf->setOptions(['isRemoteEnabled' => true, 'dpi' => 150, 'chroot' => public_path()]);
        return $pdf->download('laporan_semua_siswa.pdf');
    }

    public function exportPerKelas(Request $request)
    {
        $kelas = $request->kelas;
        $siswa = Siswa::with('hasilAnalisis')->where('kelas', $kelas)->get();
        $data = [];
        foreach ($siswa as $s) {
            if ($s->hasilAnalisis) {
                $data[] = [
                    'nama' => $s->nama,
                    'nik' => $s->nik,
                    'kelas' => $s->kelas,
                    'jk' => $s->jenis_kelamin,
                    'tipe_kecerdasan' => $s->hasilAnalisis->tipe_kecerdasan_utama,
                    'cluster' => $s->hasilAnalisis->cluster,
                    'tanggal' => $s->hasilAnalisis->tanggal_tes
                ];
            }
        }
        $statistik = [
            'total' => $siswa->count(),
            'sudah_tes' => count($data),
            'cluster1' => collect($data)->where('cluster', 1)->count(),
            'cluster2' => collect($data)->where('cluster', 2)->count(),
            'cluster3' => collect($data)->where('cluster', 3)->count(),
        ];
        $pdf = Pdf::loadView('pdf.laporan_kelas', compact('data', 'kelas', 'statistik'));
        $pdf->setPaper('A4', 'landscape');
        $pdf->setOptions(['isRemoteEnabled' => true, 'chroot' => public_path()]);
        return $pdf->download('laporan_kelas_' . $kelas . '.pdf');
    }

    public function exportLaporanLengkap()
    {
        $siswa = Siswa::with('hasilAnalisis')->get();
        $kelasGroups = $siswa->groupBy('kelas');
        // Urutkan kelas secara natural (7A,7B,8A,...)
        $sortedKelas = $kelasGroups->keys()->sort(function($a, $b) {
            $numA = (int) preg_replace('/[^0-9]/', '', $a);
            $numB = (int) preg_replace('/[^0-9]/', '', $b);
            if ($numA != $numB) return $numA - $numB;
            return strcmp($a, $b);
        });
        $dataPerKelas = [];
        $totalSiswa = $siswa->count();
        $totalSudahTes = 0;
        $totalCluster1 = $totalCluster2 = $totalCluster3 = 0;

        foreach ($sortedKelas as $kelas) {
            $siswaKelas = $kelasGroups[$kelas];
            $dataSiswa = [];
            foreach ($siswaKelas as $s) {
                if ($s->hasilAnalisis) {
                    $dataSiswa[] = [
                        'nama' => $s->nama,
                        'nik' => $s->nik,
                        'jk' => $s->jenis_kelamin,
                        'tipe_kecerdasan' => $s->hasilAnalisis->tipe_kecerdasan_utama,
                        'cluster' => $s->hasilAnalisis->cluster
                    ];
                    $totalSudahTes++;
                    if ($s->hasilAnalisis->cluster == 1) $totalCluster1++;
                    elseif ($s->hasilAnalisis->cluster == 2) $totalCluster2++;
                    else $totalCluster3++;
                } else {
                    $dataSiswa[] = [
                        'nama' => $s->nama,
                        'nik' => $s->nik,
                        'jk' => $s->jenis_kelamin,
                        'tipe_kecerdasan' => 'Belum Tes',
                        'cluster' => null
                    ];
                }
            }
            $dataPerKelas[] = [
                'kelas' => $kelas,
                'siswa' => $dataSiswa,
                'total_siswa' => $siswaKelas->count(),
                'sudah_tes' => $siswaKelas->filter(function($s) { return $s->hasilAnalisis; })->count()
            ];
        }

        $totalBelumTes = $totalSiswa - $totalSudahTes;
        $statistikTotal = [
            'total_siswa' => $totalSiswa,
            'total_sudah_tes' => $totalSudahTes,
            'total_belum_tes' => $totalBelumTes,
            'total_cluster1' => $totalCluster1,
            'total_cluster2' => $totalCluster2,
            'total_cluster3' => $totalCluster3,
        ];

        $pdf = Pdf::loadView('pdf.laporan_lengkap', compact('dataPerKelas', 'statistikTotal'));
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions(['isRemoteEnabled' => true, 'chroot' => public_path()]);
        return $pdf->download('laporan_lengkap.pdf');
    }
}
