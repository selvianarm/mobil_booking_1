<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking - Approve</title>
</head>
<body>
    <h2>Booking Disetujui</h2>
    <p>Halo {{ $booking->user->name }},</p>
    <p>Booking Anda untuk kendaraan <strong>{{ $booking->kendaraan->jenis }}</strong> telah disetujui.</p>
    <p>Silakan datang sesuai jadwal.</p>
</body>
</html>