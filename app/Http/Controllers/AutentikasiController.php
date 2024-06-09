<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AutentikasiController extends Controller
{
    public function index(){
        return view('autentikasi.login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('dashboard.main-dashboard.index');
        }

        Alert::error('Username atau Password Salah!', 'Harap isi dengan username dan password yang sudah terdaftar');
        return back();
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

}
