@props(['kendaraans', 'activeBookings'])

<div class="container py-8">
    <h2 class="text-3xl font-semibold mb-6 text-white-800">Katalog Kendaraan</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($kendaraans as $item)
            <div class="rounded-lg overflow-hidden shadow-lg bg-white">
                @if ($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->jenis }}"
                         class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex justify-center items-center text-gray-500">
                        No Image
                    </div>
                @endif

                <div class="p-4 text-center">
                    <h3 class="font-bold text-xl mb-2">{{ $item->jenis }}</h3>
                    <p class="text-green-700 font-semibold mb-4">Tersedia</p>
                    <a href="{{ route('booking.create', ['id' => $item->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Booking</a>
                    @if(isset($activeBookings[$item->id]))
                        {{-- <a href="{{ route('booking.return', $activeBookings[$item->id]->id) }}" class="btn btn-warning btn-sm">Form Pengembalian</a> --}}
                    @endif
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">Belum ada data kendaraan.</p>
        @endforelse
    </div>
</div>
