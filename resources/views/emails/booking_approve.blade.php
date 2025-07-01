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
    </style>
</head>
<body>
    <div class="kop">{{-- Ganti jika punya logo resmi --}}
        <div class="info">
        <img src="https://media-exp1.licdn.com/dms/image/C560BAQH5Dr4RKAjOIg/company-logo_200_200/0/1622080084199?e=2147483647&v=beta&t=SMUjOz7bz-Uw89pmlqiJW-LarMqZkCfC1l2DzCy8UAY" alt="Logo Bitmaker"> 
            <h1>PT BIT MAKER AUTOMATION</h1>
            <p>Ruko Grand Galaxy City Blok RSN 3 No.50 Bekasi - Jawa Barat 17147</p>
            <p>Telp: 021-827 321 42 | Email: info@bitmaker-automation.com</p>
            <p>Website: www.bitmaker-automation.com</p>
        </div>
    </div>

    <p style="text-align: right;">Bekasi, {{ date('d F Y') }}</p>

    <h2>Persetujuan Booking</h2>

    <div class="content">
        <p>Halo <strong>{{ $booking->nama }}</strong>,</p>

        <p>Dengan ini kami menyampaikan bahwa permohonan booking Anda untuk kendaraan jenis <strong>{{ $booking->kendaraan->jenis }}</strong> ,
            kendaraan pengganti <strong>{{ $booking->kendaraanPengganti->jenis ?? 'Tidak ada' }}</strong> pada tanggal <strong>{{ $booking->tanggal }}</strong>
            telah <span style="color: green;"><strong>DISETUJUI</strong></span>.</p>

        <p>Silakan hadir sesuai jadwal yang telah disepakati.</p>

        <p>Terima kasih atas kepercayaannya kepada PT Bit Maker Automation.</p>

        <br><br>
        <p>Hormat Kami,</p>
        <p><strong>PT BIT MAKER AUTOMATION</strong></p>
        <br><br>
        <p><em>(TTD & Cap Perusahaan)</em></p>
    </div>
</body>
</html>
