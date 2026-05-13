<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Hitung total tahanan dari database sipirman
        $jumlahTahanan = DB::table('sipirman.tahanan')->count();

        // Query UNION (Disinkronkan 100% dengan DataPenggunaController)
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

        // 1. Bungkus query dengan pembuatan Hash ID Unik (Sama seperti di DataPenggunaController)
        $outerSql = "SELECT *, MD5(CONCAT(jenis_layanan, '_', tgl, '_', IFNULL(nama_pengguna, ''))) AS hash_id FROM ($sql) as base_data";

        // 2. Join dengan tabel follow_up_logs agar bisa menghitung status WA
        $query = DB::table(DB::raw("($outerSql) as combined_data"))
                   ->leftJoin('follow_up_logs', 'combined_data.hash_id', '=', 'follow_up_logs.hash_id')
                   ->select('combined_data.*', DB::raw('IF(follow_up_logs.hash_id IS NOT NULL, 1, 0) as is_terkirim'));

        // Filter tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('combined_data.tgl', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('combined_data.tgl', '<=', $request->end_date);
        }

        // Total semua data pengguna layanan
        $totalPengguna = (clone $query)->count();

        // Total yang punya no HP (Target Follow Up)
        $totalTargetFollowUp = (clone $query)
            ->whereNotNull('combined_data.no_hp')
            ->where('combined_data.no_hp', '!=', '')
            ->count();

        // Total yang SUDAH di Follow Up (Berdasarkan data dari database)
        $totalSudahFollowUp = (clone $query)
            ->whereRaw('follow_up_logs.hash_id IS NOT NULL')
            ->count();
            
        // Menghindari error angka minus jika ada anomali
        $totalBelumFollowUp = max(0, $totalTargetFollowUp - $totalSudahFollowUp);

        // Total per layanan
        $perLayanan = (clone $query)
            ->select('combined_data.jenis_layanan', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('combined_data.jenis_layanan')
            ->get()
            ->keyBy('jenis_layanan');

        // Data tren per hari untuk chart
        $chartData = (clone $query)
            ->select(DB::raw('DATE(combined_data.tgl) as tanggal'), DB::raw('COUNT(*) as jumlah'))
            ->groupBy(DB::raw('DATE(combined_data.tgl)'))
            ->orderBy('tanggal')
            ->get()
            ->mapWithKeys(fn($r) => [
                \Carbon\Carbon::parse($r->tanggal)->format('d M') => $r->jumlah
            ]);

        $startDate = $request->filled('start_date') ? $request->start_date : now()->subDays(29)->toDateString();
        $endDate   = $request->filled('end_date')   ? $request->end_date   : now()->toDateString();

        return view('dashboard', compact(
            'jumlahTahanan',
            'totalPengguna',
            'totalTargetFollowUp', // Variabel baru
            'totalSudahFollowUp',  // Variabel baru
            'totalBelumFollowUp',  // Variabel baru
            'perLayanan',
            'chartData',
            'startDate',
            'endDate'
        ));
    }
}