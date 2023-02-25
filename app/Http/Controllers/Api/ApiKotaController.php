<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiKotaController extends Controller
{
    public function listKota()
    {
        try {
            // menampilkan halaman list kota
            $data = DB::table('kotas')->orderBy('nama_kota', 'ASC')->get(); // SELECT * FROM kotas ORDER BY nama_kota ASC

            // distribusikan datanya
            return response()->json([
                'success' => true,
                'message' => "Success",
                'kota'    => $data
            ], 200);

            //HTTP Status Code (200 (success), 404 (not found), 500(error server), dll)
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => "Failed : " . $error->getMessage(),
                'kota'    => null
            ], 500);
        }
    }

    public function detailKota($id)
    {
        try {
            $data = Kota::where('id', $id)->first();
            if ($data) {
                // distribusikan datanya
                return response()->json([
                    'success' => true,
                    'message' => "Success",
                    'kota'    => $data
                ], 200);
            } else {
                // distribusikan datanya
                return response()->json([
                    'success' => false,
                    'message' => "Not Found",
                    'kota'    => $data
                ], 404);
            }
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => "Failed : " . $error->getMessage(),
                'kota'    => null
            ], 500);
        }
    }
}
