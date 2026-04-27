<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // Wajib ditambahkan untuk baca JSON

class DataPenggunaController extends Controller
{
    public function index(Request $request)
    {
        // 1. Siapkan raw query tanpa klausa ORDER BY terlebih dahulu
        $sql = "
            -- 1. siapintegrasi
            SELECT
              tanggal_daftar              AS tgl,
              'SIAP INTEGRASI'            AS jenis_layanan,
              nama_penjamin               AS nama_pengguna,
              nama_wbp,
              no_hp,
              'siapintegrasi'             AS sumber
            FROM siapintegrasi.layanan_integrasi

            UNION ALL

            -- 2. kagatau
            SELECT
              dl.tanggal_masuk            AS tgl,
              'KAGATAU'                   AS jenis_layanan,
              p.nama                      AS nama_pengguna,
              t.nama                      AS nama_wbp,
              IFNULL(dl.hp_manual, p.hp)  AS no_hp,
              'kagatau'                   AS sumber
            FROM kagatau.data_layanan dl
            LEFT JOIN sipirman.penitip  p ON p.id = dl.penitip_id
            LEFT JOIN sipirman.tahanan  t ON t.id = dl.tahanan_id

            UNION ALL

            -- 3. data_kunjungan
            SELECT
              waktu_kunjungan             AS tgl,
              'KUNJUNGAN'                 AS jenis_layanan,
              pengunjung                  AS nama_pengguna,
              wbp                         AS nama_wbp,
              catatan                     AS no_hp,
              'data_kunjungan'            AS sumber
            FROM data_kunjungan.data_kunjungan

            UNION ALL

            -- 4. sipirman
            SELECT
              DATE(dt.tanggal)            AS tgl,
              'SIPIRMAN'                  AS jenis_layanan,
              dt.nama_pengirim            AS nama_pengguna,
              dt.nama_tahanan             AS nama_wbp,
              p.hp                        AS no_hp,
              'sipirman'                  AS sumber
            FROM sipirman.data_titipan dt
            LEFT JOIN sipirman.penitip p ON p.nik = dt.nik
            WHERE dt.deleted_date IS NULL
        ";

        // 2. Bungkus raw query menjadi Subquery
        $query = DB::table(DB::raw("($sql) as combined_data"));

        // 3. Aplikasikan Filter: Search
        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(function($q) use ($search) {
                $q->where('nama_pengguna', 'like', $search)
                  ->orWhere('nama_wbp', 'like', $search)
                  ->orWhere('no_hp', 'like', $search);
            });
        }

        // 4. Aplikasikan Filter: Jenis Layanan
        if ($request->filled('layanan') && $request->layanan !== 'semua') {
            $query->where('jenis_layanan', $request->layanan);
        }

        // 5. Aplikasikan Filter: Rentang Tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('tgl', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('tgl', '<=', $request->end_date);
        }

        // 6. Pagination & Sorting
        $dataPengguna = $query->orderBy('tgl', 'desc')
                              ->paginate(20)
                              ->withQueryString();

        // 7. Ambil Template JSON (Jika file belum ada, kembalikan array kosong)
        $chatTemplates = [];
        if (Storage::disk('local')->exists('chat_templates.json')) {
            $chatTemplates = json_decode(Storage::disk('local')->get('chat_templates.json'), true);
        }

        // 8. Lempar data dan template ke view
        return view('data-pengguna', compact('dataPengguna', 'chatTemplates'));
    }
}