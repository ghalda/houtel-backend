<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KotaController extends Controller
{
    public function index()
    {
        // menampilkan halaman list kota
        $data = DB::table('kotas')->orderBy('nama_kota', 'ASC')->get(); // SELECT * FROM kotas ORDER BY nama_kota ASC
        return view('kota.index', [
            'data' => $data,
            'title' => "Data Kota"
        ]);
    }

    public function add()
    {
        return view('kota.add');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'nama_kota' => 'required',
            'cover' => 'required|image|file|max:2048'
        ]);

        try {
            // upload file
            $pathGambar = $request->file('cover')->store('kota-images');

            // function insert datanya
            Kota::create([
                'nama_kota' => $request->nama_kota,
                'cover' => $pathGambar,
                'status_publish' => $request->status_publish
            ]);

            return redirect('kota')->with([
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
        $data = Kota::where('id', $id)->first(); // SELECT * FROM kotas WHERE id = $id

        return view('kota.edit', compact('data'));
    }

    public function update(Request $request)
    {
        try {

            // ambil data kota yg dipilih berdasarkan idnya
            $kota = Kota::find($request->id);

            // cek apakah user mengupload file baru
            if ($request->file('cover')) {

                // hapus file lamanya
                Storage::delete($kota->cover);

                // upload file baru
                $pathGambar = $request->file('cover')->store('kota-images');
            } else {
                // kalo tidak upload, ambil nilai lama pd field cover
                $pathGambar = $kota->cover; //kota-images/namafile.ekstensi
            }

            $kota->update([
                'nama_kota' => $request->nama_kota,
                'cover' => $pathGambar,
                'status_publish' => $request->status_publish
            ]);

            return redirect('kota')->with([
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
            // ambil dulu data kota yg dipilih berdasarkan id
            // fungsinya untuk mengambil nilai cover agar bisa diseleksi dan dihapus filenya
            $data = Kota::find($id);

            // hapus filenya jika ada
            if ($data->cover) {
                // hapus filenya
                Storage::delete($data->cover);
            }

            // hapus data record pd tabel kotas berdasarkan id
            Kota::destroy($id);

            // arahkan kembali ke route yg namanya kota
            return redirect('kota')->with([
                'success' => 'Delete data success!'
            ]);

        } catch (Exception $error) {
            return redirect()->back()->with([
                'error' => 'Error : ' . $error->getMessage()
            ]);
        }
    }
}
