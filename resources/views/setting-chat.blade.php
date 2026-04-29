@extends('layouts.app')

@section('title', 'Setting Chat WhatsApp')

@section('content')
    <div class="mb-6">
        <h3 class="text-[18px] font-bold text-gray-900 tracking-tight">Format Pesan Follow Up</h3>
        <p class="text-[13px] text-gray-500 mt-1">Atur template pesan WhatsApp otomatis untuk semua layanan.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-3 shadow-sm">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-[13px] font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <div class="flex items-start gap-3">
                <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-[14px] font-bold text-gray-800">Petunjuk Penggunaan Parameter</h4>
                    <p class="text-[13px] text-gray-600 mt-1 leading-relaxed">Gunakan parameter <code class="bg-indigo-50 text-indigo-700 px-1.5 py-0.5 rounded font-bold">{nama_pengguna}</code> untuk memanggil nama pengunjung/penjamin, <code class="bg-indigo-50 text-indigo-700 px-1.5 py-0.5 rounded font-bold">{nama_wbp}</code> untuk nama WBP, dan <code class="bg-indigo-50 text-indigo-700 px-1.5 py-0.5 rounded font-bold">{layanan}</code> untuk menampilkan jenis layanannya. Gunakan tanda bintang (*) untuk membuat teks tebal.</p>
                </div>
            </div>
        </div>

        <form action="{{ route('setting-chat.update') }}" method="POST" class="p-6">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block text-[13px] font-bold text-gray-800 mb-2">Template Chat Follow Up</label>
                    <textarea name="template_umum" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-[13px] outline-none transition-all text-gray-700 leading-relaxed resize-none">{{ $templates['template_umum'] ?? 'Halo *{nama_pengguna}*, kami dari JEMPOL LADUSI Rutan Rembang ingin mengabarkan informasi terkait layanan *{layanan}* untuk WBP atas nama *{nama_wbp}*.' }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-[13px] font-semibold rounded-xl shadow-md shadow-indigo-600/20 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection