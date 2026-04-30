@extends('layouts.user')

@section('content')
<div class="container mx-auto px-4">

    <div class="flex flex-col md:flex-row">
        <!-- Phần trái - 3/4 màn hình -->
        <div class="md:w-3/4 pr-4">
            <!-- Bài viết ghim -->
            @if($pinnedPosts->count())
                <div class="mb-6">
                    <h3 class="text-xl font-semibold mb-4">Bài viết ghim</h3>
                    <div class="grid grid-cols-1 gap-1">
                        @foreach($pinnedPosts as $post)
                            <div class="post border-b-2 overflow-hidden cursor-pointer flex flex-row md:flex-row items-start rounded">
                                <a href="{{ route('blogs.show', $post->id) }}" class="flex-shrink-0">
                                    <img src="{{ $post->thumbnail }}" class="w-16 h-16 object-cover rounded-full m-4"
                                        alt="Post Image">
                                </a>
                                <div class="flex-grow p-2">
                                    <div class="flex items-center mb-1">
                                        <span class="text-xs text-gray-600 mr-3 font-semibold">{{ $post->user->name }}</span>
                                        <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                    <a href="{{ route('blogs.show', $post->id) }}">
                                        <h4 class="text-gray-800 font-semibold mb-1 hover:text-[#98d0c0] transition-colors duration-200">
                                            {{ $post->post_name }}</h4>
                                    </a>
                                    <p class="text-xs text-gray-500 leading-relaxed mb-2">
                                        {{ Str::limit(strip_tags($post->post_content), 100) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Bài viết đề xuất -->
            @if($recommendedPosts->count())
                <div class="mb-6">
                    <h3 class="text-xl font-semibold mb-4">Bài viết đề xuất</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach($recommendedPosts as $post)
                            <div class="post overflow-hidden cursor-pointer flex flex-col">
                                <a href="{{ route('blogs.show', $post->id) }}">
                                    <img src="{{ $post->thumbnail }}" class="w-full h-48 object-cover rounded" alt="Post Image">
                                </a>
                                <div class="flex-grow p-2">
                                    <div class="flex items-center mb-1">
                                        <span class="text-xs text-gray-600 mr-3 font-semibold">{{ $post->user->name }}</span>
                                        <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                    <a href="{{ route('blogs.show', $post->id) }}">
                                        <h4 class="text-gray-800 font-semibold mb-1 hover:text-[#98d0c0] transition-colors duration-200">
                                            {{ $post->post_name }}</h4>
                                    </a>
                                    <p class="text-xs text-gray-500 leading-relaxed mb-2">
                                        {{ Str::limit(strip_tags($post->post_content), 100) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Danh sách toàn bộ bài viết với phân trang -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4">Tất cả bài viết</h3>
                <div class="grid grid-cols-1 gap-1">
                    @foreach($allPosts as $post)
                    <div class="post border-b-2 overflow-hidden cursor-pointer flex flex-row md:flex-row items-start rounded">
                                <a href="{{ route('blogs.show', $post->id) }}" class="flex-shrink-0">
                                    <img src="{{ $post->thumbnail }}" class="w-16 h-16 object-cover rounded-full m-4"
                                        alt="Post Image">
                                </a>
                                <div class="flex-grow p-2">
                                    <div class="flex items-center mb-1">
                                        <span class="text-xs text-gray-600 mr-3 font-semibold">{{ $post->user->name }}</span>
                                        <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                    <a href="{{ route('blogs.show', $post->id) }}">
                                        <h4 class="text-gray-800 font-semibold mb-1 hover:text-[#98d0c0] transition-colors duration-200">
                                            {{ $post->post_name }}</h4>
                                    </a>
                                    <p class="text-xs text-gray-500 leading-relaxed mb-2">
                                        {{ Str::limit(strip_tags($post->post_content), 100) }}</p>
                                </div>
                            </div>
                        @endforeach
                </div>
                <div class="mt-4 text-right">
                    <p>Trang {{ $allPosts->currentPage() }} trong {{ $allPosts->lastPage() }}</p>
                </div>
                <div class="mt-4">
                    {{ $allPosts->links() }}
                </div>
            </div>
        </div>

        <!-- Phần phải - 1/4 màn hình -->
        <div class="md:w-1/4 pl-4">
            <!-- Bài viết được thích nhiều nhất -->
            @if($mostLikedPosts->count())
                <div class="mb-6">
                    <h3 class="text-xl font-semibold mb-4">Bài viết được thích nhiều nhất</h3>
                    <div class="grid grid-cols-1 gap-1">
                        @foreach($mostLikedPosts as $post)
                            <div class="post overflow-hidden cursor-pointer flex flex-col">
                                <a href="{{ route('blogs.show', $post->id) }}">
                                    <img src="{{ $post->thumbnail }}" class="w-full h-48 object-cover rounded" alt="Post Image">
                                </a>
                                <div class="flex-grow p-2">
                                    <div class="flex items-center mb-1">
                                        <span class="text-xs text-gray-600 mr-3 font-semibold">{{ $post->user->name }}</span>
                                        <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                    <a href="{{ route('blogs.show', $post->id) }}">
                                        <h4 class="text-gray-800 font-semibold mb-1 hover:text-[#98d0c0] transition-colors duration-200">
                                            {{ $post->post_name }}</h4>
                                    </a>
                                    <p class="text-xs text-gray-500 leading-relaxed mb-2">
                                        {{ Str::limit(strip_tags($post->post_content), 100) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Bài viết phổ biến -->
            @if($mostViewedPosts->count())
                <div class="mb-6">
                    <h3 class="text-xl font-semibold mb-4">Bài viết phổ biến</h3>
                    <div class="grid grid-cols-1 gap-1">
                        @foreach($mostViewedPosts as $post)
                        <div class="post overflow-hidden cursor-pointer flex flex-row md:flex-row items-start rounded">
                                <a href="{{ route('blogs.show', $post->id) }}" class="flex-shrink-0">
                                    <img src="{{ $post->thumbnail }}" class="w-16 h-16 object-cover rounded-full m-4"
                                        alt="Post Image">
                                </a>
                                <div class="flex-grow p-2">
                                    <div class="flex items-center mb-1">
                                        <span class="text-xs text-gray-600 mr-3 font-semibold">{{ $post->user->name }}</span>
                                        <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                    <a href="{{ route('blogs.show', $post->id) }}">
                                        <h4 class="text-gray-800 font-semibold mb-1 hover:text-[#98d0c0] transition-colors duration-200">
                                            {{ $post->post_name }}</h4>
                                    </a>
                                    <p class="text-xs text-gray-500 leading-relaxed mb-2">
                                        {{ Str::limit(strip_tags($post->post_content), 100) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
