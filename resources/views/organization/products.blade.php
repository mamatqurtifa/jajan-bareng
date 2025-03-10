<x-app-layout>
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Products for {{ $organization->name }}</h1>

        <!-- Form to Change Date -->
        <form id="dateForm" action="{{ route('organization.products', $organization->name) }}" method="GET" class="mb-6">
            <label for="date" class="block text-gray-700">Select Date:</label>
            <input type="date" name="date" id="date" value="{{ $currentDate }}" class="mt-2 p-2 border rounded">
        </form>

        @if($products->isEmpty())
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                <h2 class="text-xl font-bold mb-4">No items available on this date</h2>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($products as $product)
                    @if($product->available_date == $currentDate)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-48 object-cover" alt="{{ $product->name }}">
                            <div class="p-4">
                                <h5 class="text-lg font-semibold">{{ $product->name }}</h5>
                                <p class="text-gray-700 mt-2">Rp{{ number_format($product->price, 0) }}</p>
                                <p class="text-gray-700 mt-2">Stock: {{ $product->stock }}</p>
                                <p class="text-gray-700 mt-2">Available Date: {{ $product->available_date }}</p>
                                
                                @php
                                    $cart = session()->get('cart', []);
                                    $inCart = isset($cart[$product->id]);
                                    $currentRealDate = \Carbon\Carbon::today()->toDateString();
                                @endphp

                                @if($product->stock == 0)
                                    <p class="text-red-500 mt-4">Out of Stock</p>
                                @elseif($inCart)
                                    <p class="text-green-500 mt-4">This product is already in your cart.</p>
                                @elseif($product->available_date < $currentRealDate)
                                    <p class="text-red-500 mt-4">This product is no longer available for purchase.</p>
                                @else
                                    <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Add to Cart</button>
                                    </form>
                                @endif

                                <a href="{{ route('product.show', $product->id) }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">View Details</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>

    <script>
        document.getElementById('date').addEventListener('change', function() {
            document.getElementById('dateForm').submit();
        });

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