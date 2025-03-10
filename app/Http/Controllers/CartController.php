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
                    'name' => $product->name,
                    'price' => $product->price,
                    'stock' => $product->stock,
                    'quantity' => $details['quantity'],
                    'image' => $product->image,
                ];
            }
        }

        return view('cart.index', compact('updatedCart'));
    }

    public function add(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Product added to cart successfully!']);
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