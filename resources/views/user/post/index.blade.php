@extends('layouts.user')

@section('content')
<div class="min-h-screen bg-surface-light py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-4xl font-display font-bold text-primary mb-2">Create New Post</h1>
            <p class="text-secondary-dark">Share your thoughts with the world</p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-light/20 p-8">
            <div class="bg-white">
                    <form id="postForm" method="POST" action="{{ route('userposts.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        {{-- Thumbnail Upload --}}
                        <div>
                            <label class="block text-sm font-medium text-primary mb-2">Featured Image</label>
                            <div class="relative border-2 border-dashed border-secondary-light/30 rounded-xl p-8 text-center hover:border-secondary transition-colors">
                                <input type="file" 
                                       name="thumbnail" 
                                       id="thumbnail"
                                       accept="image/jpeg, image/png, image/jpg, image/gif"
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                <svg class="w-12 h-12 mx-auto text-secondary-light mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-secondary-dark">Click to upload or drag and drop</p>
                                <p class="text-sm text-secondary-dark/60 mt-1">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>

                        {{-- Post Title --}}
                        <div>
                            <label for="post_name" class="block text-sm font-medium text-primary mb-2">Post Title *</label>
                            <input type="text" 
                                   name="post_name"
                                   id="post_name"
                                   class="w-full px-4 py-3 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"
                                   placeholder="Enter an engaging title..."
                                   value="{{ old('post_name') }}" 
                                   required>
                        </div>

                        {{-- Post Content --}}
                        <div>
                            <label class="block text-sm font-medium text-primary mb-2">Content *</label>
                            <div id="editor" 
                                 class="bg-white border border-secondary-light/30 rounded-lg"
                                 style="min-height: 400px;"></div>
                        </div>

                        {{-- Category & Series Row --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-primary mb-2">Category *</label>
                                <select name="category_id"
                                        id="category_id"
                                        class="w-full px-4 py-3 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"
                                        required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="series" class="block text-sm font-medium text-primary mb-2">Series (Optional)</label>
                                <input type="text" 
                                       name="series"
                                       id="series"
                                       class="w-full px-4 py-3 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"
                                       placeholder="Add to a series..."
                                       value="{{ old('series') }}">
                            </div>
                        </div>

                        {{-- Tags --}}
                        <div>
                            <label for="tags" class="block text-sm font-medium text-primary mb-2">Tags</label>
                            <input type="text" 
                                   name="tags"
                                   id="tags"
                                   class="w-full px-4 py-3 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"
                                   placeholder="Separate tags with commas (e.g., javascript, tutorial, web)"
                                   value="{{ old('tags') }}">
                            <p class="text-sm text-secondary-dark/60 mt-1">Add up to 5 tags to help readers find your post</p>
                        </div>

                        {{-- Visibility --}}
                        <div>
                            <label for="hidden" class="block text-sm font-medium text-primary mb-2">Visibility</label>
                            <select name="hidden"
                                    id="hidden"
                                    class="w-full px-4 py-3 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"
                                    required>
                                <option value="0">Published - Visible to everyone</option>
                                <option value="1">Draft - Only visible to you</option>
                            </select>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center justify-between pt-6 border-t border-secondary-light/20">
                            <a href="{{ route('blogs.index') }}" 
                               class="px-6 py-3 text-secondary-dark hover:text-primary transition-colors">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-8 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors">
                                Publish Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ['link', 'image'],
                        ['clean']
                    ]
                }
            });

            quill.getModule('toolbar').addHandler('image', function() {
                var range = quill.getSelection();
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.click();

                input.onchange = () => {
                    var file = input.files[0];
                    var formData = new FormData();
                    formData.append('image', file);

                    fetch('/user/upload-image', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                        .then(response => response.json())
                        .then(result => {
                            if (result.success) {
                                quill.insertEmbed(range.index, 'image', result.url, Quill.sources.USER);
                            } else {
                                alert(result.message || 'Có lỗi xảy ra khi upload ảnh.');
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi:', error);
                            alert('Có lỗi xảy ra: ' + error.message);
                        });
                };
            });

            var form = document.getElementById('postForm');
            form.onsubmit = function (event) {
                event.preventDefault();

                var quillContent = quill.root.innerHTML;
                var formData = new FormData(form);

                formData.append('post_content', quillContent);

                console.log("Form Data:");
                formData.forEach((value, key) => {
                    console.log(key + ":", value);
                });

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Post created successfully!');
                            window.location.href = '/';
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error.message);
                        alert('An error occurred: ' + error.message);
                    });
            };
        });
    </script>
@endsection
