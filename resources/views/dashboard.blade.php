<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Total Users -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold text-gray-500">Total Users</h3>
                        <p class="text-3xl font-bold text-indigo-600">{{ \App\Models\User::count() }}</p>
                    </div>
                </div>

                <!-- Total Products -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold text-gray-500">Total Products</h3>
                        <p class="text-3xl font-bold text-purple-600">{{ \App\Models\Product::count() }}</p>
                    </div>
                </div>

                <!-- Total Orders (Placeholder) -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold text-gray-500">Recent Orders</h3>
                        <p class="text-3xl font-bold text-green-600">0</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Quick Actions</h3>
                    <div class="flex space-x-4">
                        <a href="{{ route('products.index') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            Manage Products
                        </a>
                        <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded cursor-not-allowed opacity-50">
                            Manage Orders (Coming Soon)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
