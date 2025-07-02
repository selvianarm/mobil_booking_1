<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-image: url('/images/latar.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen font-['Inter']">

    {{-- Header --}}
    <header class="flex justify-between items-center bg-white/80 backdrop-blur-sm px-4 py-2 shadow-md">
        <img src="/images/logo.png" alt="Logo" class="h-12">
        <a href="{{ route('register') }}" class="bg-orange-500 text-white text-xs px-4 py-2 rounded hover:bg-orange-800 transition">
            Register
        </a>
    </header>

    {{-- Sign In Form --}}
    <main class="flex flex-1 justify-center items-center px-4">
        <div class="bg-white/70 backdrop-blur-md p-8 sm:p-10 rounded-2xl shadow-lg w-full max-w-md">
            <h1 class="text-3xl font-bold text-orange-500 text-center mb-6">Login</h1>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-orange-400 focus:outline-none">
                    @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-orange-400 focus:outline-none">
                    @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember" class="text-sm text-gray-700">Remember me</label>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-800 text-white font-semibold py-3 rounded-md shadow transition">
                    Sign In
                </button>
            </form>

            {{-- Links --}}
            <div class="mt-6 flex justify-between text-sm text-gray-600">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="hover:underline">Forgot Password?</a>
                @endif
                <a href="{{ route('register') }}" class="hover:underline">Sign Up</a>
            </div>
        </div>
    </main>
</body>
</html>
