<x-app-layout>
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($updatedCart as $id => $details)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-48 object-cover" alt="{{ $details['name'] }}">
                    <div class="p-4">
                        <h5 class="text-lg font-semibold">{{ $details['name'] }}</h5>
                        <p class="text-gray-700 mt-2">Rp{{ number_format($details['price'], 0) }}</p>
                        <p class="text-gray-700 mt-2">Stock: {{ $details['stock'] }}</p>
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $id }}">
                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" max="{{ $details['stock'] }}" class="mt-2 p-2 border rounded">
                            <button type="submit" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update Quantity</button>
                        </form>
                        <form action="{{ route('cart.remove') }}" method="POST" class="mt-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $id }}">
                            <button type="submit" class="inline-block bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Remove</button>
                        </form>
                        <p class="text-gray-700 mt-2">Total: Rp{{ number_format($details['price'] * $details['quantity'], 0) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>