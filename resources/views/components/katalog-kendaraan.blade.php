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
                    <div class="absolute top-2 right-2 bg-yellow-400 text-black text-xs px-2 py-1 rounded">
                        Dipakai oleh Anda
                    </div>
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

                    @php
    if ($item->status === 'rusak') {
        $katalogStatus = 'Rusak';
        $katalogColor = 'text-yellow-600';
        $buttonText = 'Tidak Tersedia';
        $buttonLink = '#';
        $buttonDisabled = true;
    } elseif ($active && $active->status === 'pending' && $active->user_id === auth()->id()) {
        $katalogStatus = 'Menunggu Approval';
        $katalogColor = 'text-yellow-600';
        $buttonText = 'Detail';
        $buttonLink = route('user.booking.detail', ['kendaraan' => $item->id]);
        $buttonDisabled = false;
    } elseif ($active && $active->status === 'approved') {
        $katalogStatus = 'Sedang Digunakan';
        $katalogColor = 'text-red-600';
        $buttonText = 'Detail';
        $buttonLink = route('user.booking.detail', ['kendaraan' => $item->id]);
        $buttonDisabled = false;
    } else {
        $katalogStatus = 'Tersedia';
        $katalogColor = 'text-green-600';
        $buttonText = 'Booking';
        $buttonLink = route('user.booking.create', ['id' => $item->id]);
        $buttonDisabled = false;
    }
@endphp


<p class="font-semibold mb-1 {{ $katalogColor }}">
    {{ $katalogStatus }}
</p>


                    {{-- Info pengguna aktif --}}
                    @if ($active)
                        <p class="text-sm text-gray-500 mb-2">
                            Digunakan oleh: <span class="font-semibold">
                                {{ $active->user->nama ?? 'User tidak dikenal' }}
                            </span>
                        </p>
                    @endif

                    @if ($buttonDisabled)
    <button class="bg-gray-300 text-gray-600 px-4 py-2 rounded cursor-not-allowed" disabled>
        {{ $buttonText }}
    </button>
@else
    <a href="{{ $buttonLink }}"
       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        {{ $buttonText }}
    </a>
@endif

                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">Tidak ada kendaraan yang tersedia.</p>
        @endforelse
    </div>
</div>
