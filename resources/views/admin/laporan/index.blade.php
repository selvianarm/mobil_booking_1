@php 
use Illuminate\Support\Facades\Storage;
@endphp
@extends('layouts.admin')

@section('title', 'Admin - Laporan')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!-- DataTables Styling -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.tailwindcss.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">


<style>
       
    .dataTables_wrapper .dataTables_filter {
        display:flex;
        order: 0 !important;
        justify-content:flex-start;
        margin-bottom: 1rem;
        gap: 1rem; 
        align-items: center
    }

    .dataTables_wrapper .dataTables_paginate {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem;
    background-color: #f9f9f9;
    border-radius: 1rem;
    }
    .dataTables_wrapper .dataTables_filter label {
    margin-right: 0.5rem; /* Tambahan opsional jika ingin lebih jauh */
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #d1d5db; /* gray-300 */
        border-radius: 0.5rem;
        padding: 0.25rem 0.75rem;
        width: 250px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
    margin: 0 0.25rem;
    border-radius: 0.375rem;
    border: 1px solid #d1d5db;
    background-color: #f9fafb;
    color: #374151;
    font-size: 0.875rem;
    font-weight: 500;

    transition: all 0.3s ease;
}
.dataTables_wrapper .dt-buttons  {   /* kotak “Search”  */
    order: 1 !important;  
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: #e0f2fe;
    border-color: #38bdf8;
    color: #0ea5e9;
}


.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: #3b82f6;
    color: white !important;
    border-color: #2563eb;
}

.dataTables_wrapper .dataTables_length{
    display: block !important;
    order: 2 !important;
    margin-left: auto;
}

.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_paginate select {
    padding: 0.4rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    background: #ffffff;
    font-size: 0.875rem;
}
/* Style khusus tombol Next/Previous */
.dataTables_wrapper .dataTables_paginate .paginate_button.previous,
.dataTables_wrapper .dataTables_paginate .paginate_button.next {
    padding: 0.5rem 1rem;
    background-color: #e0e7ff; /* indigo-100 */
    border-radius: 9999px; /* full rounded */
    color: #4338ca; /* indigo-700 */
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    font-weight: 600;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.previous:hover,
.dataTables_wrapper .dataTables_paginate .paginate_button.next:hover {
    background-color: #c7d2fe; /* indigo-200 */
    transform: translateY(-2px);
    cursor: pointer;
}


/* Info ("Page 1 of 24") */
.dataTables_wrapper .dataTables_info {
    font-size: 0.875rem;
    color: #4b5563;
}

table img {
    display: block;
    max-width: 100%;
    height: auto;
    margin: auto;
    border-radius: 0.25rem;
}


div.dataTables_wrapper div.dataTables_paginate {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 1.5rem;
            padding: 1rem;
            background-color: #f3f4f6;
            border-radius: 1rem;
        }

        div.dataTables_wrapper .dataTables_info {
            margin-top: 1rem;
            text-align: center;
            color: #6b7280;
        }
</style>
    @endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
    $(document).ready(function () {
        
        $('#laporanTable').DataTable({
            responsive: true,
            pageLength: 10,
            dom: '<"w-full flex flex-col sm:flex-row items-center gap-4 mb-4" fB l>' +
                 'rt' +
                 '<"w-full flex flex-col sm:flex-row justify-between items-center mt-4" ip>',
            buttons: [
                {
                    extend: 'copy',
                    text: 'Copy',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'all'
                        },
                        format: {
                            body: function (data, row, column, node) {
                                return formatExportContent(data, node);
                            }
                        }
                    },
                    className: 'bg-gray-200 text-black  px-4 py-1 rounded text-sm shadow mr-2 mb-2'
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'all'
                        },
                        format: {
                            body: function (data, row, column, node) {
                                return formatExportContent(data, node);
                            }
                        }
                    },
                    className: 'bg-green-500 text-white px-4 py-1 rounded text-sm shadow mr-2 mb-2'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    orientation: 'landscape',
                    pageSize: 'A1',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'all'
                        },
                        format: {
                            body: function (data, row, column, node) {
                                return formatExportContent(data, node);
                            }
                        }
                    },
                    className: 'bg-red-500 text-white px-4 py-1 rounded text-sm shadow mr-2 mb-2'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'all'
                        },
                        format: {
                            body: function (data, row, column, node) {
                                return formatExportContent(data, node);
                            }
                        }
                    },
                    className: 'bg-blue-500 text-white px-4 py-1 rounded text-sm shadow mb-2'
                }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
                paginate: {
                    previous: '<i class="fas fa-chevron-left text-blue-600"></i>',
                    next: '<i class="fas fa-chevron-right text-blue-600"></i>'
                }
            }
        });

        function formatExportContent(data, node) {
            let img = $(node).find('img');
            if (img.length) {
                return img.attr('src'); // ini akan export URL gambar, bukan tampilkan gambar langsung
            }
            return $(node).text(); // fallback jika bukan gambar
        }
        // Dapatkan instance DataTable
var table = $('#laporanTable').DataTable();

// Filter berdasarkan bulan dari tanggal di kolom ke-2
$('#filterBulan').on('change', function () {
    var selectedMonth = $(this).val();

    table.rows().every(function () {
        var tanggal = this.data()[2]; // Kolom ke-2 = Tanggal
        var showRow = true;

        if (selectedMonth) {
            // Ambil nilai bulan dari tanggal, misalnya "2024-09-20"
            var match = tanggal.match(/(\d{4})-(\d{2})-(\d{2})/);
            if (match) {
                var bulan = match[2]; // "09"
                showRow = bulan === selectedMonth;
            } else {
                showRow = false;
            }
        }

        if (showRow) {
            $(this.node()).show();
        } else {
            $(this.node()).hide();
        }
    });
});
const bulanFilter = document.getElementById('bulanFilter');
    const bulanHiddenInput = document.getElementById('bulanHiddenInput');

    bulanFilter.addEventListener('change', function () {
        bulanHiddenInput.value = this.value;
    });

    });
