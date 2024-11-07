<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory RDS</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body class="bg-white overflow-x-hidden overflow-y-hidden flex items-center justify-center h-screen">
    <img src="{{ asset('assets/v1.svg') }}" alt="img" class="w-[700px] h-[400px] absolute left-0 bottom-0">
    <img src="{{ asset('assets/v2.svg') }}" alt="img" class="w-[700px] h-[400px] absolute right-0 top-0">
    <div class="rounded-[20px] bg-white pt-7 w-[370px] h-[608px] absolute my-[12px] left-[565px] right[525px] shadow-[0_0_15px_rgba(175,175,175.5)]">
        <div class="ml-[145px] text-gray-500">
            <img src="{{ asset('assets/Logo_RDS.svg') }}" alt="RDS GROUP" class="w-[75px] h-[65px]">
            <p class="absolute font-normal text-2xl -mt-[7px] -ml-[7px]">I
                <p class="pl-1.5 font-normal text-md -ml-1.5 tracking-wide">NVENTORY</p>
            </p>
            <p class="mt-[15px] text-black font-semibold text-md -ml-2">Daftar Akun</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="-mt-1">
            @csrf
            <!-- Name -->
            <input type="text" id="name" name="name" placeholder="Nama" required class="p-[10px] ps-5 text-sm placeholder:text-sm placeholder:text-gray-500 ml-[40px] mt-[40px] border border-black rounded-[5px] w-[290px] hover:bg-gray-200" value="{{ old('name') }}" autofocus>
            @error('name')
                <span class="text-red-500 text-xs ml-[40px]">{{ $message }}</span>
            @enderror

<!-- Email Address -->
<input type="email" id="email" name="email" placeholder="Email" required 
       class="p-[10px] ps-5 text-sm placeholder:text-sm placeholder:text-gray-500 ml-[40px] mt-[20px] border border-black rounded-[5px] w-[290px] hover:bg-gray-200" 
       value="{{ old('email') }}" autocomplete="email">
@error('email')
    <span class="text-red-500 text-xs ml-[40px]">{{ $message }}</span>
@enderror

<!-- Password -->
<input type="password" id="password" name="password" placeholder="Kata Sandi" required 
       class="p-[10px] ps-5 text-sm placeholder:text-sm placeholder:text-gray-500 ml-[40px] mt-[20px] border border-black rounded-[5px] w-[290px] hover:bg-gray-200" 
       autocomplete="new-password">
@error('password')
    <span class="text-red-500 text-xs ml-[40px]">{{ $message }}</span>
@enderror



            <!-- Confirm Password -->
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required class="p-[10px] ps-5 text-sm placeholder:text-sm placeholder:text-gray-500 ml-[40px] mt-[20px] border border-black rounded-[5px] w-[290px] hover:bg-gray-200">
            @error('password_confirmation')
                <span class="text-red-500 text-xs ml-[40px]">{{ $message }}</span>
            @enderror

            <div class="mt-[24px] tracking-wide flex items-center font-thin">
                <input type="checkbox" id="agreement" class="ml-[40px] mr-[8px] mt-[2px] w-3 h-3 rounded" required>
                <label for="agreement" class="font-normal text-xs">
                    Setujui dengan 
                    <span class="text-blue-700">ketentuan</span> dan 
                    <span class="text-blue-700">layanan privasi</span>
                </label>
            </div>

            <button type="submit" class="w-[290px] ml-[40px] mt-[15px] bg-blue-800 text-white p-3 rounded-[5px] hover:bg-blue-600">
                Daftar
            </button>
        </form>

        <p class="mt-[24px] ml-20 text-xs font-medium">Sudah memiliki akun? 
            <a href="{{ route('login') }}" class="text-blue-700">Masuk sekarang</a>
        </p>
    </div>

    <footer class="bg-white p-4 mt-[800px]"></footer>
</body>
</html>
