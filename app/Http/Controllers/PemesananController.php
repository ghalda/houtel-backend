<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    public function index()
    {
        $data = DB::table('pemesanans')
            ->select(DB::raw('pemesanans.*, hotels.nama_hotel ')) // memilih field apa saja yg akan ditampilkan sesuai tabel masing"
            ->join('hotels', 'hotels.id', 'pemesanans.hotel_id')
            ->orderBy('pemesanans.created_at', 'ASC')
            ->get(); // SELECT pemesanans.*, hotels.nama_kota FROM pemesanans JOIN hotels ON hotels.id = pemesanans.kota_id ORDER BY pemesanans.nama_hotel ASC

        return view('pemesanan.index', [
            'data' => $data,
            'title' => "Data Hotel"
        ]);
    }
}
