<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;


class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.bahan.index', [
            'title' => 'Bahan Baku',
            'subtitle' => '',
            'active' => 'bahan',
            'datas' => Bahan::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.bahan.create', [
            'title' => 'Bahan Baku',
            'subtitle' => 'Add Bahan Baku',
            'active' => 'bahan',
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
                'category_name' => 'required|unique:categories,name',
                'jumlah' => 'required',
                'satuan' => 'required',
            ],
            [
                'category_name.required' => 'Category name is required!',
                'category_name.unique' => 'Category name is already exists!',
            ]
        );

        Bahan::create([
            'name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan
        ]);

        return redirect()->route('admin.bahan')->with('success', 'Bahan Baku has been added!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.master-data.bahan.edit', [
            'title' => 'Bahan Baku',
            'subtitle' => 'Edit Bahan Baku',
            'active' => 'bahan',
            'data' => Bahan::findOrFail($id),
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
                'category_name' => 'required|unique:categories,name,' . $id,
                'jumlah' => 'required',
                'satuan' => 'required',
            ],
            [
                'category_name.required' => 'Category name is required!',
                'category_name.unique' => 'Category name is already exists!',
            ]
        );

        $category = Bahan::findOrFail($id);

        $category->update([
            'name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan
        ]);

        return redirect()->route('admin.category')->with('success', 'Bahan Baku has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Bahan::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.bahan')->with('success', 'Bahan Baku has been deleted!');
    }

    public function report()
    {
        $pdf = PDF::loadView('admin.master-data.bahan.report')->setPaper('a4', 'portrait');
        return $pdf->download('bahan.pdf');
    }
}
