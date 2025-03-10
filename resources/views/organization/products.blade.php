<x-app-layout>
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Products for {{ $organization->name }}</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-48 object-cover" alt="{{ $product->name }}">
                    <div class="p-4">
                        <h5 class="text-lg font-semibold">{{ $product->name }}</h5>
                        <p class="text-gray-700 mt-2">Rp{{ number_format($product->price, 0) }}</p>
                        <p class="text-gray-700 mt-2">Stock: {{ $product->stock }}</p>
                        
                        @php
                            $cart = session()->get('cart', []);
                            $inCart = isset($cart[$product->id]);
                        @endphp

                        @if($inCart)
                            <p class="text-green-500 mt-4">This product is already in your cart.</p>
                        @else
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Add to Cart</button>
                            </form>
                        @endif

                        <a href="{{ route('product.show', $product->id) }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>