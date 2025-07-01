<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Persetujuan Booking</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 40px;
            color: #333;
        }
        .kop {
            border-bottom: 3px solid #e74c3c;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .kop img {
            height: 50px;
            vertical-align: middle;
        }
        .kop .info {
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px;
        }
        .kop .info h1 {
            margin: 0;
            font-size: 20px;
            color: #e74c3c;
        }
        .kop .info p {
            margin: 0;
            font-size: 12px;
        }
        h2 {
            color: #2c3e50;
        }
        .content {
            line-height: 1.6;
        }

        /* Tambahan style */
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
    <div class="kop">
        <div class="info">
            <img src="https://media-exp1.licdn.com/dms/image/C560BAQH5Dr4RKAjOIg/company-logo_200_200/0/1622080084199?e=2147483647&v=beta&t=SMUjOz7bz-Uw89pmlqiJW-LarMqZkCfC1l2DzCy8UAY" alt="Logo Bitmaker"> 
            <h1>PT BIT MAKER AUTOMATION</h1>
            <p>Ruko Grand Galaxy City Blok RSN 3 No.50 Bekasi - Jawa Barat 17147</p>
            <p>Telp: 021-827 321 42 | Email: info@bitmaker-automation.com</p>
            <p>Website: www.bitmaker-automation.com</p>
        </div>
    </div>

    <p style="text-align: right;">Bekasi, {{ date('d F Y') }}</p>

    <h2>Booking Diperbarui</h2>

    <div class="content">
        <h2>Hai {{ $booking->user->name }},</h2>

        <p>
            Kami ingin memberitahu bahwa kendaraan yang Anda booking sebelumnya adalah 
            <span class="old-vehicle">{{ $booking->kendaraan->jenis }}</span>.
        </p>

        <p>
            Namun karena kondisi kendaraan yang tidak memungkinkan (rusak atau lainnya), 
            admin telah menggantinya dengan 
            <span class="new-vehicle">{{ $booking->kendaraanPengganti->jenis }}</span>.
        </p>

        <p>Silakan hubungi kami jika ada pertanyaan lebih lanjut. Terima kasih.</p>
        
        <p>Status booking Anda saat ini: <strong>{{ strtoupper($booking->status) }}</strong>.</p>

        <p>Terima kasih atas kepercayaannya kepada PT Bit Maker Automation.</p>

        <br><br>
        <p>Hormat Kami,</p>
        <p><strong>PT BIT MAKER AUTOMATION</strong></p>
        <br><br>
        <p><em>(TTD & Cap Perusahaan)</em></p>
    </div>
</body>
</html>
