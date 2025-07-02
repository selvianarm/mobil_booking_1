@extends('layouts.app')

@section('title', 'Dashboard User')

@section('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>   
    .container {
        margin: 80px auto 0 auto; /* Atas 80px, kiri-kanan auto, bawah 0 */
        width: 100%;
        max-width: 1300px; /* Atau sesuai kebutuhan */
        padding: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
.car-stats {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 2rem; /* lebih longgar */
  margin-top: 2rem;
  z-index: 2;
}

.stat {
  background: #fff;
  border: 1px solid #ffe0cc;
  box-shadow: 0 8px 20px rgba(255, 102, 0, 0.1);
  color: #333;
  padding: 2rem 2.5rem; /* lebih besar */
  border-radius: 20px;
  text-align: center;
  min-width: 150px;
  backdrop-filter: blur(6px);
  transition: transform 0.3s ease;
}
.stat:hover {
  transform: scale(1.05); /* efek interaktif */
}

.stat-value {
  font-size: 2.2rem; /* angka lebih besar */
  font-weight: 800;
  color: #ff6600;
}

.stat-label {
  font-size: 1rem; /* label lebih besar */
  color: #b84900a1;
  margin-top: 0.5rem;
}


        /* Tablet */
        @media (max-width: 768px) {
        .car-stats {
        display: grid;               /* Ganti dari flex ke grid */
        grid-template-columns: 1fr 1fr; /* 2 kolom */
        gap: 1rem 1rem;              /* jarak antar baris dan kolom */
        padding: 0 1rem;
        justify-items: center;      /* posisi konten di tengah */
    }
    .car-stats .stat {
        width: 100%;              /* ➜ isi penuh container */
        max-width: 350px;         /* ➜ biar tidak terlalu lebar */
    }

        .stat-value {
            font-size: 1.8rem;
        }

        .stat-label {
            font-size: 0.85rem;
        }
        }

        /* HP kecil */
        @media (max-width: 480px) {
        .car-stats {
            flex-direction: column;
            align-items: center;
            overflow-x: unset;
            scroll-snap-type: none;
        }

        .stat {
            width: 100%;
            max-width: none;
        }

        .stat-value {
            font-size: 1.6rem;
        }

        .stat-label {
            font-size: 0.8rem;
        }
        }

    </style>

@endsection

@section('content')

    <div class="container">
        <div class="car-stats">
            <div class="stat"><div class="stat-value" id="stat1">{{ $availableCars  }}</div><div class="stat-label">Mobil Tersedia</div></div>
            <div class="stat"><div class="stat-value" id="stat2">{{ $activeBookingCount  }}</div><div class="stat-label">Booking Aktif</div></div>
            <div class="stat"><div class="stat-value" id="stat3">{{ $totalTrips  }}</div><div class="stat-label">Total Perjalanan</div></div>
            <div class="stat"><div class="stat-value" id="stat3">{{ $pendingApprovals  }}</div><div class="stat-label">Menunggu Approval</div></div>
        </div>
        <x-katalog-kendaraan :kendaraans="$kendaraans" :activeBookings="$activeBookings" />
    
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
    
        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div id="booking">
    </div>

        
    {{-- SweetAlert Popups --}}
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Booking Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if(session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Kembali'
            });
        </script>
    @endif

    {{-- <script>
        const models = [
          { name: 'MODEL S', number: '01', description: 'Premium Sedan', stats: ['412mi', '149mph', '3.1sec'], image: 'https://digitalassets.tesla.com/tesla-contents/image/upload/f_auto,q_auto/Model-S-Main-Hero-Desktop-LHD.png' },
          { name: 'MODEL 3', number: '02', description: 'Compact Sedan', stats: ['358mi', '140mph', '5.3sec'], image: 'https://digitalassets.tesla.com/tesla-contents/image/upload/f_auto,q_auto/Model-3-Main-Hero-Desktop-LHD.png' },
          { name: 'MODEL X', number: '03', description: 'Premium SUV', stats: ['348mi', '149mph', '3.8sec'], image: 'https://digitalassets.tesla.com/tesla-contents/image/upload/f_auto,q_auto/Model-X-Main-Hero-Desktop-LHD.png' },
          { name: 'MODEL Y', number: '04', description: 'Compact SUV', stats: ['326mi', '135mph', '4.8sec'], image: 'https://digitalassets.tesla.com/tesla-contents/image/upload/f_auto,q_auto/Model-Y-Main-Hero-Desktop-LHD.png' },
          { name: 'CYBERTRUCK', number: '05', description: 'Electric Pickup', stats: ['340mi', '112mph', '6.5sec'], image: 'https://digitalassets.tesla.com/tesla-contents/image/upload/f_auto,q_auto/Cybertruck-Main-Hero-Desktop-Global.png' },
          { name: 'ROADSTER', number: '06', description: 'Sports Car', stats: ['620mi', '250mph', '1.9sec'], image: 'https://digitalassets.tesla.com/tesla-contents/image/upload/f_auto,q_auto/Roadster-Main-Hero-Desktop-Global.png' },
          { name: 'SEMI', number: '07', description: 'Electric Truck', stats: ['300mi', '65mph', '20sec'], image: 'https://digitalassets.tesla.com/tesla-contents/image/upload/f_auto,q_auto/Semi-Main-Hero-Desktop-Global.png' },
        ];
    
        let current = 0;
        function updateModel() {
          const model = models[current];
          document.getElementById('modelName').textContent = model.name;
          document.getElementById('modelNumber').textContent = model.number;
          document.getElementById('modelDescription').textContent = model.description;
          document.getElementById('carImage').src = model.image;
          document.getElementById('stat1').textContent = model.stats[0];
          document.getElementById('stat2').textContent = model.stats[1];
          document.getElementById('stat3').textContent = model.stats[2];
        }
        function nextModel() {
          current = (current + 1) % models.length;
          updateModel();
        }
        function prevModel() {
          current = (current - 1 + models.length) % models.length;
          updateModel();
        }
        window.onload = updateModel;
    </script> --}}

@endsection

@section('scripts')
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
