<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tạo mới bài viết') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-50">
                    <form id="postForm" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mt-4">
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" name="thumbnail" id="thumbnail"
                                accept="image/jpeg, image/png, image/jpg, image/gif"
                                class="mt-1 mb-3 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>

                        <div>
                            <label for="post_name">Tên bài viết</label>
                            <input type="text" name="post_name"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                value="{{ old('post_name') }}" required>
                        </div>

                        <div class="mt-4">
                            <label for="post_content">Nội dung bài viết</label>
                            <div id="editor"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                style="min-height: 200px;"></div>
                        </div>

                        <div class="mt-4">
                            <label for="category_id">Thể loại</label>
                            <select name="category_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="series_id">Series (optional)</label>
                            <select name="series_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Không</option>
                                @foreach ($series as $serie)
                                    <option value="{{ $serie->id }}">{{ $serie->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="tags">Tags (cách nhau bằng dấu phẩy)</label>
                            <input type="text" name="tags"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                value="{{ old('tags') }}">
                        </div>

                        <div class="mt-4">
                            <label for="hidden">Ẩn</label>
                            <select name="hidden"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                required>
                                <option value="0">Không</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <button type="submit"
                                class="bg-[#98d0c0] text-white px-4 py-2 rounded hover:bg-[#3c483d] transition duration-200">
                                Tạo mới
                            </button>
                        </div>
                    </form>
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

                    fetch('/admin/upload-image', {
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
                        alert('Bài viết đã được tạo thành công!');
                        window.location.href = '/admin/posts';
                    } else {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error.message);
                    alert('Có lỗi xảy ra: ' + error.message);
                });
            };
        });
    </script>
</x-app-layout>
