<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Kota;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index()
    {
        // menampilkan halaman list hotel
        // $data = DB::table('hotels')->orderBy('nama_hotel', 'ASC')->get(); // SELECT * FROM hotels ORDER BY nama_hotel ASC

        $data = DB::table('hotels')
            ->select(DB::raw('hotels.*, kotas.nama_kota ')) // memilih field apa saja yg akan ditampilkan sesuai tabel masing"
            ->join('kotas', 'kotas.id', 'hotels.kota_id')
            ->orderBy('hotels.nama_hotel', 'ASC')
            ->get(); // SELECT hotels.*, kotas.nama_kota FROM hotels JOIN kotas ON kotas.id = hotels.kota_id ORDER BY hotels.nama_hotel ASC
        
        $data2 = Hotel::orderBy('nama_hotel','ASC')->get(); // SELECT * FROM hotels JOIN kotas ON kotas.id = hotels.kota_id ORDER BY hotels.nama_hotel ASC

        return view('hotel.index', [
            'data' => $data,
            'data2' => $data2,
            'title' => "Data Hotel"
        ]);
    }

    // function menampilkan data kota
    public function dataKota()
    {
        $data = Kota::orderBy('nama_kota', 'ASC')->where('status_publish', '1')->get();

        return $data;
    }

    public function add()
    {
        // menampilkan list kota dari tabel kotas
        $kota = $this->dataKota();
        return view('hotel.add', compact('kota'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'nama_hotel' => 'required',
            'status_publish' => 'required',
            'status_rekomendasi' => 'required',
            'gambar' => 'required|image|file|max:2048'
        ]);

        try {
            // upload file
            $pathGambar = $request->file('gambar')->store('hotel-images');

            // function insert datanya
            Hotel::create([
                'nama_hotel' => $request->nama_hotel,
                'kota_id' => $request->kota_id,
                'gambar' => $pathGambar,
                'alamat' => $request->alamat,
                'status_publish' => $request->status_publish,
                'status_rekomendasi' => $request->status_rekomendasi,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'rating' => $request->rating
            ]);

            return redirect('hotel')->with([
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
        $data = Hotel::where('id', $id)->first(); // SELECT * FROM hotels WHERE id = $id
        // menampilkan list kota dari tabel kotas
        $kota = $this->dataKota();

        return view('hotel.edit', compact('data', 'kota'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_hotel' => 'required',
            'status_publish' => 'required',
            'status_rekomendasi' => 'required',
            'gambar' => 'nullable|image|file|max:2048'
        ]);

        try {

            // ambil data hotel yg dipilih berdasarkan idnya
            $hotel = Hotel::find($request->id);

            // cek apakah user mengupload file baru
            if ($request->file('gambar')) {

                // hapus file lamanya
                Storage::delete($hotel->gambar);

                // upload file baru
                $pathGambar = $request->file('gambar')->store('hotel-images');
            } else {
                // kalo tidak upload, ambil nilai lama pd field gambar
                $pathGambar = $hotel->gambar; //hotel-images/namafile.ekstensi
            }

            $hotel->update([
                'nama_hotel' => $request->nama_hotel,
                'kota_id' => $request->kota_id,
                'gambar' => $pathGambar,
                'alamat' => $request->alamat,
                'status_publish' => $request->status_publish,
                'status_rekomendasi' => $request->status_rekomendasi,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'rating' => $request->rating
            ]);

            return redirect('hotel')->with([
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
            // ambil dulu data hotel yg dipilih berdasarkan id
            // fungsinya untuk mengambil nilai gambar agar bisa diseleksi dan dihapus filenya
            $data = Hotel::find($id);
           
            // hapus filenya jika ada
            if ($data->gambar) {
                // hapus filenya
                Storage::delete($data->gambar);
            }

            // hapus data record pd tabel hotels berdasarkan id
            $dd = Hotel::destroy($id);
           
            // arahkan kembali ke route yg namanya hotel
            return redirect('hotel')->with([
                'success' => 'Delete data success!'
            ]);
        } catch (Exception $error) {
           
            return redirect()->back()->with([
                'error' => 'Error : ' . $error->getMessage()
            ]);
        }
    }
}
