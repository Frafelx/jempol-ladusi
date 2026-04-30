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

        /* ========================================================================
        KODE ASLI KUNJUNGAN (DIKOMENTARI SEMENTARA)
        Jika database data_pengunjung sudah ada, masukkan kembali kode ini 
        di atas UNION ALL SIPIRMAN pada variabel $sql di atas:
        
        UNION ALL
        SELECT
            waktu_kunjungan             AS tgl,
            'KUNJUNGAN'                 AS jenis_layanan,
            pengunjung                  AS nama_pengguna,
            wbp                         AS nama_wbp,
            catatan                     AS no_hp,
            'data_pengunjung'           AS sumber
        FROM data_pengunjung.data_kunjungan
        ========================================================================
        */

        $query = DB::table(DB::raw("($sql) as combined_data"));

        // Filter tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('tgl', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('tgl', '<=', $request->end_date);
        }

        // Total semua data 
        $totalPengguna = (clone $query)->count();

        // Total yang punya no HP (bisa di-follow up)
        $totalBisaFollowUp = (clone $query)
            ->whereNotNull('no_hp')
            ->where('no_hp', '!=', '')
            ->count();

        // Total per layanan
        $perLayanan = (clone $query)
            ->select('jenis_layanan', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('jenis_layanan')
            ->get()
            ->keyBy('jenis_layanan');

        // Data tren per hari untuk chart
        $chartData = (clone $query)
            ->select(DB::raw('DATE(tgl) as tanggal'), DB::raw('COUNT(*) as jumlah'))
            ->groupBy(DB::raw('DATE(tgl)'))
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
            'totalBisaFollowUp',
            'perLayanan',
            'chartData',
            'startDate',
            'endDate'
        ));
    }
}