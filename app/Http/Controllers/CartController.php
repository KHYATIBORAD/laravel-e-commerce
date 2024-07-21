<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = $user->cart;

        return view('cart', compact('cart'));
    }

    public function add(Request $request, $productId) {
        $user = Auth::user();
        $cart = $user->cart()->firstOrCreate([]);

        $cart->products()->attach($productId);

        return redirect()->route('cart')->with('success', 'Product added to cart!');
    }

    public function remove($productId) {
        $user = Auth::user();
        $cart = $user->cart;

        $cart->products()->detach($productId);

        if ($cart->products()->count() == 0) {
            $cart->delete();
        }

        return redirect()->route('cart')->with('success', 'Product removed from cart!');
    }
}
