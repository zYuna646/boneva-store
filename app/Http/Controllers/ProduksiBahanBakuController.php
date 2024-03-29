<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Catalog;
use App\Models\Produks;
use App\Models\Produksi_Bahan_Baku;
use Illuminate\Http\Request;
use PDF;


class ProduksiBahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.Produksi_Bahan.index', [
            'title' => 'Produksi Bahan Baku',
            'subtitle' => '',
            'active' => 'produksi_bahan',
            'datas' => Produksi_Bahan_Baku::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.Produksi_Bahan.create', [
            'title' => 'Produksi Bahan Baku',
            'subtitle' => 'Add Produksi Bahan Baku',
            'active' => 'produksi_bahan',
            'catalog' => Bahan::all(),
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
                'catalog_id' => 'required',
                'jumlah' => 'required',
            ],
            [
            ]
        );

        $bahan = Bahan::findOrFail($request->catalog_id);
        $bahan->update([
            'jumlah' => $bahan->jumlah + $request->jumlah,
        ]);

        Produksi_Bahan_Baku::create([
            'bahan_id' => $request->catalog_id,
            'jumlah_produksi' => $request->jumlah,
        ]);

        return redirect()->route('admin.produksi_bahan')->with('success', 'Bahan Baku has been added!');
    }

    public function report(Request $request)
    {
        $this->validate(
            $request,
            [
                'start_date' => 'required',
            ],
            [
            ]
        );

        $start_date = \Carbon\Carbon::parse($request->start_date)->format('Y-m-d');

        if ($request->has('end_date') && !empty($request->end_date)) {
            $end_date = \Carbon\Carbon::parse($request->end_date)->format('Y-m-d');
            $produksi = Produksi_Bahan_Baku::whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            $produksi = Produksi_Bahan_Baku::whereDate('created_at', $start_date)->get();
        }
        $data = [
            'produksi' => $produksi,
        ];
        $pdf = PDF::loadView('admin.master-data.Produksi_Bahan.report', $data)->setPaper('a4', 'portrait');
        return $pdf->download('Produksi Bahan Baku.pdf');
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
}
