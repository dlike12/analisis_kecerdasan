<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Kelas {{ $kelas }}</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.3;
            margin: 2cm 2.5cm;
            background: white;
            font-size: 10pt;
        }
        .header {
            position: relative;
            margin-bottom: 20px;
            border-bottom: 2px solid #2ecc71;
            padding-bottom: 12px;
            min-height: 80px;
        }
        .logo-container { position: absolute; left: 20px; top: 0; width: 100px; }
        .logo { width: 95px; height: auto; }
        .title-section { text-align: center; margin-left: 120px; }
        .title-section h1 { color: #2ecc71; font-size: 14pt; margin:0; font-weight: bold; }
        .title-section .subtitle { color: #666; font-size: 10pt; margin-top: 4px; }
        .title-section .date { color: #999; font-size: 8pt; margin-top: 5px; }

        .ringkasan {
            background: #f0fdf4;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #2ecc71;
        }
        .ringkasan p {
            margin: 5px 0;
            font-size: 10pt;
        }
        .ringkasan strong {
            color: #1e8449;
        }
        .cluster-box {
            display: inline-block;
            margin-right: 20px;
            margin-top: 8px;
        }
        .table-container {
            margin: 20px 0;
        }
        .table-title {
            font-size: 11pt;
            font-weight: bold;
            color: #1e8449;
            border-left: 3px solid #2ecc71;
            padding-left: 8px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background: #2ecc71;
            color: white;
            padding: 6px 8px;
            text-align: left;
            font-size: 9pt;
            font-weight: bold;
        }
        td {
            padding: 5px 8px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 9pt;
        }
        .cluster-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 8pt;
            font-weight: bold;
        }
        .cluster-1 { background: #fef3c7; color: #92400e; }
        .cluster-2 { background: #dbeafe; color: #1e40af; }
        .cluster-3 { background: #d1fae5; color: #065f46; }
        .footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 8px;
            border-top: 1px solid #e5e7eb;
            font-size: 7pt;
            color: #9ca3af;
        }
        @page { margin: 2cm 2.5cm; size: A4 landscape; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <img src="{{ public_path('images/logo_sekolah.png') }}" class="logo" alt="Logo">
        </div>
        <div class="title-section">
            <h1>LAPORAN HASIL ANALISIS KECERDASAN JAMAK</h1>
            <div class="subtitle">Kelas {{ $kelas }} | Multiple Intelligences Test Report</div>
            <div class="date">Tanggal Cetak: {{ date('d F Y H:i:s') }}</div>
        </div>
    </div>

    <!-- Ringkasan Total -->
    <div class="ringkasan">
        <p><strong>RINGKASAN TOTAL</strong></p>
        <p>Total Siswa: {{ $statistik['total'] }} &nbsp;|&nbsp; Sudah Tes: {{ $statistik['sudah_tes'] }} &nbsp;|&nbsp; Belum Tes: {{ $statistik['total'] - $statistik['sudah_tes'] }}</p>
        <div>
            <span class="cluster-box">Cluster 1 (Perlu Pendampingan): {{ $statistik['cluster1'] }}</span>
            <span class="cluster-box">Cluster 2 (Berkembang): {{ $statistik['cluster2'] }}</span>
            <span class="cluster-box">Cluster 3 (Optimal): {{ $statistik['cluster3'] }}</span>
        </div>
    </div>

    <!-- Tabel hasil tes -->
    <div class="table-container">
        <div class="table-title"> Daftar Hasil Tes Siswa</div>
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">NIK</th>
                    <th width="20%">Nama</th>
                    <th width="10%">JK</th>
                    <th width="25%">Tipe Kecerdasan</th>
                    <th width="15%">Cluster</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $d)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $d['nik'] }}</td>
                    <td>{{ $d['nama'] }}</td>
                    <td>{{ $d['jk'] }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $d['tipe_kecerdasan'])) }}</td>
                    <td>
                        @php $c = $d['cluster']; @endphp
                        <span class="cluster-badge cluster-{{ $c }}">
                            @if($c == 1) Cluster 1
                            @elseif($c == 2) Cluster 2
                            @else Cluster 3 @endif
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        Laporan dihasilkan oleh Sistem Analisis Kecerdasan Jamak<br>
        Menggunakan Algoritma K-Means Clustering | © 2026 - Multiple Intelligences Test
    </div>
</body>
</html>
