<!DOCTYPE html>
<html>
<head>
    <style>
        body   { font-family: sans-serif; font-size: 12px; }
        table  { width: 100%; border-collapse: collapse; }
        th,td  { border: 1px solid #333; padding: 6px; text-align: center; }
        th     { background: #2f4f6f; color: #fff; }
        h3     { text-align: center; margin-bottom: 12px; }
    </style>
</head>
<body>

<h3>Laporan Booking – Admin</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Tanggal</th>
            <th>Kendaraan</th>
            <th>Nama Peminjam</th>
            <th>Tujuan</th>
            <th>KM Pergi / Pulang</th>
            <th>Jam Pergi – Pulang</th>
            <th>Kondisi Body Pergi</th>
            <th>Kondisi Body Pulang</th>
            <th>Kondisi Dalam Pergi</th>
            <th>Kondisi Dalam Pulang</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->user->name ?? '-' }}</td>
            <td>{{ $row->tanggal }}</td>
            <td>{{ $row->kendaraan->nama ?? '-' }}</td>
            <td>{{ $row->nama_peminjam }}</td>
            <td>{{ $row->tujuan }}</td>
            <td>{{ $row->km_pergi }} / {{ $row->km_pulang }}</td>
            <td>{{ $row->jam_pergi }} – {{ $row->jam_pulang }}</td>
            <td>{{ $row->kondisi_body_pergi }}</td>
            <td>{{ $row->kondisi_body_pulang }}</td>
            <td>{{ $row->kondisi_dalam_pergi }}</td>
            <td>{{ $row->kondisi_dalam_pulang }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
