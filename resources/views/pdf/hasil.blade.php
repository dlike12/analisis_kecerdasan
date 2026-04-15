<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Analisis Kecerdasan Jamak</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.4;
            margin: 2cm 3cm;
            background: white;
            font-size: 11pt;
        }
        .header {
            position: relative;
            margin-bottom: 20px;
            border-bottom: 3px solid #2ecc71;
            padding-bottom: 15px;
            min-height: 100px;
        }
        .logo-container { position: absolute; left: 0; top: 0; width: 140px; }
        .logo { width: 130px; height: auto; }
        .title-section { text-align: center; margin-left: 150px; }
        .title-section h1 { color: #2ecc71; font-size: 13pt; margin:0; font-weight: bold; }
        .title-section .subtitle { color: #666; font-size: 11pt; margin-top:4px; }
        .title-section .date { color: #999; font-size: 9pt; margin-top:5px; }
        .info-siswa { background: #f0fdf4; border-radius: 8px; padding: 15px; margin: 15px 0; border-left: 4px solid #2ecc71; }
        .info-siswa h3 { color: #1e8449; font-size: 12pt; margin-bottom: 10px; border-bottom:1px solid #d1fae5; padding-bottom:5px; }
        .info-grid { display: grid; grid-template-columns: repeat(2,1fr); gap: 8px; }
        .info-item { display: flex; align-items: baseline; }
        .info-label { font-weight: bold; color: #1e8449; width: 100px; font-size: 10pt; }
        .info-value { color: #333; font-size: 10pt; }
        .main-card { background: linear-gradient(135deg,#2ecc71,#1e8449); border-radius: 10px; padding: 15px; margin: 15px 0; text-align: center; color: white; }
        .main-card .intelligence { font-size: 15pt; font-weight: bold; margin: 8px 0; }
        .cluster-badge { display: inline-block; padding: 4px 15px; border-radius: 30px; font-size: 10pt; font-weight: bold; }
        .cluster-1 { background:#fbbf24; color:#1e293b; }
        .cluster-2 { background:#3b82f6; color:white; }
        .cluster-3 { background:#22c55e; color:white; }
        .chart-container { margin: 15px 0; text-align: center; }
        .chart-container h3 { color: #1e8449; font-size: 12pt; margin-bottom: 10px; border-left: 4px solid #2ecc71; padding-left: 10px; text-align: left; }
        .chart-box { background: #f9fafb; border-radius: 10px; padding: 10px; display: inline-block; max-width: 100%; }
        .chart-image { max-width: 800px; width: 100%; height: auto; margin: 0 auto; }
        .skor-table { margin: 15px 0; page-break-before: always; }
        .skor-table h3 { color: #1e8449; font-size: 12pt; border-left: 4px solid #2ecc71; padding-left: 10px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th { background: #2ecc71; color: white; padding: 8px; text-align: left; font-size: 10pt; }
        td { padding: 6px 8px; border-bottom: 1px solid #e5e7eb; font-size: 10pt; }
        .skor-value { font-weight: bold; color: #2ecc71; }
        .rekomendasi { margin: 15px 0; }
        .rekomendasi h3 { color: #1e8449; font-size: 12pt; border-left: 4px solid #2ecc71; padding-left: 10px; margin-bottom: 10px; }
        .rekomendasi-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 12px; }
        .rekomendasi-card { background: #f9fafb; border-radius: 8px; padding: 12px; border: 1px solid #e5e7eb; }
        .rekomendasi-card .number { display: inline-block; width: 24px; height: 24px; background: #2ecc71; color: white; border-radius: 50%; text-align: center; line-height: 24px; font-weight: bold; font-size: 10pt; margin-bottom: 8px; }
        .rekomendasi-card h4 { color: #1e8449; font-size: 11pt; margin-bottom: 5px; }
        .rekomendasi-card p { color: #666; font-size: 9pt; line-height: 1.3; }
        .footer { text-align: center; margin-top: 25px; padding-top: 10px; border-top: 1px solid #e5e7eb; font-size: 8pt; color: #999; }
        @page { margin: 2cm 3cm; size: A4; }
        .main-card, .chart-container, .info-siswa { page-break-inside: avoid; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-container"><img src="{{ public_path('images/logo_sekolah.png') }}" class="logo" alt="Logo"></div>
        <div class="title-section">
            <h1>LAPORAN HASIL ANALISIS KECERDASAN JAMAK</h1>
            <div class="subtitle">Multiple Intelligences Test Report</div>
            <div class="date">Tanggal Cetak: {{ date('d F Y H:i:s') }}</div>
        </div>
    </div>

    <div class="info-siswa">
        <h3>DATA SISWA</h3>
        <div class="info-grid">
            <div class="info-item"><span class="info-label">Nama Lengkap</span><span class="info-value">: {{ $hasil->siswa->nama }}</span></div>
            <div class="info-item"><span class="info-label">NIK</span><span class="info-value">: {{ $hasil->siswa->nik }}</span></div>
            <div class="info-item"><span class="info-label">Kelas</span><span class="info-value">: {{ $hasil->siswa->kelas }}</span></div>
            <div class="info-item"><span class="info-label">Jenis Kelamin</span><span class="info-value">: {{ $hasil->siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span></div>
            <div class="info-item"><span class="info-label">Umur</span><span class="info-value">: {{ $hasil->siswa->umur }} tahun</span></div>
            <div class="info-item"><span class="info-label">Tanggal Tes</span><span class="info-value">: {{ date('d F Y', strtotime($hasil->tanggal_tes)) }}</span></div>
        </div>
    </div>

    <div class="main-card">
        <h4>TIPE KECERDASAN UTAMA</h4>
        <div class="intelligence">{{ ucfirst(str_replace('_', ' ', $hasil->tipe_kecerdasan_utama)) }}</div>
        <span class="cluster-badge cluster-{{ $hasil->cluster }}">
            @if($hasil->cluster == 1) Cluster 1 - Perlu Pendampingan
            @elseif($hasil->cluster == 2) Cluster 2 - Berkembang
            @else Cluster 3 - Optimal @endif
        </span>
    </div>

    <div class="chart-container">
        <h3>GRAFIK KECERDASAN JARING</h3>
        <div class="chart-box">
            @if(!empty($chartImage))
                @if(preg_match('/^data:image/', $chartImage))
                    <img src="{{ $chartImage }}" class="chart-image" alt="Grafik Kecerdasan">
                @else
                    {!! $chartImage !!}
                @endif
            @else
                <p>Grafik tidak tersedia</p>
            @endif
        </div>
    </div>

    <div class="skor-table">
        <h3>SKOR PER KATEGORI KECERDASAN</h3>
        <table><thead><tr><th>Kategori</th><th>Skor</th></tr></thead><tbody>
        @foreach($skorPerKategori as $kategori => $skor)
            <tr><td>{{ ucfirst(str_replace('_', ' ', $kategori)) }}</td><td class="skor-value"><strong>{{ $skor }}</strong> / 100</td></tr>
        @endforeach
        </tbody></table>
    </div>

    <div class="rekomendasi">
        <h3>REKOMENDASI AKTIVITAS BELAJAR</h3>
        <div class="rekomendasi-grid">
            @php $rekomendasi = json_decode($hasil->rekomendasi, true); @endphp
            @foreach($rekomendasi as $index => $r)
            <div class="rekomendasi-card">
                <div class="number">{{ $index+1 }}</div>
                <h4>{{ $r['aktivitas'] }}</h4>
                <p>{{ $r['deskripsi'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <div class="footer">
        <p>Laporan dihasilkan oleh Sistem Analisis Kecerdasan Jamak</p>
        <p>Menggunakan Algoritma K-Means Clustering | 2026 - Multiple Intelligences Test</p>
    </div>
</body>
</html>
