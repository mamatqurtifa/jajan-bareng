<x-app-layout>
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Checkout</h1>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            <h2 class="text-xl font-bold mb-4">Order Summary</h2>
            <ul>
                @foreach($updatedCart as $id => $details)
                    <li class="mb-4">
                        <div class="flex justify-between">
                            <div>
                                <h5 class="text-lg font-semibold">{{ $details['name'] }}</h5>
                                <p class="text-gray-700">Quantity: {{ $details['quantity'] }}</p>
                            </div>
                            <div>
                                <p class="text-gray-700">Rp{{ number_format($details['price'] * $details['quantity'], 0) }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <button type="submit" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Place Order</button>
            </form>
        </div>
    </div>
</x-app-layout>