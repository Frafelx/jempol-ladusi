@extends('layouts.app')
@section('title', 'Buku Telepon - Tracing')

@section('content')
    <div class="space-y-8">

        {{-- HEADER --}}
        <div class="flex justify-between items-center">
            <div>
                <h4 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    📞 Buku Telepon & Tracing WBP
                </h4>
                <p class="text-sm text-gray-500 mt-1">
                    Pemetaan nomor telepon keluarga berdasarkan riwayat layanan.
                </p>
            </div>
            <div>
                <span class="px-4 py-2 bg-white border rounded-lg shadow text-sm font-medium">
                    👥 Total: {{ $tahanans->total() }}
                </span>
            </div>
        </div>

        {{-- SEARCH --}}
        <div class="flex justify-end mb-4">
            <form action="{{ route('buku-telepon.index') }}" method="GET"
                class="flex gap-2 items-center bg-white p-2.5 rounded-2xl shadow-sm border border-gray-200 max-w-md w-full focus-within:border-blue-400 transition">

                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search"
                        class="w-full pl-10 pr-4 py-2.5 text-sm border-none focus:ring-0 outline-none placeholder:text-gray-400 font-medium text-slate-700"
                        placeholder="Cari Nama / Kode Napi..." value="{{ request('search') }}">
                </div>

                <button type="submit"
                    class="px-4 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-200 transition">
                    Cari
                </button>
            </form>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-xl shadow-sm border-[0.5px] border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse">

                    {{-- HEADER --}}
                    <thead class="bg-blue-600 text-white uppercase">
                        <tr>
                            <th
                                class="px-4 py-4 border-r border-gray-200 text-center text-[11px] font-bold tracking-widest w-16">
                                No</th>
                            <th
                                class="px-6 py-4 border-r border-gray-200 text-center text-[11px] font-bold tracking-widest w-64">
                                Nama Tahanan</th>
                            <th
                                class="px-6 py-4 border-r border-gray-200 text-center text-[11px] font-bold tracking-widest">
                                Nama Keluarga</th>
                            <th
                                class="px-6 py-4 border-r border-gray-200 text-center text-[11px] font-bold tracking-widest w-40">
                                Hubungan</th>
                            <th
                                class="px-6 py-4 border-r border-gray-200 text-center text-[11px] font-bold tracking-widest w-52">
                                Nomor Telepon</th>
                        </tr>
                    </thead>

                    {{-- BODY --}}
                    <tbody class="divide-y divide-gray-200">
                        @forelse($tahanans as $index => $t)
                            @php
                                $rowcount = count($t->semua_keluarga);
                                $firstRow = true;
                            @endphp

                            @if ($rowcount > 0)
                                @foreach ($t->semua_keluarga as $kel)
                                    @php
                                        $noWA = preg_replace('/[^0-9]/', '', $kel->hp);
                                        if (str_starts_with($noWA, '0')) {
                                            $noWA = '62' . substr($noWA, 1);
                                        }
                                    @endphp

                                    <tr
                                        class="hover:bg-gray-50 transition border-r border-gray-200 border-gray-200">
                                        @if ($firstRow)
                                            <td rowspan="{{ $rowcount }}"
                                                class="px-6 py-4 text-center font-semibold text-gray-700 border-r border-gray-200">
                                                {{ $tahanans->firstItem() + $index }}
                                            </td>

                                            <td rowspan="{{ $rowcount }}"
                                                class="px-6 py-4 text-center font-semibold text-gray-700 border-r border-gray-200">
                                                <div class="font-bold text-gray-800">{{ strtoupper($t->nama) }}</div>
                                                <div class="text-xs text-gray-500 mt-1">ID: {{ $t->code_napi }}</div>
                                            </td>

                                            @php $firstRow = false; @endphp
                                        @endif

                                        <td
                                            class="px-6 py-4 text-center font-semibold text-gray-700 border-r border-gray-200">
                                            {{ strtoupper($kel->nama_keluarga) }}
                                        </td>

                                        <td
                                            class="px-6 py-4 text-center font-semibold text-gray-700 border-r border-gray-200">
                                            {{ $kel->hubungan ?? 'Keluarga' }}
                                        </td>

                                        {{-- NOMOR HP + ICON --}}
                                        <td
                                            class="px-6 py-4 text-center font-semibold text-gray-700 border-r border-gray-200">
                                            @if ($kel->hp && $kel->hp != '-')
                                                <a href="https://wa.me/{{ $noWA }}" target="_blank"
                                                    class="inline-flex items-center gap-2 font-semibold hover:underline"
                                                    style="color:#16a34a;">
                                                    {{-- ICON WA --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M20.52 3.48A11.8 11.8 0 0012.05 0C5.42 0 .02 5.4.02 12.03c0 2.12.55 4.18 1.6 6L0 24l6.17-1.6a12.05 12.05 0 005.88 1.5h.01c6.63 0 12.03-5.4 12.03-12.03 0-3.21-1.25-6.23-3.57-8.39zM12.06 21.5c-1.8 0-3.55-.48-5.1-1.38l-.37-.22-3.66.95.98-3.57-.24-.37a9.5 9.5 0 01-1.46-5.08c0-5.24 4.26-9.5 9.5-9.5 2.54 0 4.93.99 6.72 2.78a9.42 9.42 0 012.78 6.72c0 5.24-4.26 9.5-9.5 9.5zm5.2-7.12c-.28-.14-1.64-.8-1.9-.9-.26-.1-.45-.14-.64.14-.19.28-.73.9-.9 1.08-.17.19-.33.21-.61.07-.28-.14-1.18-.43-2.24-1.36-.83-.74-1.39-1.66-1.55-1.94-.16-.28-.02-.43.12-.57.12-.12.28-.33.42-.5.14-.17.19-.28.28-.47.09-.19.05-.36-.02-.5-.07-.14-.64-1.55-.88-2.12-.23-.56-.47-.49-.64-.5l-.55-.01c-.19 0-.5.07-.76.36-.26.28-1 1-1 2.43 0 1.43 1.03 2.82 1.18 3.01.14.19 2.03 3.1 4.92 4.34.69.3 1.22.48 1.64.62.69.22 1.32.19 1.82.12.56-.08 1.64-.67 1.87-1.32.23-.65.23-1.2.16-1.32-.07-.12-.26-.19-.55-.33z" />
                                                    </svg>

                                                    {{ $kel->hp }}
                                                </a>
                                            @else
                                                <span class="text-gray-400 italic text-xs">Tidak Ada</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center py-4">
                                        {{ $tahanans->firstItem() + $index }}
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <div class="font-bold">{{ strtoupper($t->nama) }}</div>
                                        <div class="text-xs text-gray-500 mt-1">ID: {{ $t->code_napi }}</div>
                                    </td>
                                    <td colspan="3" class="text-center text-gray-400 italic py-4">
                                        Belum ada data keluarga
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-gray-400 italic">
                                    Data tidak ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="p-6 bg-gray-50 border-t border-gray-200 flex justify-center">
                {{ $tahanans->links() }}
            </div>
        </div>
    </div>
@endsection
