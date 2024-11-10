<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f0f0f0] overflow-x-hidden overflow-y-hidden flex items-center justify-center max-h-screen">
    <img src="{{ asset('assets/v1.svg') }}" alt="img" class="w-[700px] h-[400px] absolute left-0 bottom-0">
    <img src="{{ asset('assets/v2.svg') }}" alt="img" class="w-[700px] h-[400px] absolute right-0 top-0">
    
    <div class="rounded-[20px] bg-white pt-7 w-[370px] h-[480px] absolute my-[12px] left-[565px] right[525px] shadow-[0_0_15px_rgba(175,175,175,0.5)]">
        <div class="ml-[145px] text-gray-500">
            <img src="{{ asset('assets/Logo_RDS.svg') }}" alt="RDS GROUP" class="w-[75px] h-[65px]">
            <p class="absolute font-normal text-2xl -mt-[7px] -ml-[7px]">I
                <p class="pl-1.5 font-normal text-md -ml-1.5 tracking-wide">NVENTORY</p>
            </p>
            <p class="mt-[15px] text-black font-bold text-md -ml-[-10px]">Masuk</p>
        </div>

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}" class="-mt-1">
            @csrf
            <!-- Email Input -->
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required
                class="p-[10px] ps-5 text-sm placeholder:text-sm placeholder:text-gray-500 ml-[40px] mt-[40px] border border-black rounded-[5px] w-[290px] hover:bg-gray-200">
            @if ($errors->has('email'))
                <div class="text-red-600 ml-[40px] mt-2 text-sm">{{ $errors->first('email') }}</div>
            @endif

            <!-- Password Input -->
            <input type="password" name="password" placeholder="Kata Sandi" required
                class="p-[10px] ps-5 text-sm placeholder:text-sm placeholder:text-gray-500 ml-[40px] mt-[20px] border border-black rounded-[5px] w-[290px] hover:bg-gray-200">
                <br>
            @if ($errors->has('password'))
                <div class="text-red-600 ml-[40px] mt-[20px] text-sm">{{ $errors->first('password') }}</div>
            @endif

            <!-- Forgot Password Link -->
            <p class="ml-[40px] mt-[20px]">
                <a href="{{ route('password.request') }}" class="text-blue-700">Lupa sandi?</a>
            </p>
                
            <!-- Submit Button -->
            <button type="submit" class="w-[290px] ml-[40px] mt-[20px] bg-blue-800 text-white p-3 rounded-[5px] hover:bg-blue-600">
                Masuk
            </button>
        </form>

        <!-- Register Link -->
        <p class="mt-[20px] ml-20 text-xs font-medium">Belum memiliki akun? 
            <a href="{{ route('register') }}" class="text-blue-700">Daftar sekarang</a>
        </p>
    </div>

    <footer class="bg-white p-4 mt-[800px]"></footer>
</body>
</html>
