@props(['kendaraans', 'activeBookings'])

<div class="container py-8">
    <h2 class="text-3xl font-semibold mb-6 text-white-800">Katalog Kendaraan</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($kendaraans as $item)
            @php
                $active = $activeBookings[$item->id] ?? null;
                $isMine = $active && $active->user_id === auth()->id();
            @endphp

            <div class="rounded-lg overflow-hidden shadow-lg bg-white relative">
                {{-- Label jika milik sendiri --}}
                @if($isMine)
                    <div class="absolute top-2 right-2 bg-yellow-400 text-black text-xs px-2 py-1 rounded">Dipakai oleh Anda</div>
                @endif

                {{-- Foto kendaraan --}}
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

                    {{-- Status --}}
                    <p class="font-semibold mb-1 
    @if ($active && $active->status === 'pending') text-yellow-600
    @elseif ($active) text-red-600
    @elseif ($item->status === 'tersedia') text-green-600
    @elseif ($item->status === 'tidak tersedia') text-red-600
    @elseif ($item->status === 'rusak') text-yellow-600
    @else text-gray-600
    @endif
">
    @if ($active && $active->status === 'pending')
        Menunggu Approval
    @elseif ($active)
        Sedang Digunakan
    @elseif ($item->status === 'tersedia')
        Tersedia
    @elseif ($item->status === 'tidak tersedia')
        Tidak Tersedia
    @elseif ($item->status === 'rusak')
        Rusak
    @else
        Status Tidak Diketahui
    @endif
</p>


                    {{-- Info pengguna aktif --}}
                    @if ($active)
                        <p class="text-sm text-gray-500 mb-2">
                            Digunakan oleh: <span class="font-semibold">
                                {{ $active->user->nama ?? 'User tidak dikenal' }}
                            </span>
                        </p>
                    @endif

                    {{-- Tombol Aksi --}}
            @if ($active)
                {{-- Kendaraan sedang digunakan (oleh siapa pun) --}}
                <a href="{{ route('user.booking.detail', ['kendaraan' => $item->id]) }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Detail
                </a>
            @else
                {{-- Kendaraan tersedia --}}
                <a href="{{ route('user.booking.create', ['id' => $item->id]) }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Booking
                </a>
            @endif
    </div>
</div>
@empty
            <p class="text-center text-gray-500">Tidak ada kendaraan yang tersedia.</p>
        @endforelse
    </div>
</div>
