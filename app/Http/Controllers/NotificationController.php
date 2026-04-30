<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
public function getLatest() // <--- UBAH JADI SEPERTI INI
    {
        // Query UNION disinkronkan dengan aturan Data Pengguna
        $sql = "
            SELECT
              tanggal_daftar              AS tgl,
              'SIAP INTEGRASI'            AS jenis_layanan,
              nama_penjamin               AS nama_pengguna
            FROM siapintegrasi.layanan_integrasi
            WHERE histori_info_sidang_tpp IS NOT NULL

            UNION ALL

            SELECT
              dl.tanggal_masuk            AS tgl,
              'KAGATAU'                   AS jenis_layanan,
              p.nama                      AS nama_pengguna
            FROM kagatau.data_layanan dl
            LEFT JOIN sipirman.penitip  p ON p.id = dl.penitip_id
            WHERE dl.status = 'dilayani'

            UNION ALL

            SELECT
              DATE(dt.tanggal)            AS tgl,
              'SIPIRMAN'                  AS jenis_layanan,
              dt.nama_pengirim            AS nama_pengguna
            FROM sipirman.data_titipan dt
            WHERE dt.deleted_date IS NULL
        ";

        /* KUNJUNGAN SEMENTARA DIKOMENTARI
        UNION ALL
        SELECT
            waktu_kunjungan             AS tgl,
            'KUNJUNGAN'                 AS jenis_layanan,
            pengunjung                  AS nama_pengguna
        FROM data_pengunjung.data_kunjungan
        */

        // Ambil data terbaru TANPA batasan hari ini
        $query = DB::table(DB::raw("($sql) as combined_data"))
                   ->orderBy('tgl', 'desc')
                   ->limit(50) // Dibatasi 50 notifikasi terbaru
                   ->get();

        // Format pesan notifikasi (Menggunakan Array yang aman untuk semua versi PHP)
        $formattedData = $query->map(function ($item) {
            
            // Daftar kepanjangan layanan
            $kepanjanganList = [
                'SIPIRMAN'       => '(Sistem Manajemen Pengiriman Titipan Barang dan Makanan)',
                'KAGATAU'        => '(Kabarin Keluarga Tahanan Baru)',
                'SIAP INTEGRASI' => '(Sistem Informasi Pelayanan Integrasi)',
                'KUNJUNGAN'      => '(Layanan Kunjungan)'
            ];

            // Cek apakah layanannya ada di daftar, jika tidak kosongkan
            $kepanjangan = isset($kepanjanganList[$item->jenis_layanan]) ? $kepanjanganList[$item->jenis_layanan] : '';

            return [
                'tgl'           => $item->tgl,
                'jenis_layanan' => $item->jenis_layanan,
                'nama_pengguna' => $item->nama_pengguna,
                'pesan'         => "Pengguna Layanan {$item->jenis_layanan} {$kepanjangan} selesai dilayani. Saatnya beraksi LADUSI!"
            ];
        });

        return response()->json([
            'count' => $formattedData->count(),
            'data'  => $formattedData
        ]);
    }
}