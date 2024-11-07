<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="output.css">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?    family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body class="bg-[rgb(230,230,230)] overflow-x-hidden overflow-y-hidden h-screen">
        <header class="bg-white w-screen h-[120px] left-0 top-0 right-0 shadow-md shadow-gray-200 flex">
            <div class="flex items-center justify-center pt-[26px] font-normal text-gray-500 pb-[50px] w-[280px] left-0">
                <img src="{{ asset('assets/Logo_RDS.svg') }}" alt="Logo_RDS" class="w-[74px] h-[44px]">
                <p class="text-2xl -mt-[6px] ml-[6px]">I</p>
                <p class="text-md tracking-wide">NVENTORY</p> 
            </div>
            

            <a href="{{ url('admin/history') }}" class="absolute left-[1220px] top-[40px] flex items-center">
                <img src="{{ asset('assets/histori.svg') }}" alt="history" class="w-[20px] h-[20px]">
                <p class="ml-[20px]">Histori</p>
            </a>

            <!-- Settings Dropdown -->
        <div class="hidden sm:flex sm:items-center sm:ms-6 absolute right-[100px] top-[35px]">
            <button id="dropdownButton" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                <div>{{ Auth::user()->name }}</div>
                <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>

            <!-- Dropdown Menu -->
            <div id="dropdownMenu" class="absolute right-0 z-10 hidden mt-2 w-48 bg-white rounded-md shadow-lg top-[35px]">
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="dropdownButton">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">{{ __('Profile') }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <script>
        // JavaScript to toggle dropdown
        document.getElementById('dropdownButton').addEventListener('click', function() {
            var dropdown = document.getElementById('dropdownMenu');
            dropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        window.addEventListener('click', function(event) {
            var dropdown = document.getElementById('dropdownMenu');
            var button = document.getElementById('dropdownButton');
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

            
    <div id="sidebar" class="absolute bg-white w-[280px] h-screen top-0 bottom-0 left-0 tracking-tight">
        <div class="flex items-center justify-center mt-[26px] font-normal text-gray-500 mb-[50px]">
            <img src="{{ asset('assets/Logo_RDS.svg') }}" alt="Logo_RDS" class="w-[74px] h-[44px]">
            <p class="text-2xl -mt-[6px] ml-[6px] text-gray-400">I</p>
            <p class="text-md tracking-wide">NVENTORY</p>
        </div>
        <div class="shadow-[10_10_0px_rgba(200,200,200.5)]"> 
            <p class="ml-[53px] mb-[30px] font-medium text-[rgb(18,18,18)] text-xl">Menu</p>
            <div class="grid grid-rows-4 grid-flow-col gap-0 items-center font-normal text-lg cursor-pointer">
                <div class="flex bg-blue-800 py-[19px] pl-[50px]">
                    <img src="{{ asset('assets/home.svg') }}" alt="home" class="w-[24px] h-[24px]">
                    <p class="text-white pl-[22px] -mt-0.5 tracking-normal">Dashboard</p>
                </div>
                <a href="{{ url('admin/products') }}">
                    <div class="flex py-[19px] pl-[50px] hover:bg-gray-300 duration-300">
                        <img src="{{ asset('assets/file.svg') }}" alt="file" class="w-[24px] h-[24px]">
                        <p class="pl-[22px] -mt-0.5 text-[rgb(18,18,18)]">Gudang</p>
                    </div>
                </a>
                
                <a href="{{ url('admin/listin') }}">
                    <div class="flex py-[19px] pl-[50px] hover:bg-gray-300 duration-300">
                        <img src="{{ asset('assets/right.svg') }}" alt="right arrow" class="w-[24px] h-[24px]">
                        <p class="pl-[22px] -mt-0.5 text-[rgb(18,18,18)]">Barang Masuk</p>
                    </div>
                </a>
                <a href="{{ url('admin/listout') }}">
                    <div class="flex py-[19px] pl-[50px] hover:bg-gray-300 duration-300">
                        <img src="{{ asset('assets/left.svg') }}" alt="left arrow" class="w-[24px] h-[24px]">
                        <p class="pl-[22px] -mt-0.5 text-[rgb(18,18,18)]">Barang Keluar</p>
                    </div>
                </a>
            </div>

        </div>
        <div class="grid grid-rows-2 grid-flow-col gap-[10px] items-center font-normal text-lg cursor-pointer ml-[44px] mt-[250px] pb-[106px]">
            <a href="{{ url('profile') }}" class="text-black">Pengaturan</a>
            <a href="pindah slide.html" class="text-red-500">Keluar</a>
        </div>
        
    </div>

    <div class="absolute top-[187px] left-[357px] text-xl text-[rgb(58,58,58)] font-medium">
        <p>Selamat Datang 👋</p>
        <p class="text-3xl text-[rgb(18,18,18)] mt-[10px]">Admin !</p>

    </div>

    <div class="absolute grid grid-cols-4 grid-flow-row gap-[32px] text-gray-500 font-medium left-[357px] top-[302px]">
        <div class="w-[250px] h-[116px] bg-white rounded-[20px] shadow-[0_0_10px_rgba(200,200,200.5)]">
            <p class="ml-[24.5px] mt-[20px] mb-[8px]">Total Barang</p>
            <p class="ml-[24.5px] text-gray-700 text-4xl font-semibold">{{ $total }}</p>
            <img src="{{ asset('assets/bag.svg') }}" alt="Barang" class="w-[66px] h-[66px] ml-[169.5px] -mt-[69.5px]">
        </div>
        <div class="w-[250px] h-[116px] bg-white rounded-[20px] shadow-[0_0_10px_rgba(200,200,200.5)]">
            <p class="ml-[24.5px] mt-[20px] mb-[8px]">Barang Masuk</p>
            <p class="ml-[24.5px] text-gray-700 text-4xl font-semibold">{{ $totalin }}</p>
            <img src="{{ asset('assets/in.svg') }}" alt="Masuk" class="w-[66px] h-[66px] ml-[169.5px] -mt-[69.5px]">
        </div>
        <div class="w-[250px] h-[116px] bg-white rounded-[20px] shadow-[0_0_10px_rgba(200,200,200.5)]">
            <p class="ml-[24.5px] mt-[20px] mb-[8px]">Barang Keluar</p>
            <p class="ml-[24.5px] text-gray-700 text-4xl font-semibold">{{ $totalout }}</p>
            <img src="{{ asset('assets/out.svg') }}" alt="Keluar" class="w-[66px] h-[66px] ml-[169.5px] -mt-[69.5px]">
        </div>
        <div class="w-[160px] h-[116px] bg-white rounded-[20px] shadow-[0_0_10px_rgba(200,200,200.5)]">
            <div class="flex">
                <p class="ml-[24.5px] mt-[20px] mb-[8px]">{{ $dayName }}</p>
                <p class="ml-[4px] mt-[20px] mb-[8px] text-blue-800">{{ $month }}</p>
            </div>
            <p class="ml-[24.5px] text-gray-700 text-4xl font-semibold">{{ $dayDate }}</p>
        </div>

    </div>
    
</body>
</html>