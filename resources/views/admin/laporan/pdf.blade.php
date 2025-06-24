<!DOCTYPE html>
<html>
<head>
    <title>PDF Detail Booking</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        .section { margin-bottom: 20px; }
        p { margin: 4px 0; }
    </style>
</head>
<body>
    <table style="width: 100%; border-bottom: 2px solid #000; margin-bottom: 20px;">
        <tr>
            <td style="width: 20%;">
                <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="height: 50px;">
            </td>
            <td style="width: 80%; text-align: left;">
                <h3 style="margin: 0; color: #e60000;">PT BIT MAKER AUTOMATION</h3>
                <p style="margin: 2px 0; font-size: 10px;">
                    Ruko Grand Galaxy City Blok RSN 3 No.50 Bekasi – Jawa Barat 17147<br>
                    ☎ 021-827 321 42 &nbsp;&nbsp;&nbsp; ✉ info@bitmaker-automation.com<br>
                    🌐 www.bitmaker-automation.com
                </p>
            </td>
        </tr>
    </table>
    
    <h2>Detail Booking</h2>

    <div class="section">
        <p><strong>Nama Karyawan:</strong> {{ $laporan->user->nama ?? '-' }}</p>
        <p><strong>Nama Peminjam:</strong> {{ $laporan->nama ?? '-' }}</p>
        <p><strong>No. Telepon:</strong> {{ $laporan->nomor_telepon }}</p>
        <p><strong>Tanggal:</strong> {{ $laporan->tanggal }}</p>
        <p><strong>Jam Pergi:</strong> {{ $laporan->jam_pergi }}</p>
        <p><strong>Jam Pulang:</strong> {{ $laporan->jam_pulang }}</p>
        <p><strong>Tujuan:</strong> {{ $laporan->tujuan }}</p>
    </div>

    <div class="section">
        <p><strong>Kendaraan:</strong> {{ $laporan->kendaraan->jenis ?? '-' }}</p>
    </div>

    <div class="section">
        <p><strong>KM Pergi:</strong> {{ $laporan->km_pergi }}</p>
        <p><strong>KM Pulang:</strong> {{ $laporan->km_pulang }}</p>
    
        {{-- Bensin Pergi & Pulang --}}
<table style="width: 100%; margin-bottom: 10px;">
    <tr>
        <td style="width: 50%; vertical-align: top;">
            @if($laporan->bensin_pergi)
                <p><strong>Bensin Pergi:</strong></p>
                <img src="{{ public_path('storage/' . $laporan->bensin_pergi) }}" style="width: 100%; max-width: 200px;" alt="Bensin Pergi">
            @endif
        </td>
        <td style="width: 50%; vertical-align: top;">
            @if($laporan->bensin_pulang)
                <p><strong>Bensin Pulang:</strong></p>
                <img src="{{ public_path('storage/' . $laporan->bensin_pulang) }}" style="width: 100%; max-width: 200px;" alt="Bensin Pulang">
            @endif
        </td>
    </tr>
</table>

{{-- Body Pergi & Pulang --}}
<table style="width: 100%; margin-bottom: 10px;">
    <tr>
        <td style="width: 50%; vertical-align: top;">
            @if($laporan->kondisi_body_pergi)
                <p><strong>Body Pergi:</strong></p>
                <img src="{{ public_path('storage/' . $laporan->kondisi_body_pergi) }}" style="width: 100%; max-width: 200px;" alt="Body Pergi">
            @endif
        </td>
        <td style="width: 50%; vertical-align: top;">
            @if($laporan->kondisi_body_pulang)
                <p><strong>Body Pulang:</strong></p>
                <img src="{{ public_path('storage/' . $laporan->kondisi_body_pulang) }}" style="width: 100%; max-width: 200px;" alt="Body Pulang">
            @endif
        </td>
    </tr>
</table>

{{-- Dalam Pergi & Pulang --}}
<table style="width: 100%; margin-bottom: 10px;">
    <tr>
        <td style="width: 50%; vertical-align: top;">
            @if($laporan->kondisi_dalam_pergi)
                <p><strong>Dalam Pergi:</strong></p>
                <img src="{{ public_path('storage/' . $laporan->kondisi_dalam_pergi) }}" style="width: 100%; max-width: 200px;" alt="Dalam Pergi">
            @endif
        </td>
        <td style="width: 50%; vertical-align: top;">
            @if($laporan->kondisi_dalam_pulang)
                <p><strong>Dalam Pulang:</strong></p>
                <img src="{{ public_path('storage/' . $laporan->kondisi_dalam_pulang) }}" style="width: 100%; max-width: 200px;" alt="Dalam Pulang">
            @endif
        </td>
    </tr>
</table>

    </div>
    
</body>
</html>
