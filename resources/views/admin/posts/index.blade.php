<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý bài viết') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-50">
                    <!-- Thanh tìm kiếm -->
                    <form method="GET" action="{{ route('posts.index') }}" class="mb-6">
                        <div class="mb-4 flex flex-wrap md:flex-nowrap items-center justify-start gap-3">
                            <!-- Tìm kiếm theo tên -->
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm theo tên bài viết"
                                   class="border-gray-300 rounded-md shadow-sm w-1/3 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">

                            <!-- Bộ lọc theo Tags -->
                            <input type="text" name="tags" value="{{ request('tags') }}" placeholder="Tìm theo tags"
                                   class="border-gray-300 rounded-md shadow-sm w-1/3 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">

                            <!-- Bộ lọc theo Thể loại -->
                            <select name="category" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Tất cả thể loại</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Bộ lọc theo Series -->
                            <select name="series" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Tất cả series</option>
                                @foreach($seriesList as $series)
                                    <option value="{{ $series->id }}" {{ request('series') == $series->id ? 'selected' : '' }}>
                                        {{ $series->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Bộ lọc theo trạng thái Ẩn -->
                            <select name="hidden" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Hiển thị tất cả</option>
                                <option value="1" {{ request('hidden') == '1' ? 'selected' : '' }}>Ẩn</option>
                                <option value="0" {{ request('hidden') == '0' ? 'selected' : '' }}>Hiển thị</option>
                            </select>

                            <!-- Nút Tìm kiếm -->
                            <button type="submit" class="w-full px-4 py-2 bg-[#98d0c0] text-white rounded-md hover:bg-[#3c483d] transition duration-200">Tìm kiếm</button>
                        </div>
                    </form>

                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold">Danh sách bài viết</h1>
                        <a href="{{ route('posts.create') }}" class="bg-[#98d0c0] text-white px-4 py-2 rounded hover:bg-[#3c483d] transition duration-200">Tạo mới</a>
                    </div>

                    <!-- Bảng danh sách bài viết -->
                    <table class="mt-4 w-full border-collapse table-auto">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border p-2 text-left">Tên bài viết</th>
                                <th class="border p-2 text-left">Nội dung</th>
                                <th class="border p-2 text-left">Tags</th>
                                <th class="border p-2 text-left">Thể loại</th>
                                <th class="border p-2 text-left">Series</th>
                                <th class="border p-2 text-left">Ẩn</th>
                                <th class="border p-2 text-left">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr class="hover:bg-gray-100 transition duration-200">
                                    <td class="border p-2">{{ $post->post_name }}</td>
                                    <td class="border p-2">{{ Str::limit($post->post_content, 100) }}</td>
                                    <td class="border p-1">
                                        @if (!empty($post->tags))
                                            @foreach (explode(',', $post->tags) as $tag)
                                                <span class="bg-[#98d0c0] px-2 py-1 rounded-full text-white mx-1 my-1 text-center inline-block cursor-pointer">{{ trim($tag) }}</span>
                                            @endforeach
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="border p-2">{{ $post->category->name }}</td>
                                    <td class="border p-2">{{ $post->series ? $post->series->name : 'N/A' }}</td>
                                    <td class="border p-2">{{ $post->hidden ? 'Ẩn' : 'Không' }}</td>
                                    <td class="border p-2">
                                    <div class="flex gap-2">
                                        <a href="{{ route('posts.edit', $post) }}" class="w-full px-2 py-1 bg-[#98d0c0] text-white rounded-md hover:bg-[#3c483d] transition duration-200 text-center">
                                            Chỉnh sửa
                                        </a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Bạn thật sự muốn xoá bài viết này không?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 bg-red-200 px-3 py-1 rounded hover:bg-red-500 hover:text-white">
                                                Xoá
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>

                    <div class="mt-4 text-right">
                        <p>Trang {{ $posts->currentPage() }} trong {{ $posts->lastPage() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
