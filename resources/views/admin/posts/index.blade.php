@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-4">Manage Posts</h1>
    <a href="{{ route('admin.posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Create New Post</a>
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="bg-white text-red-700 p-4 rounded mb-4">{{ session('error') }}</div>
    @endif
    <table class="w-full bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm">
                <th class="py-3 px-6">Title</th>
                <th class="py-3 px-6">Author</th>
                <th class="py-3 px-6">Status</th>
                <th class="py-3 px-6">Published At</th>
                <th class="py-3 px-6">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr class="border-b border-gray-200">
                    <td class="py-3 px-6">{{ $post->title }}</td>
                    <td class="py-3 px-6">{{ $post->author }}</td>
                    <td class="py-3 px-6">{{ $post->is_draft ? 'Draft' : 'Published' }}</td>
                    <td class="py-3 px-6">{{ $post->published_at ? $post->published_at->format('M d, Y H:i') : '-' }}</td>
                    <td class="py-3 px-6">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <!-- Pagination Links -->

        </tbody>
    </table>
    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection
