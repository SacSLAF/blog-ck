@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2 mb-2">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
        <p class="text-gray-600 text-sm mb-6">
            By {{ $post->author }} on {{ $post->published_at ? $post->published_at->format('M d, Y H:i') : 'Not published' }}
        </p>
        <div class="prose max-w-none">
            {!! $post->content !!}
        </div>
        <div class="mt-6">
            <a href="{{ route('home') }}"
               class="bg-black text-white px-4 py-2 rounded-md hover:bg-white hover:text-black border border-black transition">
               Back to Blog
            </a>
        </div>

    </div>
</div>
@endsection
