<x-app-layout>
    <div class="container mx-auto my-8 px-4">
        <div class="bg-white shadow-md rounded-lg overflow-hidden flex">
            <div class="w-1/2">
                <div class="aspect-w-1 aspect-h-1">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover" alt="{{ $product->name }}">
                </div>
            </div>
            <div class="w-1/2 p-6">
                <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                <p class="text-gray-700 mb-4">{{ $product->description }}</p>
                <p class="text-gray-900 text-xl font-bold mb-4">Rp{{ number_format($product->price, 0) }}</p>
                <p class="text-gray-700 mb-4">Stock: {{ $product->stock }}</p>
                <p class="text-gray-700 mb-4">Available Date: {{ $product->available_date }}</p>
                <p class="text-gray-700 mb-4">Organization: {{ $product->organization->name }}</p> <!-- Display organization name -->
                
                @php
                    $cart = session()->get('cart', []);
                    $inCart = isset($cart[$product->id]);
                    $currentRealDate = \Carbon\Carbon::today()->toDateString();
                @endphp

                @if($product->stock == 0)
                    <p class="text-red-500 mb-4">Out of Stock</p>
                @elseif($inCart)
                    <p class="text-green-500 mb-4">This product is already in your cart.</p>
                @elseif($product->available_date < $currentRealDate)
                    <p class="text-red-500 mb-4">This product is no longer available for purchase.</p>
                @else
                    <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Add to Cart</button>
                    </form>
                @endif

                <a href="{{ route('organization.products', $product->organization->name) }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mt-4">Back to Products</a>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(this);
                const action = this.action;
                const button = this.querySelector('button[type="submit"]');

                fetch(action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const message = document.createElement('p');
                        message.classList.add('text-green-500', 'mt-4');
                        message.textContent = 'This product is already in your cart.';
                        button.parentNode.replaceChild(message, button);
                    } else {
                        alert('Failed to add product to cart.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            });
        });
    </script>
</x-app-layout>