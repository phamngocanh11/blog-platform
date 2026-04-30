@extends('layouts.user')

@section('content')
    <div class="container mx-auto p-4 flex flex-col md:flex-row gap-6">
        <!-- Phần kết quả tìm kiếm -->
        <div class="w-full md:w-3/4">
            <h1 class="text-xl font-bold mb-4">Kết quả tìm kiếm cho "{{ $query }}"</h1>

            <!-- Form tìm kiếm -->
            <form action="{{ route('search') }}" method="GET" class="flex flex-col md:flex-row w-full mb-4 gap-2">
                <input type="text" id="search-input" name="query" value="{{ old('query', $query) }}"
                       placeholder="Nhập từ khóa tìm kiếm..." class="flex-grow border p-2 rounded-l" />
                <select name="search_type" class="border p-2 rounded flex-shrink-0">
                    <option value="content" {{ request('search_type') == 'content' ? 'selected' : '' }}>Tìm theo nội dung</option>
                    <option value="title" {{ request('search_type') == 'title' ? 'selected' : '' }}>Tìm theo tên bài viết</option>
                    <option value="author" {{ request('search_type') == 'author' ? 'selected' : '' }}>Tìm theo tác giả</option>
                </select>
                <select name="filter" class="border p-2 rounded flex-shrink-0">
                    <option value="">-- Chọn bộ lọc --</option>
                    <option value="newest" {{ request('filter') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="oldest" {{ request('filter') == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
                    <option value="views_asc" {{ request('filter') == 'views_asc' ? 'selected' : '' }}>Lượt xem tăng dần</option>
                    <option value="views_desc" {{ request('filter') == 'views_desc' ? 'selected' : '' }}>Lượt xem giảm dần</option>
                    <option value="likes_asc" {{ request('filter') == 'likes_asc' ? 'selected' : '' }}>Lượt thích tăng dần</option>
                    <option value="likes_desc" {{ request('filter') == 'likes_desc' ? 'selected' : '' }}>Lượt thích giảm dần</option>
                    <option value="comments_asc" {{ request('filter') == 'comments_asc' ? 'selected' : '' }}>Lượt bình luận tăng dần</option>
                    <option value="comments_desc" {{ request('filter') == 'comments_desc' ? 'selected' : '' }}>Lượt bình luận giảm dần</option>
                </select>
                <button type="submit" id="search-button" class="bg-[#3c483d] text-white p-2 rounded">Tìm kiếm</button>
            </form>

            <!-- Kết quả tìm kiếm -->
            @if($users->isEmpty() && $posts->isEmpty())
                <p class="mt-4">Không tìm thấy kết quả nào.</p>
            @else
                @if(!$users->isEmpty())
                    <h2 class="text-lg font-semibold mt-6">Người dùng</h2>
                    <ul class="list-disc pl-5">
                        @foreach($users as $user)
                            <li class="border-b py-2">{{ $user->name }}</li>
                        @endforeach
                    </ul>
                @endif

                @if(!$posts->isEmpty())
                    <h2 class="text-lg font-semibold mt-6">Bài blog</h2>
                    <ul class="space-y-4">
                        @foreach($posts as $post)
                            <div class="post border-b-2 flex items-start cursor-pointer">
                                <a href="{{ route('blogs.show', $post->id) }}" class="flex-shrink-0">
                                    <img src="{{ $post->thumbnail }}" class="w-16 h-16 object-cover rounded-full m-4" alt="Post Image">
                                </a>
                                <div class="flex-grow p-2">
                                    <div class="flex items-center mb-1">
                                        <span class="text-xs text-gray-600 mr-3 font-semibold">{{ $post->user->name }}</span>
                                        <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                    <a href="{{ route('blogs.show', $post->id) }}">
                                        <h4 class="text-gray-800 font-semibold mb-1 hover:text-[#98d0c0] transition-colors duration-200">
                                            {{ $post->post_name }}
                                        </h4>
                                    </a>
                                    <p class="text-xs text-gray-500 leading-relaxed mb-2">
                                        {{ Str::limit(strip_tags($post->post_content), 100) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </ul>

                    <!-- Liên kết phân trang -->
                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                @endif
            @endif
        </div>

        <!-- Phần hướng dẫn tìm kiếm -->
        <div class="w-full md:w-1/4 p-4 bg-gray-100 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4 text-center">Hướng dẫn tìm kiếm</h2>
            <ul class="text-sm text-gray-600 list-none space-y-2">
                @foreach([
                    'title' => 'Tìm theo tên bài viết (vd: title:ABC)',
                    'user' => 'Tìm theo tên người đăng (vd: user:Name)',
                    'tags' => 'Tìm theo tên tag (vd: tags:Tags)',
                    'content' => 'Tìm nội dung tương tự (vd: content:content)',
                    'category' => 'Tìm theo thể loại (vd: category:category)',
                    'series' => 'Tìm theo series (vd: series:series)'
                ] as $key => $instruction)
                    <li class="my-3">
                        <span>{{ $instruction }}</span>
                        <div class="bg-[#98d0c0] text-[#3c483d] text-sm font-medium my-2 px-3 py-1 rounded cursor-pointer w-fit"
                             onclick="populateSearch('{{ $key }}:Example')">
                            {{ $key }}:Example
                        </div>
                    </li>
                @endforeach
            </ul>

            <!-- Form tìm kiếm theo tags -->
            <form action="{{ route('search') }}" method="GET" class="mt-4">
                <input type="hidden" name="search_type" value="tags">
                <input type="text" name="query" placeholder="Nhập tag để tìm kiếm..." class="w-full border p-2 rounded mb-2" />
                <button type="submit" class="bg-[#3c483d] text-white p-2 rounded w-full">Tìm kiếm theo tags</button>
            </form>
        </div>
    </div>

    <script>
        function populateSearch(query) {
            document.getElementById('search-input').value = query;
            document.getElementById('search-button').click();
        }
    </script>
@endsection
