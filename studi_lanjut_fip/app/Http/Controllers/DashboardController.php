<?php

namespace App\Http\Controllers;

use App\Models\StudiLanjut;
use App\Models\Dosen;
use App\Models\TataUsaha;
use App\Models\StafProdi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 🔹 Total Dosen
        $totalDosen = Dosen::count();

        // 🔹 Total Staf (Tata Usaha & Staf Prodi)
        $jumlahTataUsaha = class_exists(TataUsaha::class) ? TataUsaha::count() : 0;
        $jumlahStafProdi = class_exists(StafProdi::class) ? StafProdi::count() : 0;

        // 🔹 Studi Lanjut
        $izinBelajar  = StudiLanjut::where('jenis_studi', 'Izin Belajar')->count();
        $tugasBelajar = StudiLanjut::where('jenis_studi', 'Tugas Belajar')->count();
        $studiLanjut  = StudiLanjut::whereNotNull('jenjang')->count();

        // 🔹 Jumlah Berdasarkan Lokasi
        $jumlahDalam  = StudiLanjut::where('lokasi', 'Dalam Negeri')->count();
        $jumlahLuar   = StudiLanjut::where('lokasi', 'Luar Negeri')->count();

        // 🔹 Status Studi (aktif, cuti, lulus)
        $statusDalam = StudiLanjut::select(
                DB::raw('LOWER(status_studi) as status_studi'),
                DB::raw('count(*) as total')
            )
            ->where('lokasi', 'Dalam Negeri')
            ->groupBy(DB::raw('LOWER(status_studi)'))
            ->pluck('total', 'status_studi');

        $statusLuar = StudiLanjut::select(
                DB::raw('LOWER(status_studi) as status_studi'),
                DB::raw('count(*) as total')
            )
            ->where('lokasi', 'Luar Negeri')
            ->groupBy(DB::raw('LOWER(status_studi)'))
            ->pluck('total', 'status_studi');

        // 🔹 Detail Studi Lanjut per Lokasi
        $studiDalam = StudiLanjut::where('lokasi', 'Dalam Negeri')->orderBy('nama')->get();
        $studiLuar  = StudiLanjut::where('lokasi', 'Luar Negeri')->orderBy('nama')->get();

        // 🔹 Daftar Periode Akhir
        $periodeStudi = StudiLanjut::select('periode_akhir')
            ->whereNotNull('periode_akhir')
            ->orderBy('periode_akhir', 'desc')
            ->get();

        // 🔹 Notifikasi: masa studi hampir habis (7 hari)
        $hampirHabis = StudiLanjut::whereBetween('periode_akhir', [now(), now()->addDays(7)])->get();
        $notifications = [];
        foreach ($hampirHabis as $s) {
            $tanggal = Carbon::parse($s->periode_akhir)->format('d M Y');
            $notifications[] = "Masa studi <strong>{$s->nama}</strong> akan berakhir pada {$tanggal}.";
        }

        if ($izinBelajar == 0 && $tugasBelajar == 0 && $studiLanjut == 0) {
            $notifications[] = "Belum ada dosen dengan data studi lanjut.";
        }

        // 🔹 Chart Data per Tahun
        $perYear = StudiLanjut::selectRaw('YEAR(periode_awal) as year, COUNT(*) as total')
            ->whereNotNull('periode_awal')
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('total', 'year')
            ->toArray();

        if (empty($perYear)) {
            $endYear = Carbon::now()->year;
            $startYear = $endYear - 6;
            $years = range($startYear, $endYear);
            $jumlahPerYear = array_fill(0, count($years), 0);
        } else {
            $minYear = (int) array_key_first($perYear);
            $endYear = Carbon::now()->year;
            $startYear = min($minYear, $endYear - 6);
            $years = range($startYear, $endYear);
            $jumlahPerYear = [];
            foreach ($years as $y) {
                $jumlahPerYear[] = isset($perYear[$y]) ? (int) $perYear[$y] : 0;
            }
        }

        $tahun = array_values($years);
        $jumlahStudi = array_values($jumlahPerYear);

        return view('dashboard.index', compact(
            'totalDosen',
            'jumlahTataUsaha',
            'jumlahStafProdi',
            'izinBelajar',
            'tugasBelajar',
            'studiLanjut',
            'jumlahDalam',
            'jumlahLuar',
            'periodeStudi',
            'statusDalam',
            'statusLuar',
            'studiDalam',
            'studiLuar',
            'notifications',
            'tahun',
            'jumlahStudi'
        ));
    }
}
