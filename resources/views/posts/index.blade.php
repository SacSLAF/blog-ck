@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-4">Blog Posts</h1>
    @foreach ($posts as $post)
        <div class="bg-white p-6 rounded-lg shadow-md mb-4">
            <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
            <p class="text-gray-600 text-sm mb-2">
                By {{ $post->author }} on {{ $post->published_at ? $post->published_at->format('M d, Y H:i') : 'Not published' }}
            </p>
            <div class="prose">{!! $post->content !!}</div>
        </div>
    @endforeach
</div>
@endsection
