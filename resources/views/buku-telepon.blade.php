@extends('layouts.app')

@section('title', 'Buku Telepon - Tracing')

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
        <div>
            <h3 class="text-[18px] font-bold text-gray-900 tracking-tight flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                Buku Telepon & Tracing WBP
            </h3>
            <p class="text-[13px] text-gray-500 mt-1">Pemetaan nomor telepon keluarga berdasarkan riwayat layanan terpadu.</p>
        </div>
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-50 text-indigo-700 border border-indigo-100 rounded-lg text-[12px] font-bold shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Total: {{ $tahanans->total() }} WBP
            </span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
        <form action="{{ route('buku-telepon.index') }}" method="GET" class="flex flex-col md:flex-row gap-3 items-end">
            <div class="flex-1 w-full">
                <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Pencarian WBP</label>
                <div class="relative group">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik Nama Tahanan atau Kode Napi..." 
                           class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-[13px] outline-none transition-all font-medium text-gray-700 placeholder-gray-400">
                </div>
            </div>
            <div class="w-full md:w-auto flex gap-2">
                <button type="submit" class="flex-1 md:flex-none px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-[13px] font-semibold rounded-xl shadow-md shadow-indigo-600/20 transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Cari Data
                </button>
                @if(request('search'))
                    <a href="{{ route('buku-telepon.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 hover:text-gray-900 text-gray-600 text-[13px] font-semibold rounded-xl transition-all flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr class="text-[11.5px] uppercase tracking-wider text-gray-500 font-bold">
                        <th class="px-6 py-4 text-center w-16">No</th>
                        <th class="px-6 py-4 border-r border-gray-100">Nama Tahanan</th>
                        <th class="px-6 py-4">Nama Keluarga</th>
                        <th class="px-6 py-4 text-center">Hubungan</th>
                        <th class="px-6 py-4 text-center">Nomor Telepon</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-[13.5px]">
                    @forelse($tahanans as $index => $t)
                        @php
                            $rowcount = count($t->semua_keluarga);
                            $firstRow = true;
                            // Zebra Striping Per WBP
                            $rowBg = $index % 2 === 0 ? 'bg-white' : 'bg-slate-50/50';
                        @endphp

                        @if ($rowcount > 0)
                            @foreach ($t->semua_keluarga as $kel)
                                @php
                                    // Pembersihan Nomor WA
                                    $noWA = preg_replace('/[^0-9]/', '', $kel->hp);
                                    if (str_starts_with($noWA, '0')) {
                                        $noWA = '62' . substr($noWA, 1);
                                    }
                                @endphp

                                <tr class="{{ $rowBg }} hover:bg-indigo-50/70 transition-colors group">
                                    
                                    @if ($firstRow)
                                        <td rowspan="{{ $rowcount }}" class="px-6 py-4 text-center text-gray-400 font-medium border-r border-gray-100">
                                            {{ $tahanans->firstItem() + $index }}
                                        </td>
                                        <td rowspan="{{ $rowcount }}" class="px-6 py-4 border-r border-gray-100 align-top">
                                            <div class="font-bold text-gray-900 whitespace-normal break-words max-w-[200px] leading-relaxed">{{ strtoupper($t->nama) }}</div>
                                            <div class="text-[11px] font-semibold text-indigo-500 mt-1 bg-indigo-50/80 inline-block px-2 py-0.5 rounded border border-indigo-100">ID: {{ $t->code_napi }}</div>
                                        </td>
                                        @php $firstRow = false; @endphp
                                    @endif

                                    <td class="px-6 py-4 text-gray-800 font-semibold whitespace-normal max-w-[200px] break-words">
                                        {{ strtoupper($kel->nama_keluarga) }}
                                    </td>

                                    <td class="px-6 py-4 text-center text-gray-700 font-medium whitespace-normal max-w-[150px] break-words">
                                        {{ $kel->hubungan ?? 'Keluarga' }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @if ($kel->hp && $kel->hp != '-')
                                            <a href="https://wa.me/{{ $noWA }}" target="_blank" class="inline-flex items-center gap-1.5 text-emerald-600 hover:text-emerald-700 font-bold hover:underline transition-colors">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.277.042-.615.088-2.052-.505-1.745-.718-2.868-2.493-2.953-2.606-.085-.113-.705-.941-.705-1.796 0-.855.441-1.275.597-1.44.156-.165.342-.206.455-.206.114 0 .228 0 .326.005.099.005.234-.038.356.257.128.309.44 1.077.483 1.161.043.085.071.185.014.299-.057.113-.085.185-.171.284-.085.099-.185.228-.256.313-.085.099-.185.213-.071.412.114.199.511.849 1.096 1.373.758.679 1.401.895 1.6 1.009.199.114.313.099.427-.028.114-.128.483-.57.612-.765.128-.199.256-.165.44-.095.185.071 1.18.556 1.38 1.656z"></path><path d="M12 2C6.477 2 2 6.477 2 12c0 1.764.462 3.42 1.258 4.869L2 22l5.297-1.186C8.705 21.547 10.316 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.232c-1.523 0-3.003-.393-4.321-1.139l-.31-.176-3.149.704.717-3.084-.193-.321A8.204 8.204 0 013.768 12C3.768 7.458 7.458 3.768 12 3.768 16.542 3.768 20.232 7.458 20.232 12c0 4.542-3.69 8.232-8.232 8.232z"></path></svg>
                                                {{ $kel->hp }}
                                            </a>
                                        @else
                                            <span class="text-gray-400 italic text-[12px]">Tidak Ada</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="{{ $rowBg }} hover:bg-indigo-50/70 transition-colors">
                                <td class="px-6 py-4 text-center text-gray-400 font-medium border-r border-gray-100">
                                    {{ $tahanans->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4 border-r border-gray-100 align-top">
                                    <div class="font-bold text-gray-900 whitespace-normal break-words max-w-[200px] leading-relaxed">{{ strtoupper($t->nama) }}</div>
                                    <div class="text-[11px] font-semibold text-indigo-500 mt-1 bg-indigo-50/80 inline-block px-2 py-0.5 rounded border border-indigo-100">ID: {{ $t->code_napi }}</div>
                                </td>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-400 italic">
                                    Belum ada data keluarga yang terdaftar
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center bg-white">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-3 border border-gray-200">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </div>
                                    <p class="text-[14px] font-semibold text-gray-900">Data WBP tidak ditemukan</p>
                                    <p class="text-[13px] text-gray-500 mt-1">Coba gunakan nama atau kode lain pada kotak pencarian.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if ($tahanans->hasPages())
            <div class="border-t border-gray-200 px-6 py-4 bg-white flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-[13px] text-gray-500">
                    Menampilkan <span class="font-semibold text-gray-900">{{ $tahanans->firstItem() }}</span> hingga <span class="font-semibold text-gray-900">{{ $tahanans->lastItem() }}</span> dari <span class="font-semibold text-gray-900">{{ $tahanans->total() }}</span> WBP
                </div>
                {{ $tahanans->links('custom-pagination') }}                
            </div>
        @elseif($tahanans->total() > 0)
            <div class="border-t border-gray-200 px-6 py-4 bg-white flex justify-between items-center text-[13px] text-gray-500">
                <span>Menampilkan <span class="font-semibold text-gray-900">{{ $tahanans->count() }}</span> dari <span class="font-semibold text-gray-900">{{ $tahanans->total() }}</span> WBP</span>
            </div>
        @endif
    </div>
@endsection