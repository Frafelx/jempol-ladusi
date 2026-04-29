@extends('layouts.app')

@section('title', 'Daftar Kanal Pengaduan')

@section('content')
    <div class="mb-6">
        <h3 class="text-[18px] font-bold text-gray-900 tracking-tight">Manajemen Akun Layanan Pengaduan</h3>
        <p class="text-[13px] text-gray-500 mt-1">Catatan informasi kredensial (username & password) beserta akses cepat ke berbagai kanal layanan Rutan.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-3 shadow-sm">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-[13px] font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <h4 class="text-[14px] font-bold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Akun Baru
        </h4>
        <form action="{{ route('kanal-pengaduan.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
            @csrf
            
            <div>
                <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Nama Kanal Aduan</label>
                <input type="text" name="kanal_aduan" placeholder="Contoh: Instagram" required
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-[13px] outline-none transition-all font-medium text-gray-700 placeholder-gray-400">
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Link / URL</label>
                <input type="text" name="link" placeholder="Contoh: instagram.com" 
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-[13px] outline-none transition-all font-medium text-gray-700 placeholder-gray-400">
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Username / Email</label>
                <input type="text" name="username" placeholder="Masukkan username" 
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-[13px] outline-none transition-all font-medium text-gray-700 placeholder-gray-400">
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Password</label>
                <input type="text" name="password" placeholder="Masukkan password" 
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-[13px] outline-none transition-all font-medium text-gray-700 placeholder-gray-400">
            </div>

            <div>
                <button type="submit" class="w-full px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-[13px] font-semibold rounded-xl shadow-md shadow-indigo-600/20 transition-all flex items-center justify-center">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr class="text-[11.5px] uppercase tracking-wider text-gray-500 font-bold">
                        <th class="px-6 py-4 text-center w-16">No</th>
                        <th class="px-6 py-4">Kanal Aduan</th>
                        <th class="px-6 py-4">Username / ID</th>
                        <th class="px-6 py-4">Password</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-[13.5px] bg-white">
                    @forelse ($kanals as $index => $kanal)
                        <tr class="hover:bg-indigo-50/40 even:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 text-center text-gray-400 font-medium">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 text-gray-900 font-bold tracking-wide">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                                    {{ $kanal->kanal_aduan }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-700 font-medium">
                                {{ $kanal->username ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-gray-800 font-mono tracking-wider bg-gray-50/50">
                                {{ $kanal->password ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    
                                    @if($kanal->link)
                                        @php
                                            $url = $kanal->link;
                                            if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                                                $url = "http://" . $url;
                                            }
                                        @endphp
                                        <a href="{{ $url }}" target="_blank" class="p-1.5 text-indigo-500 hover:text-indigo-700 hover:bg-indigo-100 rounded-lg transition-colors" title="Buka Halaman">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        </a>
                                    @endif

                                    <button type="button" 
                                            onclick="openEditModal('{{ $kanal->id }}', '{{ addslashes($kanal->kanal_aduan) }}', '{{ addslashes($kanal->link) }}', '{{ addslashes($kanal->username) }}', '{{ addslashes($kanal->password) }}')" 
                                            class="p-1.5 text-amber-500 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>

                                    <form action="{{ route('kanal-pengaduan.destroy', $kanal->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kredensial ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-3 border border-gray-200">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    </div>
                                    <p class="text-[14px] font-semibold text-gray-900">Belum ada data kredensial</p>
                                    <p class="text-[13px] text-gray-500 mt-1">Silakan tambahkan akun baru melalui form di atas.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 z-50 hidden bg-gray-900/40 backdrop-blur-sm flex items-center justify-center transition-all opacity-0">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 transform scale-95 transition-all mx-4" id="editModalContent">
            
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-[16px] font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit Kanal Pengaduan
                </h3>
                <button type="button" onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Nama Kanal Aduan</label>
                        <input type="text" name="kanal_aduan" id="edit_kanal_aduan" required
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-[13px] outline-none transition-all font-medium text-gray-700">
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Link / URL</label>
                        <input type="text" name="link" id="edit_link"
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-[13px] outline-none transition-all font-medium text-gray-700">
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Username / Email</label>
                        <input type="text" name="username" id="edit_username"
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-[13px] outline-none transition-all font-medium text-gray-700">
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Password</label>
                        <input type="text" name="password" id="edit_password"
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-[13px] outline-none transition-all font-medium text-gray-700">
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 text-[13px] font-semibold rounded-xl transition-all">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-[13px] font-semibold rounded-xl shadow-md shadow-indigo-600/20 transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, kanal, link, username, password) {
            const modal = document.getElementById('editModal');
            const modalContent = document.getElementById('editModalContent');
            const form = document.getElementById('editForm');
            
            // Set action URL untuk form
            form.action = `/kanal-pengaduan/${id}`;
            
            // Isi form dengan data lama
            document.getElementById('edit_kanal_aduan').value = kanal;
            document.getElementById('edit_link').value = link;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_password').value = password;
            
            // Tampilkan modal dengan efek transisi
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            const modalContent = document.getElementById('editModalContent');
            
            // Sembunyikan modal dengan efek transisi
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Waktu menyesuaikan dengan durasi transisi CSS
        }
    </script>
@endsection