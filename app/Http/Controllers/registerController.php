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
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'no_telp' => 'required',
            'no_wa' => 'required',
            'no_ktp' => 'required',
            'npwp' => 'required',
        ]);

        $image = $request->file('image');
        $image_name = time() . '-' . rand(1, 100) . '-' . $request->name . '.' . $image->extension();
        $image->move(public_path('uploads/catalog/image'), $image_name);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'verified' => false,
            'no_telp' => $request->no_telp,
            'no_wa' => $request->no_wa,
            'foto_agen' => $image_name,
            'no_ktp' => $request->no_ktp,
            'npwp' => $request->npwp,
        ]);

        return redirect('login')->with('success', 'Berhasil Mendaftar Akun Silahkan Tunggu Diverifikasi Oleh Admin');
    }

}
