<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chỉnh sửa bài viết') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-50">
                    <form id="form" action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" name="thumbnail" id="thumbnail"
                                accept="image/jpeg, image/png, image/jpg, image/gif"
                                class="mt-1 mb-3 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @if ($post->thumbnail)
                                <img src="{{ $post->thumbnail }}" alt="Current Thumbnail" class="mt-3 mb-3" width="200">
                            @endif
                        </div>

                        <div>
                            <label for="post_name">Tên bài viết</label>
                            <input type="text" name="post_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ old('post_name', $post->post_name) }}" required>
                        </div>

                        <div class="mt-4">
                            <label for="post_content">Nội dung bài viết</label>
                            <div id="editor" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" style="min-height: 200px;">
                                {!! old('post_content', $post->post_content) !!}
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="category_id">Thể loại</label>
                            <select name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="series_id">Series (tùy chọn)</label>
                            <select name="series_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Không</option>
                                @foreach ($series as $serie)
                                    <option value="{{ $serie->id }}" {{ $post->series_id == $serie->id ? 'selected' : '' }}>
                                        {{ $serie->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="tags">Tags (cách nhau bằng dấu phẩy)</label>
                            <input type="text" name="tags" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ old('tags', is_array(json_decode($post->tags)) ? implode(',', json_decode($post->tags)) : '') }}">
                        </div>

                        <div class="mt-4">
                            <label for="hidden">Ẩn</label>
                            <select name="hidden" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                                <option value="0" {{ $post->hidden == 0 ? 'selected' : '' }}>Không</option>
                                <option value="1" {{ $post->hidden == 1 ? 'selected' : '' }}>Có</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="pinned" class="block">Ghim</label>
                            <input type="hidden" name="pinned" value="0"> <!-- Hidden input -->
                            <input type="checkbox" name="pinned" {{ $post->pinned ? 'checked' : '' }} value="1" class="mt-1"> Ghim bài viết
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-[#98d0c0] text-white px-4 py-2 rounded hover:bg-[#3c483d] transition duration-200">
                                Cập nhật bài viết
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link', 'image'],
                        ['clean']
                    ]
                }
            });

            var oldContent = `{!! old('post_content', $post->post_content) !!}`;
            quill.clipboard.dangerouslyPasteHTML(oldContent);

            var form = document.getElementById('form');
            form.onsubmit = function(event) {
                event.preventDefault();

                var quillContent = quill.root.innerHTML;
                var formData = new FormData(form);

                formData.append('post_content', quillContent);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert('Bài viết đã được cập nhật thành công!');
                        window.location.href = '/admin/posts'; 
                    } else {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                });
            };
        });
    </script>
</x-app-layout>
