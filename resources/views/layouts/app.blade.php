<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JEMPOL LADUSI | Rutan Rembang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#FAFAFA] text-gray-800 antialiased flex h-screen overflow-hidden selection:bg-indigo-100 selection:text-indigo-900" style="font-family: 'Inter', sans-serif;">

    <aside class="w-[260px] bg-white border-r border-gray-100 flex flex-col z-20">
        <div class="h-[80px] flex items-center px-6">
            <div class="flex items-center gap-3 w-full">
                <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center shadow-sm shadow-indigo-600/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                </div>
                <div class="flex-1">
                    <h1 class="text-[15px] font-bold text-gray-900 tracking-tight leading-tight">JEMPOL LADUSI</h1>
                    <p class="text-[11px] text-gray-500 font-medium tracking-wide">RUTAN REMBANG</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-4">
            <p class="px-2 text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Navigasi</p>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') ?? '#' }}" class="flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-indigo-50/80 text-indigo-700 font-semibold' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                        <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        <span class="text-[14px]">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('data-pengguna') }}" class="flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('data-pengguna') ? 'bg-indigo-50/80 text-indigo-700 font-semibold' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                        <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('data-pengguna') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <span class="text-[14px]">Data Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('buku-telepon') ? 'bg-indigo-50/80 text-indigo-700 font-semibold' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                        <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('buku-telepon') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span class="text-[14px]">Buku Telepon</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('kanal-pengaduan') ? 'bg-indigo-50/80 text-indigo-700 font-semibold' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                        <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('kanal-pengaduan') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        <span class="text-[14px]">Kanal Pengaduan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('setting-chat') ?? '#' }}" class="flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('setting-chat') ? 'bg-indigo-50/80 text-indigo-700 font-semibold' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                        <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('setting-chat') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="text-[14px]">Setting Chat</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col h-screen relative">
        
        <header class="h-[80px] bg-white/80 backdrop-blur-md border-b border-gray-100 flex items-center px-8 justify-between z-10 sticky top-0">
            
            <div class="flex items-center">
                <h2 class="text-xl font-bold text-gray-800 tracking-tight whitespace-nowrap">@yield('title', 'Dashboard')</h2>
            </div>
            
            <div class="flex items-center gap-3">
                <button class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-full transition-colors relative mr-1">
                    <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-2 right-2.5 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
                </button>

                <div class="h-6 w-px bg-gray-200 hidden sm:block"></div>

                <div class="flex items-center gap-3 cursor-pointer group ml-1">
                    <div class="text-right hidden sm:block">
                        <p class="text-[13px] font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors leading-tight">Tegar Jaya</p>
                        <p class="text-[11px] text-gray-500 font-medium leading-tight">Administrator</p>
                    </div>
                    <div class="h-9 w-9 rounded-full bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold text-sm ring-2 ring-white shadow-sm group-hover:bg-indigo-100 transition-colors">
                        TJ
                    </div>
                </div>

                <form action="#" method="POST" class="ml-2">
                    <button type="button" class="flex items-center gap-2 px-3 py-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200 group">
                        <svg class="w-5 h-5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span class="text-[13px] font-medium hidden lg:block">Keluar</span>
                    </button>
                </form>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-[1200px] mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>