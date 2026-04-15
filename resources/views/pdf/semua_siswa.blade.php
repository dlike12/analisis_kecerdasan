<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Semua Siswa</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.4;
            margin: 2cm 2.5cm;
            background: white;
            font-size: 10pt;
        }
        .header {
            position: relative;
            margin-bottom: 20px;
            border-bottom: 2px solid #2ecc71;
            padding-bottom: 12px;
            min-height: 70px;
        }
        .logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 70px;
            height: auto;
        }
        .title-section {
            text-align: center;
            margin-left: 80px;
        }
        .title-section h1 {
            color: #2ecc71;
            font-size: 14pt;
            margin: 0;
            font-weight: bold;
        }
        .title-section p {
            color: #666;
            font-size: 9pt;
            margin-top: 4px;
        }
        .summary {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 12px 20px;
            margin: 20px 0;
            text-align: center;
        }
        .summary-item {
            margin: 4px 0;
            font-size: 10pt;
        }
        .summary-item strong {
            color: #2ecc71;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th {
            background: #eef2ff;
            color: #1e293b;
            padding: 6px 8px;
            text-align: left;
            font-size: 9pt;
            font-weight: bold;
            border-bottom: 1px solid #cbd5e1;
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
            margin-top: 30px;
            padding-top: 8px;
            border-top: 1px solid #e2e8f0;
            font-size: 7pt;
            color: #94a3b8;
        }
        @page { margin: 2cm 2.5cm; size: A4 landscape; }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo_sekolah.png') }}" class="logo" alt="Logo">
        <div class="title-section">
            <h1>LAPORAN HASIL ANALISIS KECERDASAN JAMAK</h1>
            <p>Semua Siswa - Multiple Intelligences Test Report</p>
            <p>Tanggal Cetak: {{ date('d F Y H:i:s') }}</p>
        </div>
    </div>

    <div class="summary">
        <div class="summary-item">
            <strong>RINGKASAN TOTAL</strong>
        </div>
        <div class="summary-item">
            <strong>Total Siswa:</strong> {{ $totalSiswa }} &nbsp;|&nbsp;
            <strong>Sudah Tes:</strong> {{ $totalSudah }} &nbsp;|&nbsp;
            <strong>Belum Tes:</strong> {{ $totalBelum }}
        </div>
        <div class="summary-item">
            <strong>Cluster 1 (Perlu Pendampingan):</strong> {{ $cluster1 }} &nbsp;
            <strong>Cluster 2 (Berkembang):</strong> {{ $cluster2 }} &nbsp;
            <strong>Cluster 3 (Optimal):</strong> {{ $cluster3 }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>JK</th>
                <th>Kelas</th>
                <th>Tipe Kecerdasan</th>
                <th>Cluster</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $d)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $d['nik'] }}</td>
                <td>{{ $d['nama'] }}</td>
                <td>{{ $d['jk'] }}</td>
                <td>{{ $d['kelas'] }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $d['tipe_kecerdasan'])) }}</td>
                <td>
                    @if($d['cluster'] == 1)
                        <span class="cluster-badge cluster-1">Cluster 1 - Perlu Pendampingan</span>
                    @elseif($d['cluster'] == 2)
                        <span class="cluster-badge cluster-2">Cluster 2 - Berkembang</span>
                    @elseif($d['cluster'] == 3)
                        <span class="cluster-badge cluster-3">Cluster 3 - Optimal</span>
                    @else
                        <span class="cluster-badge">Belum Tes</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Laporan dihasilkan oleh Sistem Analisis Kecerdasan Jamak<br>
        Menggunakan Algoritma K-Means Clustering | © 2026
    </div>
</body>
</html>
