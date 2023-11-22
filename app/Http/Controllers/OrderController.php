<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\MainSlider;
use App\Models\Order;
use App\Models\Paymen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class OrderController extends Controller
{
    public function order(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect('login')->with('failed', 'Login Terlebih Dahulu');
        }

        $cartOrder = Order::where('user_id', auth()->user()->id)
            ->where('status', 'cart')
            ->first();

        $product = Catalog::findOrFail($id);
        if ($cartOrder == null) {
            Order::create([
                'user_id' => auth()->user()->id,
                'status' => 'cart',
                'items' => json_encode([
                    $product->id => $product->minimum,
                ])
            ]);
        } else {
            $json = json_decode($cartOrder->items, true);
            try {
                $json[$product->id] = $json[$product->id] + 1;
            } catch (\Throwable $th) {
                $json[$product->id] = 1;
            }

            $cartOrder->update([
                'items' => json_encode($json),
            ]);
        }
        return redirect('cart');
    }


    public function cart()
    {
        if (!Auth::check()) {
            return redirect('login')->with('failed', 'Login Terlebih Dahulu');
        }

        $cartOrder = Order::where('user_id', auth()->user()->id)
            ->where('status', 'cart')
            ->first();

        try {
            $product = json_decode($cartOrder->items, true);

            $total = 0;
            foreach ($product as $key => $value) {
                $total += Catalog::find($key)->price * $value;
            }
        } catch (\Throwable $th) {
            $product = [];
            $total = 0;
        }



        return view('front.cart', [
            'title' => 'Cart',
            'mainSliders' => MainSlider::latest()->get(),
            'product' => $product,
            'related_products' => '',
            'total' => $total,
            'order' => $cartOrder,
            'payment' => Paymen::first(),
        ]);
    }

    public function history()
    {
        if (!Auth::check()) {
            return redirect('login')->with('failed', 'Login Terlebih Dahulu');
        }
        $cartOrder = Order::where('user_id', auth()->user()->id)
            ->where('status', '<>', 'cart')
            ->get();

        return view('front.history', [

            'title' => 'Cart',
            'mainSliders' => MainSlider::latest()->get(),
            'related_products' => '',
            'order' => $cartOrder
        ]);
    }

    public function add(Request $request, $id)
    {
        $cartOrder = Order::where('user_id', auth()->user()->id)
            ->where('status', 'cart')
            ->first();

        $json = json_decode($cartOrder->items, true);
        $json[$id] = $json[$id] + 1;


        $cartOrder->update([
            'items' => json_encode($json),
        ]);

        $product = json_decode($cartOrder->items, true);

        return redirect('cart');
    }

    public function confirmation(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect('login')->with('failed', 'Login Terlebih Dahulu');
        }

        if ($request->category_id == 'bank') {

            $order = Order::findOrFail($id);

            $image = $request->file('image');
            $image_name = time() . '-' . rand(1, 100) . '-' . $id . '.' . $image->extension();
            $image->move(public_path('uploads/catalog/image'), $image_name);

            $order->update([
                'alamat' => $request->alamat_bank,
                'bukti' => $image_name,
                'status' => 'order',
                'method' => $request->category_id,
            ]);


        } else if ($request->category_id == 'cod') {
            $order = Order::findOrFail($id);

            $order->update([
                'alamat' => $request->alamat_cod,
                'status' => 'order',
                'method' => $request->category_id,
            ]);

        }

        return redirect()->route('cart.history');
    }

    public function cod(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect('login')->with('failed', 'Login Terlebih Dahulu');
        }


        $this->validate(
            $request,
            [
                'image' => 'required|image|mimes:png,jpg,jpeg',
            ],
            [
            ]
        );

        $order = Order::findOrFail($id);

        $image = $request->file('image');
        $image_name = time() . '-' . rand(1, 100) . '-' . $id . '.' . $image->extension();
        $image->move(public_path('uploads/catalog/image'), $image_name);

        $order->update([
            'bukti' => $image_name,
        ]);

        return redirect()->route('cart.history');
    }

    public function minus(Request $request, $id)
    {

        $cartOrder = Order::where('user_id', auth()->user()->id)
            ->where('status', 'cart')
            ->first();

        $json = json_decode($cartOrder->items, true);
        if (empty($json)) {
            $cartOrder->delete();
        } 
        else {
            $json[$id] = $json[$id] - 1;
            if($json[$id] < Catalog::find($id)->minimum)
            {
                unset($json[$id]);
            }
            else if ($json[$id] <= 0) {
                unset($json[$id]);
            }
            $cartOrder->update([
                'items' => json_encode($json),
            ]);
        }

        return redirect('cart');
    }
    /**
     * Display a listing of the resource.
     */
    public function index($method)
    {
        return view('admin.master-data.order.index', [
            'title' => 'Order ' . $method,
            'subtitle' => '',
            'active' => $method,
            'datas' => Order::Where('status', 'order')->where('method', $method)->get(),
            'route' => 'order'
        ]);
    }

    public function verified($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => 'success',
        ]);

        $message = 'Order has been verified';

        return redirect()->route('admin.history')->with('success', $message);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.catalog.create', [
            'title' => 'Catalog',
            'subtitle' => 'Add Product',
            'active' => 'catalog',
            'categories' => Category::orderBy('name', 'ASC')->get(),
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
                'name' => 'required|max:255|unique:catalogs,name',
                'category_id' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg',
                'other_images.*' => 'image|mimes:png,jpg,jpeg',
            ],
            [
                'name.required' => 'Product name is required!',
                'name.max' => 'Product name is too long!',
                'name.unique' => 'Product name is already exists!',
                'category_id.required' => 'Category is required!',
                'image.required' => 'Image is required!',
                'image.image' => 'Image must be an image!',
                'image.mimes' => 'Image must be a png, jpg, or jpeg!',
                'other_images.*.image' => 'Image must be an image!',
                'other_images.*.mimes' => 'Image must be a png, jpg, or jpeg!',
            ]
        );

        $price = $request->input('price');

        if (!empty($price)) {
            $price = intval(str_replace(',', '', $price));
        } else {
            $price = 0;
        }

        $stock = $request->input('stock');

        if (!empty($stock)) {
            $stock = intval(str_replace(',', '', $stock));
        } else {
            $stock = 0;
        }

        $slug = Str::slug($request->input('name'));

        $image = $request->file('image');
        $image_name = time() . '-' . rand(1, 100) . '-' . $slug . '.' . $image->extension();
        $image->move(public_path('uploads/catalog/image'), $image_name);

        $catalog = Catalog::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'image' => $image_name,
            'price' => $price,
            'stock' => $stock,
            'fabric' => $request->input('fabric'),
        ]);

        if ($request->hasFile('other_images')) {
            $other_images = $request->file('other_images');

            foreach ($other_images as $other_image) {
                $other_image_name = time() . '-' . rand(1, 100) . '-' . $slug . '.' . $other_image->extension();
                $other_image->move(public_path('uploads/catalog/other-image/'), $other_image_name);

                $catalog->catalogImages()->create([
                    'catalog_id' => $catalog->id,
                    'image' => $other_image_name,
                ]);
            }
        }

        return redirect()->route('admin.catalog')->with('success', 'Product has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cartOrder = Order::findOrFail($id);
        try {
            $product = json_decode($cartOrder->items, true);

            $total = 0;
            foreach ($product as $key => $value) {
                $total += Catalog::find($key)->price * $value;
            }
        } catch (\Throwable $th) {
            $product = [];
            $total = 0;
        }

        return view('admin.master-data.order.show', [
            'title' => 'Order',
            'subtitle' => 'order Detail',
            'active' => 'order',
            'data' => Order::findOrFail($id),
            'product' => $product,
            'total' => $total,
            'order' => $cartOrder
        ]);
    }

    public function report()
    {
        $order = Order::Where('status', 'success')->get();
        $catalog = Catalog::all();

        $jumlah = [];

        foreach ($catalog as $item) {
            $jumlah[$item->id] = 0;
            foreach ($order as $result) {
                $json = json_decode($result->items, true);
                try {
                    $jumlah[$item->id] = $json[$item->id];
                    +$jumlah[$item->id];
                } catch (\Throwable $th) {

                }
            }
        }


        $data = [
            'catalog' => $catalog,
            'jumlah' => $jumlah,
        ];

        $pdf = PDF::loadView('admin.master-data.order.report')->setPaper('a4', 'portrait');
        return $pdf->download('history_order.pdf');

    }

    public function show_order($id)
    {
        $cartOrder = Order::findOrFail($id);
        try {
            $product = json_decode($cartOrder->items, true);

            $total = 0;
            foreach ($product as $key => $value) {
                $total += Catalog::find($key)->price * $value;
            }
        } catch (\Throwable $th) {
            $product = [];
            $total = 0;
        }

        return view('front.show', [
            'title' => 'Order',
            'subtitle' => 'order Detail',
            'active' => 'order',
            'data' => Order::findOrFail($id),
            'product' => $product,
            'total' => $total,
            'order' => $cartOrder
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Catalog::findOrFail($id);
        $price = number_format($data->price, 0, ',', ',');

        return view('admin.master-data.catalog.edit', [
            'title' => 'Catalog',
            'subtitle' => 'Edit Product',
            'active' => 'catalog',
            'data' => $data,
            'price' => $price,
            'categories' => Category::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function send()
    {
        return view('admin.master-data.order.history', [
            'title' => 'History',
            'subtitle' => '',
            'active' => 'history',
            'datas' => Order::Where('status', 'success')->get(),
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
                'name' => 'required|max:255|unique:catalogs,name,' . $id,
                'category_id' => 'required',
                'image' => 'image|mimes:png,jpg,jpeg',
                'other_images.*' => 'image|mimes:png,jpg,jpeg',
            ],
            [
                'name.required' => 'Product name is required!',
                'name.max' => 'Product name is too long!',
                'name.unique' => 'Product name is already exists!',
                'category_id.required' => 'Category is required!',
                'image.image' => 'Image must be an image!',
                'image.mimes' => 'Image must be a png, jpg, or jpeg!',
                'other_images.*.image' => 'Image must be an image!',
                'other_images.*.mimes' => 'Image must be a png, jpg, or jpeg!',
            ]
        );

        $price = $request->input('price');

        if (!empty($price)) {
            $price = intval(str_replace(',', '', $price));
        } else {
            $price = 0;
        }

        $stock = $request->input('stock');

        if (!empty($stock)) {
            $stock = intval(str_replace(',', '', $stock));
        } else {
            $stock = 0;
        }

        $catalog = Catalog::findOrFail($id);

        $slug = Str::slug($request->input('name'));

        if ($request->hasFile('image')) {
            $current_image = $request->input('current_image');
            $image = $request->file('image');
            $image_name = time() . '-' . rand(1, 100) . '-' . $slug . '.' . $image->extension();
            $image->move(public_path('uploads/catalog/image'), $image_name);

            if ($current_image) {
                unlink(public_path('uploads/catalog/image/' . $current_image));
            }

            $catalog->update([
                'name' => $request->input('name'),
                'slug' => $slug,
                'category_id' => $request->input('category_id'),
                'description' => $request->input('description'),
                'image' => $image_name,
                'price' => $price,
                'stock' => $stock,
                'fabric' => $request->input('fabric'),
            ]);
        } else {
            $catalog->update([
                'name' => $request->input('name'),
                'slug' => $slug,
                'category_id' => $request->input('category_id'),
                'description' => $request->input('description'),
                'price' => $price,
                'stock' => $stock,
                'fabric' => $request->input('fabric'),
            ]);
        }

        if ($request->hasFile('other_images')) {
            $other_images = $request->file('other_images');

            foreach ($other_images as $other_image) {
                $other_image_name = time() . '-' . rand(1, 100) . '-' . $slug . '.' . $other_image->extension();
                $other_image->move(public_path('uploads/catalog/other-image/'), $other_image_name);

                $catalog->catalogImages()->create([
                    'catalog_id' => $catalog->id,
                    'image' => $other_image_name,
                ]);
            }
        }

        return redirect()->route('admin.catalog')->with('success', 'Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $productImage = $order->bukti;

        if ($productImage) {
            unlink(public_path('uploads/catalog/image/' . $productImage));
        }
        $order->delete();

        return redirect()->route('admin.order')->with('success', 'Order has been deleted!');
    }

    public function destroyImage($id)
    {
        $image = CatalogImage::findOrFail($id);
        $image_name = $image->image;

        if ($image_name) {
            unlink(public_path('uploads/catalog/other-image/' . $image_name));
        }

        $image->delete();

        return redirect()->back()->with('success', 'Image has been deleted!');
    }

    public function gallery()
    {
        $catalogs = Catalog::latest()->filter(request(['category']))->paginate(12)->withQueryString();

        return view('admin.master-data.gallery.index', [
            'title' => 'Gallery',
            'subtitle' => '',
            'active' => 'gallery',
            'catalogs' => $catalogs,
            'categories' => Category::orderBy('name', 'ASC')->get(),
        ]);
    }
}
