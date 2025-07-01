@extends('layouts.admin')

@section('title', 'Admin - Karyawan')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        table {
            border-collapse: separate;
            border-spacing: 0;
        }

        thead th {
            background: radial-gradient(ellipse at right, rgb(230, 138, 0, 0.884) 0%, rgba(230, 138, 0, 0.884) 70%);
            color: #333;
            border-bottom: 2px solid #ccc;
        }

        tbody tr:hover {
            background-color: #f1faff;
            transition: background 0.3s ease;
        }

        tbody td {
            border-bottom: 1px solid #ffb23e;
        }

        tbody td img {
            transition: transform 0.2s ease;
        }

        tbody td img:hover {
            transform: scale(1.05);
        }

        .aksi-link {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
        }

        .aksi-link:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .aksi-link i {
            transition: transform 0.2s ease-in-out;
        }

        .aksi-link:hover i {
            transform: scale(1.1);
        }
    </style>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4 border-b pb-4">
        <div class="flex items-center gap-2">
            <i class="fas fa-car text-2xl text-white-600"></i>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Karyawan</h2>
        </div>
        <a href="{{ route('admin.karyawan.create') }}"
            class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg shadow hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-2">
                <i class="fas fa-plus"></i> Tambah Karyawan
            </a>
    </div>

   @if (session('success'))
        <div class="bg-green-50 text-green-700 px-4 py-3 rounded-lg border border-green-200 mb-4 flex items-center gap-2">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="bg-gradient-to-r from-orange-400 to-orange-600 text-white">
                <tr>
                    <th class="px-5 py-3 font-semibold">Nama</th>
                    <th class="px-5 py-3 font-semibold">Jabatan</th>
                    <th class="px-5 py-3 font-semibold">Email</th>
                    <th class="px-5 py-3 font-semibold">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($karyawans as $karyawan)
                    <tr class="odd:bg-white even:bg-orange-50 hover:bg-orange-100 transition">
                        <td class="px-5 py-4">{{ $karyawan->nama }}</td>
                        <td class="px-5 py-4 font-medium">{{ $karyawan->jabatan }}</td>
                        <td class="px-5 py-4">{{ $karyawan->email }}</td>
                        <td class="px-5 py-4 flex flex-wrap gap-2">
                            <a href="{{ route('admin.karyawan.detail', $karyawan->id) }}" class="aksi-link text-blue-600">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            <a href="{{ route('admin.karyawan.edit', $karyawan->id) }}" class="aksi-link text-yellow-600">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.karyawan.destroy', $karyawan->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');">
                                @csrf @method('DELETE')
                                <button class="aksi-link text-red-600">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-5 text-center text-gray-500 italic">Data kendaraan belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection