<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Exception;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        // menampilkan halaman list Banner
        $data = DB::table('banners')->orderBy('nama_banner', 'ASC')->get(); // SELECT * FROM banners ORDER BY nama_banner ASC
        return view('banner.index', [
            'data' => $data,
            'title' => "Data Banner"
        ]);
    }

    public function add()
    {
        return view('banner.add');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'nama_banner' => 'required',
            'gambar_banner' => 'required|image|file|max:2048',
            'position' => 'required',
            'status_publish' => 'required'
        ]);

        try {
            // upload file
            $pathGambar = $request->file('gambar_banner')->store('banner-images');

            // function insert datanya
            Banner::create([
                'nama_banner' => $request->nama_banner,
                'gambar_banner' => $pathGambar,
                'position' => $request->position,
                'status_publish' => $request->status_publish
            ]);

            return redirect('banner')->with([
                'success' => 'Insert data success!'
            ]);
        } catch (Exception $error) {
            return redirect()->back()->with([
                'error' => "Error : " . $error->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $data = Banner::where('id', $id)->first(); // SELECT * FROM banners WHERE id = $id

        return view('banner.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_banner' => 'required',
            'gambar_banner' => 'nullable|image|file|max:2048',
            'position' => 'required',
            'status_publish' => 'required'
        ]);
        
        try {
            // ambil data Banner yg dipilih berdasarkan idnya
            $Banner = Banner::find($request->id);

            // cek apakah user mengupload file baru
            if ($request->file('gambar_banner')) {

                // hapus file lamanya
                Storage::delete($Banner->gambar_banner);

                // upload file baru
                $pathGambar = $request->file('gambar_banner')->store('banner-images');
            } else {
                // kalo tidak upload, ambil nilai lama pd field gambar_banner
                $pathGambar = $Banner->gambar_banner; //Banner-images/namafile.ekstensi
            }

            $Banner->update([
                'nama_banner' => $request->nama_banner,
                'gambar_banner' => $pathGambar,
                'position' => $request->position,
                'status_publish' => $request->status_publish
            ]);

            return redirect('banner')->with([
                'success' => 'Update data success!'
            ]);
        } catch (Exception $error) {
            return redirect()->back()->with([
                'error' => 'Error : ' . $error->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            // ambil dulu data Banner yg dipilih berdasarkan id
            // fungsinya untuk mengambil nilai gambar_banner agar bisa diseleksi dan dihapus filenya
            $data = Banner::find($id);

            // hapus filenya jika ada
            if ($data->gambar_banner) {
                // hapus filenya
                Storage::delete($data->gambar_banner);
            }

            // hapus data record pd tabel banners berdasarkan id
            Banner::destroy($id);

            // arahkan kembali ke route yg namanya Banner
            return redirect('banner')->with([
                'success' => 'Delete data success!'
            ]);
        } catch (Exception $error) {
            return redirect()->back()->with([
                'error' => 'Error : ' . $error->getMessage()
            ]);
        }
    }
}