</script>

@endsection

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 text-gray-800">
    <div class="mb-6 flex items-center gap-2 text-blue-900">
        <i class="fas fa-file-alt text-xl"></i>
        <h2 class="text-2xl font-semibold">Laporan Booking Kendaraan</h2>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 border border-green-300">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-white p-4 rounded-lg shadow-lg overflow-x-auto">
        <div class="mb-4 flex flex-wrap gap-4 items-center justify-between">
            <div class="flex items-center gap-2">
                <label for="filterBulan" class="text-sm text-gray-700">Filter Bulan:</label>
                <select id="filterBulan" class="border border-gray-300 rounded px-2 py-1 text-sm">
                    <option value="">Semua</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>


                <form id="downloadPdfForm" method="GET" action="{{ route('admin.laporan.download') }}" target="_blank">
                    <input type="hidden" name="bulan" id="bulanHiddenInput">
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm shadow hover:bg-red-600">
                        <i class="fas fa-file-pdf mr-1"></i> Download PDF Bulan Ini
                    </button>
                </form>
            </div>
        </div>
        
       
        

        <table id="laporanTable" class="min-w-full text-sm text-gray-800">
            <thead class="bg-blue-50 text-blue-800 uppercase text-xs font-semibold border-b">
                <tr>
                    <th class="px-3 py-3">No</th>
                    <th class="px-3 py-3">Nama Karyawan</th>
                    <th class="px-3 py-3">Tgl/Jam Pergi</th>
                    <th class="px-3 py-3">Tgl/Jam Pulang</th>
                    <th class="px-3 py-3">Mobil Awal</th>
                    <th class="px-3 py-3">Mobil Pengganti</th>
                    <th class="px-3 py-3">Nama Peminjam</th>
                    <th class="px-3 py-3">Tujuan</th>
                    <th class="px-3 py-3">KM Pergi/Pulang</th>
                    <th class="px-3 py-3">Kondisi Body Pergi</th>
                    <th class="px-3 py-3">Kondisi Body Pulang</th>
                    <th class="px-3 py-3">Kondisi Dalam Pergi</th>
                    <th class="px-3 py-3">Kondisi Dalam Pulang</th>
                    <th class="px-3 py-3">Bensin Pergi</th>
                    <th class="px-3 py-3">Bensin Pulang</th>
                    <th class="px-3 py-3">Status</th>
                    <th class="px-3 py-3">Catatan Admin</th>
                    <th class="px-3 py-3">Detail</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $booking)
                    <tr class="border-b hover:bg-gray-50 transition duration-150">
                        <td class="px-3 py-2">{{ ($laporan->currentPage() - 1) * $laporan->perPage() + $loop->iteration }}</td>
                        <td class="px-3 py-2">{{ $booking->user->nama ?? '-' }}</td>
                        <td class="px-3 py-2">
                            {{ $booking->tanggal }}<br>
                            <small class="text-gray-500">{{ $booking->jam_pergi ?? '-' }}</small>
                        </td>
                        <td class="px-3 py-2">
                            {{ $booking->tanggal }}<br>
                            <small class="text-gray-500">{{ $booking->jam_pulang ?? '-' }}</small>
                        </td>
                        <td class="px-3 py-2">{{ $booking->kendaraan->jenis ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $booking->kendaraanPengganti->jenis ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $booking->nama ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $booking->tujuan }}</td>
                        <td class="px-3 py-2">{{ $booking->km_pergi ?? '-' }} / {{ $booking->km_pulang ?? '-' }}</td>
                        
                        <td class="px-3 py-2">
                            @if ($booking->kondisi_body_pergi)
                                <img src="{{ Storage::url($booking->kondisi_body_pergi) }}" class="w-12 h-12 object-cover">
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td class="px-3 py-2">
                            @if ($booking->kondisi_body_pulang)
                                <img src="{{ Storage::url($booking->kondisi_body_pulang) }}" class="w-12 h-12 object-cover">
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td class="px-3 py-2">
                            @if ($booking->kondisi_dalam_pergi)
                                <img src="{{ Storage::url($booking->kondisi_dalam_pergi) }}" class="w-12 h-12 object-cover">
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td class="px-3 py-2">
                            @if ($booking->kondisi_dalam_pulang)
                                <img src="{{ Storage::url($booking->kondisi_dalam_pulang) }}" class="w-12 h-12 object-cover">
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td class="px-3 py-2">
                            @if ($booking->bensin_pergi)
                                <img src="{{ Storage::url($booking->bensin_pergi) }}" class="w-12 h-12 object-cover">
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td class="px-3 py-2">
                            @if ($booking->bensin_pulang)
                                <img src="{{ Storage::url($booking->bensin_pulang) }}" class="w-12 h-12 object-cover">
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <span class="inline-block px-2 py-1 rounded text-white
                                @if($booking->status == 'pending') bg-yellow-500
                                @elseif($booking->status == 'approved') bg-green-600
                                @elseif($booking->status == 'rejected') bg-red-600
                                @elseif($booking->status == 'selesai') bg-blue-600
                                @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="px-3 py-2">{{ $booking->catatan_admin }}</td>
                        <td class="px-3 py-2 text-center">
                            <a href="{{ route('admin.laporan.show', $booking->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium mr-2">
                                <i class="fas fa-eye"></i> Detail
                            </a>  
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="18" class="text-center py-4 text-gray-500">Data laporan tidak tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

