<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Pemesanan;
use Exception;
use Illuminate\Http\Request;

class ApiPemesananController extends Controller
{
    public function postPemesanan(Request $request)
    {

        // tampung nilai hotel_id yg diinput
        $hotel_id = $request->hotel_id;
        // ambil data hotel berdasarkan hotel_id yg diinputkan
        $hotel = Hotel::where('id', $hotel_id)->where('status_publish','Y')->first();

        try {
            // jika data hotel tidak ditemukan
            if (!$hotel) {
                return response()->json([
                    'success' => false,
                    'message' => "Not Found",
                    'pesanan'    => null
                ], 404);
            } else {
                $post = Pemesanan::create([
                    'no_pemesanan' => 'HTL-' . date('d/m/Y H:i:s'),
                    'hotel_id' => $hotel_id,
                    'nama_pemesan' => $request->nama_pemesan,
                    'email_pemesan' => $request->email_pemesan,
                    'telp_pemesan' => $request->telp_pemesan,
                    'tipe_kamar' => $request->tipe_kamar,
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'total_harga' => $hotel->harga,
                ]);

                // distribusikan datanya
                return response()->json([
                    'success' => true,
                    'message' => "Success",
                    'pesanan'    => $post
                ], 200);
            }
        } catch (Exception $error) {
            // distribusikan datanya
            return response()->json([
                'success' => false,
                'message' => "Failed : " . $error->getMessage(),
                'pesanan'    => null
            ], 500);
        }
    }
}
