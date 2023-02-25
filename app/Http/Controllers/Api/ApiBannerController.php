<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Exception;
use Illuminate\Http\Request;

class ApiBannerController extends Controller
{
    public function listBanner(Request $request)
    {
        try {
            $position = $request->position;

            if($position === 'Top'){
                $data = Banner::where('position', 'Top')->where('status_publish', '1')->first();
            } elseif($position === 'Middle'){
                $data = Banner::where('position', 'Middle')->where('status_publish', '1')->first();
            } elseif($position === 'Bottom'){
                $data = Banner::where('position', 'Bottom')->where('status_publish', '1')->first();
            }

            if ($data) {
                // distribusikan datanya
                return response()->json([
                    'success' => true,
                    'message' => "Success",
                    'banner'    => $data
                ], 200);
            } else {
                // distribusikan datanya
                return response()->json([
                    'success' => false,
                    'message' => "Not Found",
                    'banner'    => $data
                ], 404);
            }
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => "Failed : " . $error->getMessage(),
                'banner'    => null
            ], 500);
        }
    }
}
