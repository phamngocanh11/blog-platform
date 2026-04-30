@extends('layouts.user')

@section('content')
    <div class="container mx-auto p-6 max-w-4xl">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-[#3c483d] p-3 text-center">
                <h1 class="text-3xl text-white font-bold">Trang cá nhân</h1>
            </div>

            <div class="p-6">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('POST')

                    <div class="space-y-1">
                        <label for="name" class="block text-gray-700 text-sm font-semibold">Tên hiển thị</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                               class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>

                    <div class="space-y-1">
                        <label for="email" class="block text-gray-700 text-sm font-semibold">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                               class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-[#98d0c0] hover:bg-[#3c483d] text-white font-bold py-2 px-6 rounded focus:outline-none transition duration-200">
                            Cập nhật thông tin
                        </button>
                    </div>
                </form>

                <hr class="my-8">

                <h2 class="text-2xl font-bold text-gray-800 mb-4">Thay đổi mật khẩu</h2>
                <form action="{{ route('profile.changePassword') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('POST')

                    <div class="space-y-1">
                        <label for="current_password" class="block text-gray-700 text-sm font-semibold">Mật khẩu hiện tại</label>
                        <input type="password" name="current_password" id="current_password" required
                               class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>

                    <div class="space-y-1">
                        <label for="new_password" class="block text-gray-700 text-sm font-semibold">Mật khẩu mới</label>
                        <input type="password" name="new_password" id="new_password" required
                               class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>

                    <div class="space-y-1">
                        <label for="new_password_confirmation" class="block text-gray-700 text-sm font-semibold">Xác nhận mật khẩu mới</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                               class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-[#98d0c0] hover:bg-[#3c483d] text-white font-bold py-2 px-6 rounded focus:outline-none transition duration-200">
                            Đổi mật khẩu
                        </button>
                    </div>
                </form>

                <hr class="my-8">

                <h2 class="text-2xl font-bold text-gray-800 mb-4">Thông tin khác</h2>
                <p class="text-lg text-gray-700">Tổng lượt thích: <span class="text-[#3c483d] font-bold">{{ $totalLikes }}</span></p>

                <hr class="my-8">

                <h2 class="text-2xl font-bold text-gray-800 mb-4">Danh sách bài đăng</h2>
                <ul class="space-y-4">
                    @foreach ($posts as $post)
                        <li>
                            <a href="{{ route('blogs.show', $post->id) }}" class="flex items-center justify-between p-4 bg-gray-50 rounded-lg shadow-sm hover:bg-gray-100 transition duration-200 cursor-pointer">
                                <div>
                                    <span class="text-lg font-semibold text-gray-900">{{ $post->post_name }}</span>
                                    <p>
                                        <span class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</span>
                                    </p>
                                </div>
                                <div class="text-sm text-gray-600 font-medium">
                                    <span class="text-[#98d0c0]">{{ $post->likes }} lượt thích</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
