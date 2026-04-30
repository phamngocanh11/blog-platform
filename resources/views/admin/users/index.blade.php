<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý người dùng') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-50">
                    <!-- Form tìm kiếm và bộ lọc -->
                    <form method="GET" action="{{ route('users.index') }}" class="mb-4">
                        <div class="mb-4 flex flex-wrap md:flex-nowrap items-center justify-start gap-3">
                            <!-- Tìm kiếm theo username -->
                            <input type="text" name="username" placeholder="Tìm theo username" value="{{ request('username') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">

                            <!-- Bộ lọc role -->
                            <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                                <option value="">All Roles</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                            </select>

                            <!-- Bộ lọc tăng dần/giảm dần -->
                            <select name="order" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                                <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Tăng dần</option>
                                <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Giảm dần</option>
                            </select>

                            <!-- Nút lọc -->
                            <button type="submit" class="w-full px-4 py-2 bg-[#98d0c0] text-white rounded-md hover:bg-[#3c483d] transition duration-200">
                                Tìm kiếm
                            </button>
                        </div>
                    </form>

                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold">Danh sách người dùng</h1>
                        <a href="{{ route('users.create') }}" class="bg-[#98d0c0] text-white px-4 py-2 rounded hover:bg-[#3c483d] transition duration-200">Tạo mới</a>
                    </div>

                    @if (session('status'))
                        <div class="mb-4 text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($users->isEmpty())
                        <div class="mt-4 text-gray-500">
                            {{ __('No users found.') }}
                        </div>
                    @else
                        <table class="mt-4 w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border p-2 text-left">Tên</th>
                                    <th class="border p-2 text-left">Username</th>
                                    <th class="border p-2 text-left">Email</th>
                                    <th class="border p-2 text-left">Vai trò</th>
                                    <th class="border p-2 text-left">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="hover:bg-gray-100 transition duration-200">
                                        <td class="border p-2">{{ $user->name }}</td>
                                        <td class="border p-2">{{ $user->username }}</td>
                                        <td class="border p-2">{{ $user->email }}</td>
                                        <td class="border p-2">{{ ucfirst($user->role) }}</td>
                                        <td class="border p-2">
                                            <a href="{{ route('users.edit', $user) }}" class="w-full px-4 py-2 bg-[#98d0c0] text-white rounded-md hover:bg-[#3c483d] transition duration-200">Chỉnh sửa</a>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Bạn thật sự muốn xoá người dùng này không?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 bg-red-200 px-3 py-1 rounded hover:bg-red-500 hover:text-white">Xoá</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $users->appends(request()->query())->links() }}
                        </div>

                        <div class="mt-4 text-right">
                            <p>Trang {{ $users->currentPage() }} trong {{ $users->lastPage() }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
