@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    {{-- Welcome Header --}}
    <div class="max-w-6xl mx-auto">

        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight">Selamat Datang di JEMPOL LADUSI</h3>
                <p class="text-slate-500 text-sm mt-1">Pantau performa pelayanan dan survei Anda dalam satu dasbor terpadu.
                </p>
            </div>

            <button onclick="resetFollowUpMemory()" id="btnResetMemory"
                class="hidden self-start px-4 py-2 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 border border-red-100 rounded-xl transition-all duration-200">
                <i class="fas fa-undo-alt mr-2"></i> Reset
            </button>
        </div>
    </div>

    {{-- Filter Section - Lebih Ringkas & Elegan --}}
    {{-- Container Utama agar semua konten memiliki batas lebar yang sama --}}
    <div class="max-w-6xl mx-auto">

        {{-- Filter Section --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5 mb-6 flex items-center justify-between gap-4">
            <form action="{{ route('dashboard') }}" method="GET" class="w-full">
                <div class="flex flex-wrap items-end gap-4 justify-end">
                    <div class="flex gap-3">
                        <div>
                            <label
                                class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Mulai
                                Tgl</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}"
                                class="px-4 py-2.5 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-2xl text-[13px] outline-none transition-all text-gray-700 font-medium">
                        </div>
                        <div>
                            <label
                                class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Sampai
                                Tgl</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                class="px-4 py-2.5 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-2xl text-[13px] outline-none transition-all text-gray-700 font-medium">
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-[13px] font-bold rounded-2xl shadow-lg shadow-indigo-600/20 transition-all flex items-center gap-2 active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                            Filter
                        </button>
                        <a href="{{ route('data-pengguna') }}"
                            class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 text-[13px] font-bold rounded-2xl transition-all flex items-center justify-center">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Stats Cards Section --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Card: Total Pengguna --}}
            <div
                class="group relative bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 p-10 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-100/50">
                <div
                    class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-50 rounded-full group-hover:scale-150 transition-transform duration-700 ease-out opacity-50">
                </div>

                <div class="relative flex flex-col items-center text-center">
                    <div
                        class="w-16 h-16 rounded-2xl bg-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-200 mb-6 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0zm6 13v-2a4 4 0 00-3-3.87" />
                        </svg>
                    </div>

                    <h4 class="text-[12px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Total Pengguna</h4>
                    <p class="text-7xl font-black text-slate-900 tracking-tighter">{{ number_format($totalPengguna) }}</p>
                    <p
                        class="mt-5 text-[10px] text-slate-400 font-bold bg-slate-50 px-4 py-1.5 rounded-full border border-slate-100 uppercase tracking-wider">
                        Periode Terpilih</p>
                </div>
            </div>

            {{-- Card: Sudah Follow Up --}}
            <div
                class="group relative bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 p-10 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-amber-100/50">
                <div
                    class="absolute -right-10 -top-10 w-40 h-40 bg-amber-50 rounded-full group-hover:scale-150 transition-transform duration-700 ease-out opacity-50">
                </div>

                <div class="relative flex flex-col items-center text-center">
                    <div
                        class="w-16 h-16 rounded-2xl bg-amber-500 flex items-center justify-center shadow-lg shadow-amber-200 mb-6 group-hover:-rotate-6 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <h4 class="text-[12px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Sudah Follow Up</h4>
                    <p id="countFollowedUp" class="text-7xl font-black text-slate-900 tracking-tighter">0</p>
                    <p
                        class="mt-5 text-[10px] text-slate-400 font-bold bg-slate-50 px-4 py-1.5 rounded-full border border-slate-100 uppercase tracking-wider">
                        Data Tersimpan</p>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const count = Object.keys(localStorage).filter(k => k.startsWith('followed_up_')).length;
            const element = document.getElementById('countFollowedUp');

            // Animasi angka berjalan sederhana
            let start = 0;
            const end = count;
            const duration = 1000;
            const step = (timestamp) => {
                if (!start) start = timestamp;
                const progress = Math.min((timestamp - start) / duration, 1);
                element.textContent = Math.floor(progress * end).toLocaleString('id-ID');
                if (progress < 1) window.requestAnimationFrame(step);
            };
            window.requestAnimationFrame(step);
        });
    </script>

@endsection
