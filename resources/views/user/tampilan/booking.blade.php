@extends('layouts.app')

@section('title', 'Dashboard User')

@section('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Dashboard CSS -->
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

<head>
<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

@section('content')

    <div id="booking">
        <x-katalog-kendaraan :kendaraans="$kendaraans" :activeBookings="$activeBookings" />
        
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
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
</div>

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

@endsection

@section('scripts')
<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection

