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

        @if(count($updatedCart) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($updatedCart as $id => $details)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-48 object-cover" alt="{{ $details['name'] }}">
                        <div class="p-4">
                            <h5 class="text-lg font-semibold">{{ $details['name'] }}</h5>
                            <p class="text-gray-700 mt-2">Rp{{ number_format($details['price'], 0) }}</p>
                            <p class="text-gray-700 mt-2">Stock: {{ $details['stock'] }}</p>
                            <div class="flex items-center mt-2">
                                <button class="bg-gray-300 text-gray-700 px-2 py-1 rounded-l" onclick="updateQuantity('{{ $id }}', -1)">-</button>
                                <input type="number" name="quantity" id="quantity-{{ $id }}" value="{{ $details['quantity'] }}" min="1" max="{{ $details['stock'] }}" class="w-16 text-center border-t border-b border-gray-300">
                                <button class="bg-gray-300 text-gray-700 px-2 py-1 rounded-r" onclick="updateQuantity('{{ $id }}', 1)">+</button>
                            </div>
                            <form action="{{ route('cart.update') }}" method="POST" id="update-form-{{ $id }}" class="hidden">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <input type="hidden" name="quantity" id="hidden-quantity-{{ $id }}" value="{{ $details['quantity'] }}">
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
            <div class="mt-6">
                <a href="{{ route('checkout.index') }}" class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Proceed to Checkout</a>
            </div>
        @else
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                <h2 class="text-xl font-bold mb-4">Your cart is empty</h2>
                <a href="{{ route('organizations.index') }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Continue Shopping</a>
            </div>
        @endif
    </div>

    <script>
        function updateQuantity(productId, change) {
            const quantityInput = document.getElementById('quantity-' + productId);
            let newQuantity = parseInt(quantityInput.value) + change;
            if (newQuantity < 1) newQuantity = 1;
            if (newQuantity > parseInt(quantityInput.max)) newQuantity = parseInt(quantityInput.max);
            quantityInput.value = newQuantity;

            document.getElementById('hidden-quantity-' + productId).value = newQuantity;
            document.getElementById('update-form-' + productId).submit();
        }
    </script>
</x-app-layout>