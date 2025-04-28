@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-4">Edit Post</h1>
    <form method="POST" action="{{ route('admin.posts.update', $post) }}" id="post-form">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="w-full border-gray-300 rounded-md" required>
            @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="content" class="block text-gray-700">Content</label>
            <textarea name="content" id="content" class="w-full border-gray-300 rounded-md">{!! $post->content !!}</textarea>
            @error('content')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="publish" class="form-checkbox" {{ $post->is_draft ? '' : 'checked' }}>
                <span class="ml-2">Publish immediately</span>
            </label>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Post</button>
    </form>
</div>
@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    function UploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return {
                upload: () => {
                    return loader.file.then(file => new Promise((resolve, reject) => {
                        const data = new FormData();
                        data.append('upload', file);
                        fetch('{{ route('ckeditor.upload') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: data
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.uploaded) {
                                resolve({ default: data.url });
                            } else {
                                reject(data.error);
                            }
                        })
                        .catch(error => reject(error));
                    }));
                }
            };
        };
    }

    let editorInstance;
    ClassicEditor
        .create(document.querySelector('#content'), {
            extraPlugins: [UploadAdapterPlugin],
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                'imageUpload', 'blockQuote', 'insertTable', 'undo', 'redo'
            ]
        })
        .then(editor => {
            editorInstance = editor;
            console.log('CKEditor initialized');
        })
        .catch(error => {
            console.error('CKEditor error:', error);
        });

    document.getElementById('post-form').addEventListener('submit', function () {
        if (editorInstance) {
            document.getElementById('content').value = editorInstance.getData();
            console.log('Textarea content:', document.getElementById('content').value);
        }
    });
</script>
@endsection
