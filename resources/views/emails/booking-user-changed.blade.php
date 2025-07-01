<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Informasi Perubahan Booking</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 40px;
            color: #333;
        }
        .old-vehicle {
            color: #c0392b;
            font-weight: bold;
            background-color: #fdecea;
            padding: 2px 6px;
            border-radius: 5px;
        }
        .new-vehicle {
            color: #27ae60;
            font-weight: bold;
            background-color: #eafaf1;
            padding: 2px 6px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <p style="text-align: right;">Bekasi, {{ date('d F Y') }}</p>

    <h2>Halo {{ $booking->user->name }},</h2>

    <p>
        Kami mencatat bahwa Anda sebelumnya telah mengubah kendaraan yang dibooking ke 
        <span class="new-vehicle">{{ $newVehicle->jenis }}</span>.
    </p>

    <p>
        Namun karena kendala teknis, admin kembali mengonfirmasi bahwa kendaraan sebelumnya 
        <span class="old-vehicle">{{ $oldVehicle->jenis }}</span> mengalami masalah, dan sistem menyetujui perubahan ini.
    </p>

    <p>
        Status booking Anda saat ini: <strong>{{ strtoupper($booking->status) }}</strong>.
    </p>

    <p>Terima kasih atas kepercayaannya kepada PT Bit Maker Automation.</p>

    <br><br>
    <p>Hormat Kami,</p>
    <p><strong>PT BIT MAKER AUTOMATION</strong></p>
    <p><em>(TTD & Cap Perusahaan)</em></p>
</body>
</html>
