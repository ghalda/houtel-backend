<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiHotelController extends Controller
{

    public function hotelRekomendasi()
    {
        try {
            $data = DB::table('hotels')
                ->select(DB::raw('hotels.*, kotas.nama_kota ')) // memilih field apa saja yg akan ditampilkan sesuai tabel masing"
                ->join('kotas', 'kotas.id', 'hotels.kota_id')
                ->where('hotels.status_publish','Y') // di mana status_publish pada tabel hotels = 'Y'
                ->where('hotels.status_rekomendasi','Y')
                ->orderBy('hotels.nama_hotel', 'ASC')
                ->limit(3)
                ->get();

            // distribusikan datanya
            return response()->json([
                'success' => true,
                'message' => "Success",
                'hotel'    => $data
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => "Failed : " . $error->getMessage(),
                'hotel'    => null
            ], 500);
        }
    }

    public function listHotel()
    {
        try {
            $data = DB::table('hotels')
                ->select(DB::raw('hotels.*, kotas.nama_kota ')) // memilih field apa saja yg akan ditampilkan sesuai tabel masing"
                ->join('kotas', 'kotas.id', 'hotels.kota_id')
                ->where('hotels.status_publish','Y') // di mana status_publish pada tabel hotels = 'Y'
                ->orderBy('hotels.nama_hotel', 'ASC')
                ->get();

            // distribusikan datanya
            return response()->json([
                'success' => true,
                'message' => "Success",
                'hotel'    => $data
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => "Failed : " . $error->getMessage(),
                'hotel'    => null
            ], 500);
        }
    }

    public function detailHotel($id)
    {
        try {
            $data = DB::table('hotels')
                ->select(DB::raw('hotels.*, kotas.nama_kota ')) // memilih field apa saja yg akan ditampilkan sesuai tabel masing"
                ->join('kotas', 'kotas.id', 'hotels.kota_id')
                ->where('hotels.id', $id)
                ->where('hotels.status_publish','Y') // di mana status_publish pada tabel hotels = 'Y'
                ->first();

            if ($data) {
                // distribusikan datanya
                return response()->json([
                    'success' => true,
                    'message' => "Success",
                    'hotel'    => $data
                ], 200);
            } else {
                // distribusikan datanya
                return response()->json([
                    'success' => false,
                    'message' => "Not Found",
                    'hotel'    => $data
                ], 404);
            }
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => "Failed : " . $error->getMessage(),
                'hotel'    => null
            ], 500);
        }
    }

    public function searchHotel(Request $request)
    {
        $keyword = $request->keyword;

        try {

            $data = DB::table('hotels')
                ->select(DB::raw('hotels.*, kotas.nama_kota ')) // memilih field apa saja yg akan ditampilkan sesuai tabel masing"
                ->join('kotas', 'kotas.id', 'hotels.kota_id')
                ->where('hotels.status_publish','Y') // di mana status_publish pada tabel hotels = 'Y'
                ->where('hotels.nama_hotel','like','%'. $keyword . '%')
                ->orWhere('kotas.nama_kota','like','%'. $keyword . '%')
                ->get();

            if($data) {
                // distribusikan datanya
                return response()->json([
                    'success' => true,
                    'message' => "Success",
                    'hotel'    => $data
                ], 200);
            } else {
                // distribusikan datanya
                return response()->json([
                    'success' => false,
                    'message' => "Not found",
                    'hotel'    => $data // []
                ], 404);
            }

        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => "Failed : " . $error->getMessage(),
                'hotel'    => null
            ], 500);
        }
    }

    public function searchRekomendasiHotel(Request $request)
    {
        $keyword = $request->keyword;

        try {

            $data = DB::table('hotels')
                ->select(DB::raw('hotels.*, kotas.nama_kota ')) // memilih field apa saja yg akan ditampilkan sesuai tabel masing"
                ->join('kotas', 'kotas.id', 'hotels.kota_id')
                ->where('hotels.status_publish','Y') // di mana status_publish pada tabel hotels = 'Y'
                ->where('hotels.status_rekomendasi','Y') // di mana status_rekomendasi pada tabel hotels = 'Y'
                ->where('hotels.nama_hotel','like','%'. $keyword . '%')
                ->orWhere('kotas.nama_kota','like','%'. $keyword . '%')
                ->get();

            if($data) {
                // distribusikan datanya
                return response()->json([
                    'success' => true,
                    'message' => "Success",
                    'hotel'    => $data
                ], 200);
            } else {
                // distribusikan datanya
                return response()->json([
                    'success' => false,
                    'message' => "Not found",
                    'hotel'    => $data // []
                ], 404);
            }

        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => "Failed : " . $error->getMessage(),
                'hotel'    => null
            ], 500);
        }
    }
}
