<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\MainSlider;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if($cartOrder == null)
        {
            Order::create([
                'user_id' => auth()->user()->id,
                'status' => 'cart',
                'items' => json_encode([
                    $product->id => 1
                ])
            ]);
        }
        else
        {
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
        

        $product = json_decode($cartOrder->items, true);

        return view('front.cart', [
            'title' => 'Cart',
            'mainSliders' => MainSlider::latest()->get(),
            'product' => $product,
            'related_products' => '',
        ]);
    }

    public function add()
    {

    }

    public function minus()
    {
        
    }
}
