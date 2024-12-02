<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="output.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?    family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body class="bg-[rgb(230,230,230)] overflow-x-hidden h-screen">
        <header class="bg-white w-screen h-[120px] left-0 top-0 right-0 flex z-10 fixed">
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
        <div class="hidden sm:flex sm:items-center sm:ms-6 right-[83px] top-[35px] fixed">
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

    <div id="sidebar" class=" bg-white w-[280px] h-screen top-0 bottom-0 left-0 tracking-tight fixed z-[100px]">
        <div class="flex items-center justify-center mt-[26px] font-normal text-gray-500 mb-[50px]">
            <img src="{{ asset('assets/Logo_RDS.svg') }}" alt="Logo_RDS" class="w-[74px] h-[44px]">
            <p class="text-2xl -mt-[6px] ml-[6px] text-gray-400">I</p>
            <p class="text-md tracking-wide">NVENTORY</p>
        </div>
        <div class="shadow-[10_10_0px_rgba(200,200,200.5)] z-10"> 
            <p class="ml-[53px] mb-[30px] font-medium text-[rgb(18,18,18)] text-xl">Menu</p>
            <div class="grid grid-rows-4 grid-flow-col gap-0 items-center font-normal text-lg cursor-pointer">
                <a href="{{ url('admin/dashboard') }}"">
                    <div class="flex py-[19px] pl-[50px] hover:bg-gray-300 duration-300">
                        <img src="{{ asset('assets/homeb.svg') }}" alt="home" class="w-[24px] h-[24px]">
                        <p class="pl-[22px] -mt-0.5 tracking-normal text-[rgb(18,18,18)]">Dashboard</p>
                    </div>
                    </a>
                    <a href="{{ url('admin/products') }}">
                        <div class="flex py-[19px] pl-[50px] bg-blue-800">
                            <img src="{{ asset('assets/filew.svg') }}" alt="file" class="w-[24px] h-[24px]">
                            <p class="text-white pl-[22px] -mt-0.5">Gudang</p>
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
    
    {{-- Isi Konten --}}
    <h1 class="absolute left-[310px] top-[160px] font-bold text-[24px] text-gray-800">Barang Gudang</h1>
    <p class="absolute left-[310px] top-[164px] text-[16px] mt-[36px] text-black">Masuk ke dalam Gudang 🚚</p>

    <form method="GET" action="{{ route('admin/products') }}" class="mb-4">
        <div class="form-group">
            <input 
                type="search" name="search" id="search" placeholder="Cari merk atau seri" value="{{ request('search') }}" class="absolute left-[310px] top-[280px] w-[366px] h-[52px] py-[10px] px-[30px] border-none shadow rounded-[6px] form-control"
            >
        </div>
        
        <button type="submit" class="absolute text-white rounded-[6px] bg-blue-800 font-thin top-[280px] left-[686px] w-[50px] h-[50px] flex items-center justify-center hover:bg-blue-900 transition duration-200">
            <img src="{{ asset('assets/cari.svg') }}" alt="Cari" class="w-6 h-6" />
        </button>
        
    </form>

    <button class="absolute text-white rounded-[6px] bg-blue-800 font-normal top-[280px] left-[1320px] w-[170px] h-[50px] hover:bg-blue-900 transition duration-200 flex items-center justify-center space-x-2">
        <img src="{{ asset('assets/plus.svg') }}" alt="Tambah" class="w-5 h-5" />
        <a href="{{ route('admin/products/create') }}">Tambah Barang</a>
    </button>
    

    <table class="w-[1180px] table-fixed absolute top-[360px] left-[310px] bg-white border border-gray-300 overflow-x-hidden overflow-y-hidden" style="border-collapse: separate; border-spacing: 0; border-radius: 4px;">
        <thead>
            <tr>
                <th class="border-b text-left pl-[20px] border-black pt-[16px] pr-[10px] pb-[16px] font-medium bg-gray-200">Nama Merk</th>
                <th class="border-b text-left pl-[20px] border-black pt-[16px] pr-[10px] pb-[16px] font-medium bg-gray-200">Spesifikasi</th>
                <th class="border-b text-left pl-[20px] border-black pt-[16px] pr-[10px] pb-[16px] font-medium bg-gray-200">Lokasi</th>
                <th class="border-b text-left pl-[20px] border-black pt-[16px] pr-[10px] pb-[16px] font-medium bg-gray-200">No. Seri</th>
                <th class="border-b text-left pl-[20px] border-black pt-[16px] pr-[10px] pb-[16px] font-medium bg-gray-200">Keterangan</th>
                <th class="border-b text-left pl-[20px] border-black pt-[16px] pr-[10px] pb-[16px] font-medium bg-gray-200">Perbarui</th>
                <th class="border-b text-left pl-[20px] border-black pt-[16px] pr-[10px] pb-[16px] font-medium bg-gray-200">Keluar</th>
                <th class="border-b text-left pl-[20px] border-black pt-[16px] pr-[10px] pb-[16px] font-medium bg-gray-200">Status</th>
                <th class="border-b text-left pl-[20px] border-black pt-[16px] pr-[10px] pb-[16px] font-medium bg-gray-200">Lainnya</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $products as $product )
            <tr style="">
                <td class="pl-[20px] pr-[10px] pb-[16px] pt-[16px] border-b border-gray-400 text-xs">{{ $product->merk }}</td>
                <td class="pl-[20px] pr-[10px] pb-[16px] pt-[16px] border-b border-gray-400 text-xs">{{ $product->spek }}</td>
                <td class="pl-[20px] pr-[10px] pb-[16px] pt-[16px] border-b border-gray-400 text-xs">{{ $product->lokasi }}</td>
                <td class="pl-[20px] pr-[10px] pb-[16px] pt-[16px] border-b border-gray-400 text-xs">{{ $product->seri }}</td>
                <td class="pl-[20px] pr-[10px] pb-[16px] pt-[16px] border-b border-gray-400 text-xs">{{ $product->keterangan }}</td>
                <td class="pl-[20px] pr-[10px] pb-[16px] pt-[16px] border-b border-gray-400 text-xs">{{ $product->created_at }}</td>
                <td class="pl-[20px] pr-[10px] pb-[16px] pt-[16px] border-b border-gray-400 text-xs">{{ $product->date_out }}</td>
                <td class="pl-[20px] pr-[10px] pb-[16px] pt-[16px] border-b border-gray-400 text-xs">{{ $product->status }}</td>
                <td class="pl-[20px] pb-[30px] border-b border-gray-400 text-xs">
                    <div x-data="{ isOpen: false, openedWithKeyboard: false }" @keydown.esc.prevent="isOpen = false, openedWithKeyboard = false" class="relative">
                        <!-- Toggle Button -->
                        <button type="button" aria-label="context menu" @click="isOpen = ! isOpen" @keydown.space.prevent="openedWithKeyboard = true" @keydown.enter.prevent="openedWithKeyboard = true" @keydown.down.prevent="openedWithKeyboard = true" class="inline-flex cursor-pointer items-center bg-transparent transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-neutral-800 active:opacity-100 dark:focus-visible:outline-neutral-800 pt-8" :class="isOpen || openedWithKeyboard ? 'text-neutral-900 dark:text-white' : 'text-neutral-600 dark:text-neutral-300'" :aria-expanded="isOpen || openedWithKeyboard" aria-haspopup="true">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" fill="#121212" class="w-8 h-8">
                                <path fill-rule="evenodd" d="M4.5 12a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <!-- Dropdown Menu -->
                        <div 
    x-cloak 
    x-show="isOpen || openedWithKeyboard" 
    x-transition 
    x-trap="openedWithKeyboard" 
    @click.outside="isOpen = false, openedWithKeyboard = false" 
    class="absolute top-7 right-[8px] pr-[16px] pl-[16px] pt-1 pb-1 flex w-auto rounded-[2px] space-x-4 divide-x divide-gray-300 bg-white border shadow-gray-400 shadow-md" 
    role="menu">
                            <!-- Dropdown Items -->
                            <ul class="flex items-center space-x-2" role="none">
                                <a href="{{ route('admin/products/edit', ['id'=>$product->id]) }}">
                                <li class="cursor-pointer p-[1px] rounded-md">
                                    <img src="{{ asset('assets/edit_bl.svg') }}" alt="first icon" class="w-11 h-11" />
                                </li>
                                </a>
                                <a href="{{ route('admin/products/delete', ['id'=>$product->id]) }}">
                                <li class="cursor-pointer p-[1px] rounded-md" >
                                    <img src="{{ asset('assets/delete_bl.svg') }}" alt="second icon" class="w-10 h-10" />
                                </li>
                                </a>
                                <a href="{{ route('admin/products/edit/out', ['id'=>$product->id]) }}">
                                <li class="cursor-pointer p-[1px] rounded-md">
                                    <img src="{{ asset('assets/outedit_bl.svg') }}" alt="third icon" class="w-10 h-10" />
                                </li>
                                </a>
                            </ul>
                            
                        </div>
                    </div>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>