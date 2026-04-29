<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function getLatest()
    {
        // Ambil tanggal hari ini
        $today = Carbon::today()->toDateString();

        // Query untuk mencari data layanan yang diinput hari ini
        $sql = "
            SELECT tanggal_daftar AS tgl, 'SIAP INTEGRASI' AS jenis_layanan, nama_penjamin AS nama_pengguna
            FROM siapintegrasi.layanan_integrasi WHERE DATE(tanggal_daftar) = '{$today}'
            UNION ALL
            SELECT dl.tanggal_masuk AS tgl, 'KAGATAU' AS jenis_layanan, p.nama AS nama_pengguna
            FROM kagatau.data_layanan dl LEFT JOIN sipirman.penitip p ON p.id = dl.penitip_id WHERE DATE(dl.tanggal_masuk) = '{$today}'
            UNION ALL
            SELECT waktu_kunjungan AS tgl, 'KUNJUNGAN' AS jenis_layanan, pengunjung AS nama_pengguna
            FROM data_kunjungan.data_kunjungan WHERE DATE(waktu_kunjungan) = '{$today}'
            UNION ALL
            SELECT DATE(dt.tanggal) AS tgl, 'SIPIRMAN' AS jenis_layanan, dt.nama_pengirim AS nama_pengguna
            FROM sipirman.data_titipan dt WHERE DATE(dt.tanggal) = '{$today}' AND dt.deleted_date IS NULL
        ";

        $notifications = DB::table(DB::raw("($sql) as recent_data"))
            ->orderBy('tgl', 'desc')
            ->limit(5) // Ambil 5 notifikasi terbaru saja agar pop-up tidak kepenuhan
            ->get();

        return response()->json([
            'count' => $notifications->count(),
            'data' => $notifications
        ]);
    }
}