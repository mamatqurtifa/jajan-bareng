<x-app-layout>
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-6">My Orders</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            @if($orders->isEmpty())
                <p class="text-gray-700">You have no orders.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-3 px-6 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase">Order ID</th>
                                <th class="py-3 px-6 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase">Organization</th>
                                <th class="py-3 px-6 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase">Total Price</th>
                                <th class="py-3 px-6 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase">Status</th>
                                <th class="py-3 px-6 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="py-4 px-6 border-b border-gray-300">{{ $order->id }}</td>
                                    <td class="py-4 px-6 border-b border-gray-300">{{ $order->organization->name }}</td>
                                    <td class="py-4 px-6 border-b border-gray-300">Rp{{ number_format($order->total_price, 0) }}</td>
                                    <td class="py-4 px-6 border-b border-gray-300">{{ ucfirst($order->status) }}</td>
                                    <td class="py-4 px-6 border-b border-gray-300">
                                        <a href="{{ route('orders.show', $order->id) }}" class="text-blue-500 hover:underline">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>