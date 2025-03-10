<x-app-layout>
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Organizations</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($organizations as $organization)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="aspect-w-1 aspect-h-1">
                        <img src="{{ asset('storage/' . $organization->image) }}" class="w-full h-full object-cover" alt="{{ $organization->name }}">
                    </div>
                    <div class="p-4">
                        <h5 class="text-lg font-semibold">{{ $organization->name }}</h5>
                        <p class="text-gray-700 mt-2">{{ $organization->description }}</p>
                        <a href="{{ route('organization.products', $organization->name) }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">View Products</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>