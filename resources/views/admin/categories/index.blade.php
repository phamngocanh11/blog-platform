<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý thể loại') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-50">
                    <form method="GET" action="{{ route('categories.index') }}" class="mb-6">
                        <div class="mb-4 flex flex-wrap md:flex-nowrap items-center justify-start gap-3">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm theo tên thể loại"
                                   class="border-gray-300 rounded-md shadow-sm w-1/3 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">

                            <button type="submit" class="px-4 py-2 bg-[#98d0c0] text-white rounded-md hover:bg-[#3c483d] transition duration-200">Tìm kiếm</button>
                        </div>
                    </form>

                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold">Danh sách thể loại</h1>
                        <a href="{{ route('categories.create') }}" class="bg-[#98d0c0] text-white px-4 py-2 rounded hover:bg-[#3c483d] transition duration-200">Tạo mới</a>
                    </div>
                    
                    <table class="mt-4 w-full border-collapse table-auto">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border p-2 text-left">Tên thể loại</th>
                                <th class="border p-2 text-left">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="hover:bg-gray-100 transition duration-200">
                                    <td class="border p-2">{{ $category->name }}</td>
                                    <td class="border p-2">
                                        <div class="flex gap-2">
                                            <a href="{{ route('categories.edit', $category) }}" class="text-white px-3 py-1 bg-[#98d0c0] rounded hover:bg-[#3c483d] hover:text-white">Chỉnh sửa</a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Bạn thật sự muốn xoá thể loại này không?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 bg-red-200 px-3 py-1 rounded hover:bg-red-500 hover:text-white">Xoá</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>

                    <div class="mt-4 text-right">
                        <p>Trang {{ $categories->currentPage() }} trong {{ $categories->lastPage() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
