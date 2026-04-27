@extends('layouts.app')

@section('title', 'Data Pengguna Layanan')

@section('content')
    <div class="mb-6">
        <h3 class="text-[18px] font-bold text-gray-900 tracking-tight">Rekapitulasi Terpadu</h3>
        <p class="text-[13px] text-gray-500 mt-1">Data gabungan dari SIAP INTEGRASI, KAGATAU, Kunjungan, dan SIPIRMAN.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
        <form action="{{ route('data-pengguna') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            
            <div class="flex-1 w-full">
                <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Pencarian</label>
                <div class="relative group">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama pengguna, WBP, atau No HP..." 
                           class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-[13px] outline-none transition-all font-medium text-gray-700 placeholder-gray-400">
                </div>
            </div>

            <div class="w-full md:w-56">
                <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Jenis Layanan</label>
                <div class="relative group">
                    <select name="layanan" class="w-full pl-4 pr-10 py-2.5 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-[13px] outline-none transition-all appearance-none cursor-pointer font-medium text-gray-700">
                        <option value="semua">Semua Layanan</option>
                        <option value="SIAP INTEGRASI" {{ request('layanan') == 'SIAP INTEGRASI' ? 'selected' : '' }}>SIAP INTEGRASI</option>
                        <option value="KAGATAU" {{ request('layanan') == 'KAGATAU' ? 'selected' : '' }}>KAGATAU</option>
                        <option value="KUNJUNGAN" {{ request('layanan') == 'KUNJUNGAN' ? 'selected' : '' }}>KUNJUNGAN</option>
                        <option value="SIPIRMAN" {{ request('layanan') == 'SIPIRMAN' ? 'selected' : '' }}>SIPIRMAN</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3.5 pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-auto flex gap-3">
                <div>
                    <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Mulai Tgl</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-[13px] outline-none transition-all text-gray-700 font-medium">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Sampai Tgl</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-[13px] outline-none transition-all text-gray-700 font-medium">
                </div>
            </div>

            <div class="flex gap-2 w-full md:w-auto">
                <button type="submit" class="flex-1 md:flex-none px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-[13px] font-semibold rounded-xl shadow-md shadow-indigo-600/20 transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter
                </button>
                <a href="{{ route('data-pengguna') }}" class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 hover:text-gray-900 text-gray-600 text-[13px] font-semibold rounded-xl transition-all flex items-center justify-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr class="text-[11.5px] uppercase tracking-wider text-gray-500 font-bold">
                        <th class="px-6 py-4 text-center w-16">No</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Jenis Layanan</th>
                        <th class="px-6 py-4">Nama Pengguna</th>
                        <th class="px-6 py-4">Nama WBP</th>
                        <th class="px-6 py-4">No. HP</th>
                        <th class="px-6 py-4 text-center">Follow Up</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-[13.5px] bg-white">
                    @forelse ($dataPengguna as $index => $data)
                        <tr class="hover:bg-indigo-50/40 even:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 text-center text-gray-400 font-medium">
                                {{ $dataPengguna->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 text-gray-600 font-medium tracking-wide">
                                {{ date('d M Y', strtotime($data->tgl)) }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $badgeColor = match($data->sumber) {
                                        'siapintegrasi' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'kagatau' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'data_kunjungan' => 'bg-purple-50 text-purple-700 border-purple-200',
                                        'sipirman' => 'bg-amber-50 text-amber-700 border-amber-200',
                                        default => 'bg-gray-50 text-gray-700 border-gray-200',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold border {{ $badgeColor }}">
                                    {{ $data->jenis_layanan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-900 font-semibold whitespace-normal max-w-[200px] break-words leading-relaxed">
                                {{ $data->nama_pengguna ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-gray-700 font-medium whitespace-normal max-w-[200px] break-words leading-relaxed">
                                {{ $data->nama_wbp ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($data->no_hp)
                                    <span class="text-gray-800 font-medium tracking-wide">
                                        {{ $data->no_hp }}
                                    </span>
                                @else
                                    <span class="text-gray-400 italic text-[12px]">Tidak tersedia</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($data->no_hp)
                                    @php
                                        // Bersihkan nomor (Hanya ambil angka)
                                        $phoneClean = preg_replace('/[^0-9]/', '', $data->no_hp);
                                        
                                        // Ubah angka 0 di depan menjadi 62 agar valid di WA
                                        if (str_starts_with($phoneClean, '0')) {
                                            $phoneClean = '62' . substr($phoneClean, 1);
                                        }

                                        $namaP = $data->nama_pengguna ?? 'Bapak/Ibu';
                                        $namaW = $data->nama_wbp ?? '-';
                                        
                                        // Ambil template dari file JSON, berikan default text jika JSON kosong/belum terbuat
                                        $templateLayanan = $chatTemplates[$data->jenis_layanan] ?? "Halo *{nama_pengguna}*, info terkait layanan {$data->jenis_layanan} untuk WBP *{nama_wbp}*.";
                                        
                                        // Replace parameter dengan nama asli
                                        $pesanTeks = str_replace(['{nama_pengguna}', '{nama_wbp}'], [$namaP, $namaW], $templateLayanan);
                                        
                                        // Generate URL WA
                                        $waUrl = "https://wa.me/{$phoneClean}?text=" . urlencode($pesanTeks);
                                    @endphp
                                    <a href="{{ $waUrl }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 hover:bg-emerald-500 text-emerald-600 hover:text-white border border-emerald-200 hover:border-emerald-500 rounded-lg text-[11px] font-bold transition-all shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.277.042-.615.088-2.052-.505-1.745-.718-2.868-2.493-2.953-2.606-.085-.113-.705-.941-.705-1.796 0-.855.441-1.275.597-1.44.156-.165.342-.206.455-.206.114 0 .228 0 .326.005.099.005.234-.038.356.257.128.309.44 1.077.483 1.161.043.085.071.185.014.299-.057.113-.085.185-.171.284-.085.099-.185.228-.256.313-.085.099-.185.213-.071.412.114.199.511.849 1.096 1.373.758.679 1.401.895 1.6 1.009.199.114.313.099.427-.028.114-.128.483-.57.612-.765.128-.199.256-.165.44-.095.185.071 1.18.556 1.38 1.656z"></path><path d="M12 2C6.477 2 2 6.477 2 12c0 1.764.462 3.42 1.258 4.869L2 22l5.297-1.186C8.705 21.547 10.316 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.232c-1.523 0-3.003-.393-4.321-1.139l-.31-.176-3.149.704.717-3.084-.193-.321A8.204 8.204 0 013.768 12C3.768 7.458 7.458 3.768 12 3.768 16.542 3.768 20.232 7.458 20.232 12c0 4.542-3.69 8.232-8.232 8.232z"></path></svg>
                                        Chat WA
                                    </a>
                                @else
                                    <button disabled class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 text-gray-400 border border-gray-200 rounded-lg text-[11px] font-bold cursor-not-allowed">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.277.042-.615.088-2.052-.505-1.745-.718-2.868-2.493-2.953-2.606-.085-.113-.705-.941-.705-1.796 0-.855.441-1.275.597-1.44.156-.165.342-.206.455-.206.114 0 .228 0 .326.005.099.005.234-.038.356.257.128.309.44 1.077.483 1.161.043.085.071.185.014.299-.057.113-.085.185-.171.284-.085.099-.185.228-.256.313-.085.099-.185.213-.071.412.114.199.511.849 1.096 1.373.758.679 1.401.895 1.6 1.009.199.114.313.099.427-.028.114-.128.483-.57.612-.765.128-.199.256-.165.44-.095.185.071 1.18.556 1.38 1.656z"></path><path d="M12 2C6.477 2 2 6.477 2 12c0 1.764.462 3.42 1.258 4.869L2 22l5.297-1.186C8.705 21.547 10.316 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.232c-1.523 0-3.003-.393-4.321-1.139l-.31-.176-3.149.704.717-3.084-.193-.321A8.204 8.204 0 013.768 12C3.768 7.458 7.458 3.768 12 3.768 16.542 3.768 20.232 7.458 20.232 12c0 4.542-3.69 8.232-8.232 8.232z"></path></svg>
                                        Chat WA
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-3 border border-gray-200">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </div>
                                    <p class="text-[14px] font-semibold text-gray-900">Data tidak ditemukan</p>
                                    <p class="text-[13px] text-gray-500 mt-1">Coba gunakan kata kunci atau rentang tanggal lain.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if ($dataPengguna->hasPages())
            <div class="border-t border-gray-200 px-6 py-4 bg-white flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-[13px] text-gray-500">
                    Menampilkan <span class="font-semibold text-gray-900">{{ $dataPengguna->firstItem() }}</span> hingga <span class="font-semibold text-gray-900">{{ $dataPengguna->lastItem() }}</span> dari <span class="font-semibold text-gray-900">{{ $dataPengguna->total() }}</span> entri
                </div>
                {{ $dataPengguna->links('custom-pagination') }}                
            </div>
        @elseif($dataPengguna->total() > 0)
            <div class="border-t border-gray-200 px-6 py-4 bg-white flex justify-between items-center text-[13px] text-gray-500">
                <span>Menampilkan <span class="font-semibold text-gray-900">{{ $dataPengguna->count() }}</span> dari <span class="font-semibold text-gray-900">{{ $dataPengguna->total() }}</span> entri</span>
            </div>
        @endif
    </div>
@endsection