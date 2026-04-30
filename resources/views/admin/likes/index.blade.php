<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý Lượt Thích') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-50">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold text-gray-900">Danh sách Lượt Thích</h1>
                    </div>

                    <div class="mb-6">
                        <form method="GET" action="{{ route('likes.index') }}" class="flex items-center space-x-4">
                            <div class="flex items-center gap-1">
                                <label for="username" class="mr-2 text-gray-700">Tìm kiếm theo người dùng:</label>
                                <input type="text" name="username" id="username" class="border border-gray-300 rounded-md px-2 py-1 focus:border-[#98d0c0] focus:ring-[#98d0c0] placeholder-gray-400" placeholder="Nhập tên người dùng">
                                <button type="submit" class="bg-[#98d0c0] text-white px-4 py-2 rounded-md hover:bg-[#3c483d] transition duration-200">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>

                    <div class="mb-6">
                        <form method="GET" action="{{ route('likes.index') }}" class="flex items-center space-x-4">
                            <div class="flex items-center gap-3">
                                <label for="post_name" class="mr-2 text-gray-700">Tìm kiếm theo bài viết:</label>
                                <input type="text" name="post_name" id="post_name" class="border border-gray-300 rounded-md px-2 py-1 focus:border-[#98d0c0] focus:ring-[#98d0c0] placeholder-gray-400" placeholder="Nhập tên bài viết">
                                <button type="submit" class="bg-[#98d0c0] text-white px-4 py-2 rounded-md hover:bg-[#3c483d] transition duration-200">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>

                    @if($likes->isEmpty()) 
                        <p class="text-red-500">Không tìm thấy lượt thích nào.</p>
                    @else
                        <ul class="mt-4">
                            @foreach($likes as $like)
                                <li class="border-b p-2 hover:bg-gray-100 transition duration-200 flex justify-between">
                                    <a href="{{ route('posts.edit', $like->post->id) }}" class="text-gray-800 hover:underline">
                                        <strong>{{ $like->post->post_name }}</strong>
                                    </a> - 
                                    <a href="{{ route('users.edit', $like->user->id) }}" class="font-medium text-gray-600 hover:underline">
                                        {{ $like->user->username }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-4">
                            {{ $likes->links() }}
                        </div>

                        <div class="mt-4 text-right">
                            <p>Trang {{ $likes->currentPage() }} trong {{ $likes->lastPage() }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
