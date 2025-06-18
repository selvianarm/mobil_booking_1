<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Booking Ditolak</title>
</head>
<body>
    <h2>Hai, {{ $booking->user->name }}</h2>
    <p>Mohon maaf, permintaan booking Anda dengan rincian berikut telah <strong>ditolak</strong>:</p>
    <ul>
        <li>Kendaraan: {{ $booking->kendaraan->nama_kendaraan }}</li>
        <p>Halo {{ $booking->user->name }},</p>
        <p>Booking Anda untuk kendaraan <strong>{{ $booking->kendaraan->jenis }}</strong> telah disetujui.</p>
        <p>Silakan datang sesuai jadwal.</p>
    </ul>
    <p>Silakan hubungi admin jika ada pertanyaan lebih lanjut.</p>
</body>
</html>
