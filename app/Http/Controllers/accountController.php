<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class accountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.user.index', [
            'title' => 'account',
            'subtitle' => '',
            'active' => 'account',
            'datas' => User::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.user.create', [
            'title' => 'account',
            'subtitle' => 'Add User',
            'active' => 'account',
            'categories' => User::orderBy('name', 'ASC')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'role' => 'required',
                'email' => 'required|email|unique:users,email',
                'new_password' => 'required|string|min:6',
                'confirm_new_password' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg',
                'no_telp' => 'required',
                'no_wa' => 'required',
                'no_ktp' => 'required',
                'npwp' => 'required',
            ],
            [
                'name.required' => 'name is required!',
            ]
        );

        $image = $request->file('image');
        $image_name = time() . '-' . rand(1, 100) . '-' . $request->name . '.' . $image->extension();
        $image->move(public_path('uploads/catalog/image'), $image_name);


        User::create([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => $request->new_password,
            'verified' => false,
            'no_telp' => $request->no_telp,
            'no_wa' => $request->no_wa,
            'foto_agen' => $image_name,
            'no_ktp' => $request->no_ktp,
            'npwp' => $request->npwp,
        ]);


        return redirect()->route('admin.account')->with('success', 'User has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('admin.master-data.user.show', [
            'title' => 'account',
            'subtitle' => 'User Detail',
            'active' => 'account',
            'data' => User::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);

        return view('admin.master-data.user.edit', [
            'title' => 'account',
            'subtitle' => 'Edit User',
            'active' => 'account',
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'role' => 'required',
                'email' => 'required|email|unique:users,email',
                'image' => 'required|image|mimes:png,jpg,jpeg',
                'no_telp' => 'required',
                'no_wa' => 'required',
                'no_ktp' => 'required',
                'npwp' => 'required',
            ],
            [
                'name.required' => 'name is required!',
            ]
        );

        $image = $request->file('image');
        $image_name = time() . '-' . rand(1, 100) . '-' . $request->name . '.' . $image->extension();
        $image->move(public_path('uploads/catalog/image'), $image_name);

        $user = User::findOrFail($id);

        if ($request->new_passowrd != null) {
            User::update([
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->new_password,
                'password' => $request->new_password,
                'no_telp' => $request->no_telp,
                'no_wa' => $request->no_wa,
                'foto_agen' => $image_name,
                'no_ktp' => $request->no_ktp,
                'npwp' => $request->npwp,
            ]);
        } else {
            User::update([
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->new_password,
                'no_telp' => $request->no_telp,
                'no_wa' => $request->no_wa,
                'foto_agen' => $image_name,
                'no_ktp' => $request->no_ktp,
                'npwp' => $request->npwp,
            ]);
        }


        return redirect()->route('admin.account')->with('success', 'User has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.account')->with('success', 'User has been deleted!');
    }

    public function verified($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'verified' => !$user->verified,
        ]);

        $message = !$user->verified ? 'User has been deverified' : 'User has been verified';

        return redirect()->route('admin.account')->with('success', $message);
    }

}
