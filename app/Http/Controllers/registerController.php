<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class registerController extends Controller
{
    function index()
    {
        return view("auth.register");
    }

    function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'verified' => false,
            'role' => 'agen',
            'password' => $request->password
        ]);

        return redirect('login')->with('success','Berhasil Mendaftar Akun Silahkan Tunggu Diverifikasi Oleh Admin');
    }

}
