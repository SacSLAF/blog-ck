{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Users Tile -->
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Users</h3>
                    <p class="text-3xl font-bold text-blue-600">123</p>
                    <a href="{{ route('home') }}" class="text-sm text-blue-500 hover:underline mt-2 inline-block">Manage Users</a>
                </div>

                <!-- Posts Tile -->
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Posts</h3>
                    <p class="text-3xl font-bold text-green-600">87</p>
                    <a href="{{ route('home') }}" class="text-sm text-green-500 hover:underline mt-2 inline-block">View Posts</a>
                </div>

                <!-- Categories Tile -->
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Categories</h3>
                    <p class="text-3xl font-bold text-purple-600">15</p>
                    <a href="{{ route('home') }}" class="text-sm text-purple-500 hover:underline mt-2 inline-block">Browse Categories</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
