<x-app-layout>
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Order Details</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            <h2 class="text-xl font-bold mb-4">Order ID: {{ $order->id }}</h2>
            <p class="text-gray-700 mb-4">Organization: <span class="font-semibold">{{ $order->organization->name }}</span></p>
            <p class="text-gray-700 mb-4">Total Price: <span class="font-semibold">Rp{{ number_format($order->total_price, 0) }}</span></p>
            <p class="text-gray-700 mb-4">Status: <span class="font-semibold">{{ ucfirst($order->status) }}</span></p>
            <h3 class="text-lg font-bold mb-4">Order Items</h3>
            <ul>
                @if($order->orderItems->isNotEmpty())
                    @foreach($order->orderItems as $item)
                        <li class="mb-4 border-b pb-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h5 class="text-lg font-semibold">{{ $item->product->name }}</h5>
                                    <p class="text-gray-700">Quantity: {{ $item->quantity }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-700">Rp{{ number_format($item->subtotal, 0) }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="mb-4">
                        <p class="text-gray-700">No items found for this order.</p>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</x-app-layout>