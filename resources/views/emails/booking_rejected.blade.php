<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Penolakan Booking</title>
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
            display: flex;
            align-items: center;
        }
        .kop img {
            height: 50px;
        }
        .kop .info {
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
            color: #c0392b;
        }
        .content {
            line-height: 1.6;
        }
    </style>
</head>
<body>

    <div class="kop">
        <img src="https://i.imgur.com/FNBL1Ck.png" alt="Logo Bitmaker"> {{-- Ganti jika punya logo resmi --}}
        <div class="info">
            <h1>PT BIT MAKER AUTOMATION</h1>
            <p>Ruko Grand Galaxy City Blok RSN 3 No.50 Bekasi - Jawa Barat 17147</p>
            <p>Telp: 021-827 321 42 | Email: info@bitmaker-automation.com</p>
            <p>Website: www.bitmaker-automation.com</p>
        </div>
    </div>

    <p style="text-align: right;">Bekasi, {{ date('d F Y') }}</p>

    <h2>Penolakan Booking</h2>

    <div class="content">
        <p>Halo <strong>{{ $booking->user->name ?? $booking->nama }}</strong>,</p>

        <p>Mohon maaf, permintaan booking Anda dengan rincian berikut telah 
           <span style="color: red;"><strong>DITOLAK</strong></span>:</p>

        <ul>
            <li><strong>Nama Kendaraan:</strong> {{ $booking->kendaraan->nama_kendaraan }}</li>
            <li><strong>Jenis Kendaraan:</strong> {{ $booking->kendaraan->jenis }}</li>
        </ul>

        <p>Apabila Anda memiliki pertanyaan lebih lanjut atau ingin melakukan permintaan ulang, 
           silakan hubungi admin kami.</p>

        <br><br>
        <p>Hormat Kami,</p>
        <p><strong>PT BIT MAKER AUTOMATION</strong></p>
        <br><br>
        <p><em>(TTD & Cap Perusahaan)</em></p>
    </div>

</body>
</html>
