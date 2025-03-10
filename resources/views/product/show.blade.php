<x-app-layout>
    <div class="container mx-auto my-8 px-4">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-96 object-cover" alt="{{ $product->name }}">
            <div class="p-6">
                <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                <p class="text-gray-700 mb-4">{{ $product->description }}</p>
                <p class="text-gray-900 text-xl font-bold mb-4">Rp{{ number_format($product->price, 0) }}</p>
                <p class="text-gray-700 mb-4">Stock: {{ $product->stock }}</p>
                
                @php
                    $cart = session()->get('cart', []);
                    $inCart = isset($cart[$product->id]);
                @endphp

                @if($product->stock == 0)
                    <p class="text-red-500 mb-4">Out of Stock</p>
                @elseif($inCart)
                    <p class="text-green-500 mb-4">This product is already in your cart.</p>
                @else
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Add to Cart</button>
                    </form>
                @endif

                <a href="{{ route('organization.products', $product->organization->name) }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mt-4">Back to Products</a>
            </div>
        </div>
    </div>
</x-app-layout>