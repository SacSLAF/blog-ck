@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6">Blog Posts</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($posts as $post)
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                <p class="text-gray-600 text-sm mb-4">
                    By {{ $post->author }} on {{ $post->published_at ? $post->published_at->format('M d, Y H:i') : 'Not published' }}
                </p>
                <div class="prose mb-4">
                    {!! Str::limit(strip_tags($post->content), 150) !!} <!-- Truncated content -->
                </div>
                <a href="{{ route('posts.show', $post) }}" class="bg-black text-white px-4 py-2 rounded-md hover:bg-white hover:text-black border border-black transition">See More</a>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</div>
@endsection
