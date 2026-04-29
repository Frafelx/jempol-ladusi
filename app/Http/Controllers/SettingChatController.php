<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingChatController extends Controller
{
    private $filePath = 'chat_templates.json';

    public function index()
    {
        $templates = $this->getTemplates();
        return view('setting-chat', compact('templates'));
    }

    public function update(Request $request)
    {
        // Ambil semua input kecuali token CSRF
        $data = $request->except(['_token']);
        
        // Simpan ke storage/app/chat_templates.json
        Storage::disk('local')->put($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
        
        return back()->with('success', 'Format pesan WhatsApp berhasil diperbarui!');
    }

    private function getTemplates()
    {
        // Jika file JSON belum ada, buat 1 format universal
        if (!Storage::disk('local')->exists($this->filePath)) {
            $default = [
                'template_umum' => "Halo *{nama_pengguna}*, kami dari JEMPOL LADUSI Rutan Rembang ingin mengabarkan informasi terkait layanan *{layanan}* untuk WBP atas nama *{nama_wbp}*."
            ];
            Storage::disk('local')->put($this->filePath, json_encode($default, JSON_PRETTY_PRINT));
            return $default;
        }
        
        // Jika sudah ada, baca isinya
        return json_decode(Storage::disk('local')->get($this->filePath), true);
    }
}