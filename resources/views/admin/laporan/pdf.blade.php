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
    <h2>Detail Booking</h2>

    <div class="section">
        <p><strong>User:</strong> {{ $laporan->user->nama ?? '-' }}</p>
        <p><strong>No. Telepon:</strong> {{ $laporan->nomor_telepon }}</p>
        <p><strong>Tanggal:</strong> {{ $laporan->tanggal }}</p>
        <p><strong>Jam Pergi:</strong> {{ $laporan->jam_pergi }}</p>
        <p><strong>Jam Pulang:</strong> {{ $laporan->jam_pulang }}</p>
        <p><strong>Tujuan:</strong> {{ $laporan->tujuan }}</p>
    </div>

    <div class="section">
        <p><strong>Kendaraan:</strong> {{ $laporan->kendaraan->jenis ?? '-' }}</p>
        <p><strong>Sopir:</strong> {{ $laporan->sopir->nama ?? '-' }}</p>
    </div>

    <div class="section">
        <p><strong>KM Pergi:</strong> {{ $laporan->km_pergi }}</p>
        <p><strong>KM Pulang:</strong> {{ $laporan->km_pulang }}</p>
        <p><strong>Bensin Pergi:</strong> {{ $laporan->bensin_pergi }}</p>
        <p><strong>Bensin Pulang:</strong> {{ $laporan->bensin_pulang }}</p>
        <p><strong>Kondisi Body Pergi:</strong> {{ $laporan->kondisi_body_pergi }}</p>
        <p><strong>Kondisi Body Pulang:</strong> {{ $laporan->kondisi_body_pulang }}</p>
        <p><strong>Kondisi Dalam Pergi:</strong> {{ $laporan->kondisi_dalam_pergi }}</p>
        <p><strong>Kondisi Dalam Pulang:</strong> {{ $laporan->kondisi_dalam_pulang }}</p>
    </div>
</body>
</html>