@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Add CSRF meta tag -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4">Create Post</h1>
        <form method="POST" action="{{ route('admin.posts.store') }}" id="post-form">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-md" required>
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-700">Content</label>
                <textarea name="content" id="content" class="w-full border-gray-300 rounded-md"></textarea>
                @error('content')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="publish" class="form-checkbox">
                    <span class="ml-2">Publish immediately</span>
                </label>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Post</button>
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
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').content
                                    },
                                    body: data
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.uploaded) {
                                        resolve({
                                            default: data.url
                                        });
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
                    'imageUpload', 'blockQuote', 'mediaEmbed', 'insertTable', 'undo', 'redo'
                ],
                mediaEmbed: {
                    previewsInData: true, // Save <iframe> instead of <oembed>
                    removeProviders: [], // Ensure YouTube is not excluded
                    extraProviders: [{
                        name: 'youtube',
                        url: /^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/,
                        html: match => {
                            const id = match[2];
                            return (
                                '<div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">' +
                                '<iframe ' +
                                'src="https://www.youtube.com/embed/' + id + '" ' +
                                'style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" ' +
                                'frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>' +
                                '</iframe>' +
                                '</div>'
                            );
                        }
                    }]
                }
            })
            .then(editor => {
                editorInstance = editor;
                console.log('CKEditor initialized');
            })
            .catch(error => {
                console.error('CKEditor error:', error);
            });

        document.getElementById('post-form').addEventListener('submit', function() {
            if (editorInstance) {
                document.getElementById('content').value = editorInstance.getData();
                console.log('Textarea content:', document.getElementById('content').value);
            }
        });
    </script>
@endsection
