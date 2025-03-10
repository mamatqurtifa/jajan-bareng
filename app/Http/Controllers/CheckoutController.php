<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Filament\Facades\Filament;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('checkout.index', compact('cart'));
    }

    public function process(Request $request)
    {
        $user = Filament::auth()->user();

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Group products by organization ID
        $groupedCart = [];
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            $organizationId = $product->organization_id;
            if (!isset($groupedCart[$organizationId])) {
                $groupedCart[$organizationId] = [];
            }
            $groupedCart[$organizationId][$id] = $details;
        }

        // Create orders for each organization
        foreach ($groupedCart as $organizationId => $products) {
            // Create a new order
            $order = new Order();
            $order->user_id = $user->id;
            $order->organization_id = $organizationId;
            $order->status = 'pending';
            $order->total_price = array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $products));
            $order->save();

            // Create order items
            foreach ($products as $id => $details) {
                $product = Product::find($id);
                if ($product->stock < $details['quantity']) {
                    return redirect()->route('cart.index')->with('error', 'One or more items in your cart are out of stock.');
                }

                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $id;
                $orderItem->quantity = $details['quantity'];
                $orderItem->subtotal = $details['price'] * $details['quantity'];
                $orderItem->save();

                // Decrease product stock
                $product->stock -= $details['quantity'];
                $product->save();
            }
        }

        // Clear the cart
        session()->forget('cart');

        return redirect()->route('dashboard')->with('success', 'Your orders have been placed successfully.');
    }
}
