<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // buat variabel untuk menyimpan data user hasil dari query tabel users

        // $data = User::all(); // ELOQUENT (Menggunakan Modelnya) all => SELECT * FROM users
        $data = User::orderBy('name', 'ASC')->get(); // ELOQUENT (Menggunakan Modelnya) all => SELECT * FROM users ORDER BY name ASC
        // $data = DB::table('users')->orderBy('name','ASC')->get(); // DB Query / Query builder

        // dd($data);
        return view('user.index', compact('data'));
    }

    // menampilkan form tambah
    public function add()
    {
        return view('user.add');
    }

    // insert data ke tabel
    public function insert(Request $request)
    {

        // fungsi validasi
        $request->validate(
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5',
            ],

            // message custom
            [
                'name.required' => 'Nama harus diisi!',
                'name.min' => 'Nama minimal 3 karakter!',
                'email.required' => 'Email harus diisi!',
                'email.unique' => 'Email sudah dipakai!',
            ]
        );

        // fungsi create data menggunakan Eloquent (Model) Laravel
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);

            //    User::insert([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'password' => Hash::make($request->password),
            //     'role' => $request->role,
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            //    ]);

            // $user = new User();
            // $user->name = $request->name;
            // $user->email = $request->email;
            // $user->password = Hash::make($request->password);
            // $user->role = $request->role;
            // $user->save();

            // kembalikan ke routing user (ke halaman utama saat menu user diklik)    
            return redirect('user')->with([
                'success' => 'Insert data success!'
            ]);
        } catch (Exception $error) {

            return redirect()->back()->with([
                'error' => 'Error : ' . $error->getMessage()
            ]);
        }
    }

    // function edit (mengambil satu data yg dipilih berdasarkan idnya/primary.nya/apapun yg mejadi paramert sesuai kebutuhan)
    // basicny hanya satu data yg diupdate berdasarkan data yg dipilih
    public function edit($id)
    {
        // query mengambil data berdasarkan idnya / data yg dipilihkan
        $data = User::find($id); // SELECT * FROM users WHERE id = $id, fungsi find itu wajib primary key.nya adalah id (kecuali kalo sudah diset di Modelnya)
        // dd($data);
        // tampilkan halaman form edit beserta ikutkan datanya ke dalam form edit tersebut
        return view('user.edit', compact('data'));
    }

    // function update data
    public function update(Request $request)
    {

        // fungsi validasi
        $request->validate(
            [
                'name' => 'required|min:3',
            ],

            // message custom
            [
                'name.required' => 'Nama harus diisi!',
                'name.min' => 'Nama minimal 3 karakter!',
            ]
        );

        // ambil data berdasarkan yg dipilih / berdasarkan id yg dikirim oleh form edit
        $user = User::where('id', $request->id); 
        // dd($user);

        try {
            // cek apakah user mengisi kolom password
            if ($request->password == "") {
                // maka passwordny tetap password yg lama (field password diupdate berdasarkan nilai yg lama / ambil nilai password lama
                // menggunakan object/ variabel yg telah dibuat ($user))
                // buat variabel password utk dikirim ke function update
                $getOldPassword = $user->first(); // first => mengambil satu data bersifat ASC berdasarkan parameter yg dipilih 
                $password = $getOldPassword->password;
            } else {
                $password = Hash::make($request->password);
            }

            // blok update role Admin menjadi kasir
            // cek role user yg login
            if(Auth::user()->role == "Adm") {
                // variabel penampung data user yg dipilih
                $userSelected = $user->first();
                // die dump (menampilkan data mentahan)
                // dd($userSelected->role);
                // bandingkan nilai role pd data yg dipilih sama dengan nilai role yg login
                if($userSelected->id == Auth::user()->id){
                    // dd("Y");
                    // variabel yg menampung nilai role, paksa nilainya menjadi Adm
                    $roleUpdate = "Adm";
                    // dd($roleUpdate);
                } else {
                    // dd("N");
                    // jika user yg dipilih rolenya bukan Adm
                    $roleUpdate = $request->role;
                    // dd($roleUpdate);
                }
            }

            // fungsi update nilai tabel
            // UPDATE users SET name = $request->name WHERE id = $id
            $user->update([
                'name' => $request->name,
                'password' => $password,
                'role' => $roleUpdate
            ]);

           return redirect('user')->with([
            'success' => 'Update data Success!',
           ]);

        } catch (Exception $error) {

           return redirect()->back()->with([
            'error' => 'Error : ' . $error->getMessage(),
           ]);
        }
    }

    // function delete data
    public function delete($id)
    {
        try {
            // User::where('id', $id)->delete();

            User::destroy($id); // destroy => fungsi untuk menghapus data berdasarkan primary key yg namanya "id" (default)

            return redirect('user')->with([
                'success' => 'Delete data success!'
            ]);

        } catch (Exception $error) {
            return redirect()->back()->with([
                'error' => 'Error : ' . $error->getMessage()
            ]);
        }
    }

}
