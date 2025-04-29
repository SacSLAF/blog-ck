<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="font-bold text-2xl">HSD Blogging</a>
                </div>
            </div>
            <div class="flex items-center">
                @auth
                    <a href="{{ route('admin.posts.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2">Admin</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-gray-900 px-3 py-2">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
