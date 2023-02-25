<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //menampilkan halaman login
    public function login()
    {

        // jika keadaan sudah login
        if(Auth::check() == true) {
            // arahkan lagi ke halaman dashboard
            return redirect('dashboard');
        } else {
            // jika tidak
            return view('auth.login');
        }

    }

    // proses login
    public function loginProses(Request $request)
    {
        try {
            // mengecek autentikasi dengan menggunakan fungsi bawaan laravel
            Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ]);

            // cek apakah datanya sesuai dgn yg ada di tabel users?
            if(Auth::check()){
                // kalo ssuai, maka alihkan ke halaman dashboard
                return redirect('dashboard');
            } else {
                // kalo tidak ssuai, balikkan ke halaman login
                return redirect()->back()->with([
                    'error' => 'Email / password salah!'
                ]);
            }

        } catch (Exception $error) {
            return redirect()->back()->with([
                'error' => $error->getMessage()
            ]);
        }
    }

    // fungsi logout
    public function logout()
    {
        auth()->logout();

        return redirect('login');
    }
}
