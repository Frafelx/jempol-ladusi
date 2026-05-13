<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\FollowUpLog; // <--- Tambahan baru

class DataPenggunaController extends Controller
{
    public function index(Request $request)
    {
        // 1. Siapkan raw query
        $sql = "
            SELECT
              tanggal_daftar              AS tgl,
              'SIAP INTEGRASI'            AS jenis_layanan,
              nama_penjamin               AS nama_pengguna,
              nama_wbp,
              no_hp,
              'siapintegrasi'             AS sumber
            FROM siapintegrasi.layanan_integrasi
            WHERE histori_info_sidang_tpp IS NOT NULL

            UNION ALL

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
            WHERE dl.status = 'dilayani'

            UNION ALL

            SELECT
              waktu_kunjungan             AS tgl,
              'KUNJUNGAN'                 AS jenis_layanan,
              pengunjung                  AS nama_pengguna,
              wbp                         AS nama_wbp,
              catatan                     AS no_hp,
              'data_pengunjung'           AS sumber
            FROM data_kunjungan.data_kunjungan

            UNION ALL

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

        // 2. Bungkus query dengan pembuatan Hash ID Unik
        $outerSql = "SELECT *, MD5(CONCAT(jenis_layanan, '_', tgl, '_', IFNULL(nama_pengguna, ''))) AS hash_id FROM ($sql) as base_data";

        // 3. Join dengan tabel follow_up_logs
        $query = DB::table(DB::raw("($outerSql) as combined_data"))
                   ->leftJoin('follow_up_logs', 'combined_data.hash_id', '=', 'follow_up_logs.hash_id')
                   ->select('combined_data.*', DB::raw('IF(follow_up_logs.hash_id IS NOT NULL, 1, 0) as is_terkirim'));

        // 4. Aplikasikan Filter
        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(function($q) use ($search) {
                $q->where('combined_data.nama_pengguna', 'like', $search)
                  ->orWhere('combined_data.nama_wbp', 'like', $search)
                  ->orWhere('combined_data.no_hp', 'like', $search);
            });
        }
        if ($request->filled('layanan') && $request->layanan !== 'semua') {
            $query->where('combined_data.jenis_layanan', $request->layanan);
        }
        if ($request->filled('start_date')) {
            $query->whereDate('combined_data.tgl', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('combined_data.tgl', '<=', $request->end_date);
        }

        // 5. Pagination & Sorting
        $dataPengguna = $query->orderBy('combined_data.tgl', 'desc')
                              ->paginate(20)
                              ->withQueryString();

        // 6. Kepanjangan Layanan
        $kepanjanganList = [
            'SIPIRMAN'       => '(Sistem Manajemen Pengiriman Titipan Barang dan Makanan)',
            'KAGATAU'        => '(Kabarin Keluarga Tahanan Baru)',
            'SIAP INTEGRASI' => '(Sistem Informasi Pelayanan Integrasi)',
            'KUNJUNGAN'      => '(Layanan Kunjungan)'
        ];

        $dataPengguna->getCollection()->transform(function ($item) use ($kepanjanganList) {
            $item->layanan_full = $item->jenis_layanan; 
            if (isset($kepanjanganList[$item->jenis_layanan])) {
                $item->layanan_full = $item->jenis_layanan . ' ' . $kepanjanganList[$item->jenis_layanan];
            }
            return $item;
        });

        // 7. Ambil Template
        $chatTemplates = [];
        if (Storage::disk('local')->exists('chat_templates.json')) {
            $chatTemplates = json_decode(Storage::disk('local')->get('chat_templates.json'), true);
        }

        return view('data-pengguna', compact('dataPengguna', 'chatTemplates'));
    }

    // FUNGSI BARU: Menyimpan status WA ke database via AJAX
    public function markFollowUp(Request $request)
    {
        $request->validate(['hash_id' => 'required|string']);
        FollowUpLog::firstOrCreate(['hash_id' => $request->hash_id]);
        return response()->json(['success' => true]);
    }
}