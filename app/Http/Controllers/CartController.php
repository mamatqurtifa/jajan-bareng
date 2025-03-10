<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $updatedCart = [];

        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $updatedCart[$id] = [
                    "name" => $details['name'],
                    "quantity" => $details['quantity'],
                    "price" => $details['price'],
                    "image" => $details['image'],
                    "stock" => $product->stock // Read stock from the Product model
                ];
            }
        }

        return view('cart.index', compact('updatedCart'));
    }

    public function add(Request $request)
    {
        $product = Product::find($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            if ($cart[$product->id]['quantity'] < $product->stock) {
                $cart[$product->id]['quantity']++;
            } else {
                return redirect()->route('cart.index')->with('error', 'Quantity exceeds available stock!');
            }
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
                "stock" => $product->stock 
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->product_id;
        $quantity = $request->quantity;

        if (isset($cart[$productId])) {
            $product = Product::find($productId);
            if ($quantity <= $product->stock) {
                $cart[$productId]['quantity'] = $quantity;
                session()->put('cart', $cart);
                return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
            } else {
                return redirect()->route('cart.index')->with('error', 'Quantity exceeds available stock!');
            }
        }

        return redirect()->route('cart.index')->with('error', 'Product not found in cart!');
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
        }

        return redirect()->route('cart.index')->with('error', 'Product not found in cart!');
    }
}