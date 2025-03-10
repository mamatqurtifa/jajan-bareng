<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $currentDate = $request->input('date', Carbon::today()->toDateString());
        $products = Product::where('available_date', $currentDate)->get();

        return view('products.index', compact('products', 'currentDate'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }
}