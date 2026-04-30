<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- User Statistics Card -->
                <x-dashboard.dashboard-card-01 :data="$data" />
                
                <!-- Views Statistics Card -->
                <x-dashboard.dashboard-card-02 :data="$data" />
                
                <!-- Posts Statistics Card -->
                <x-dashboard.dashboard-card-03 :data="$data" />
            </div>

            <!-- Top Users and Posts -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Top Users by Posts -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Top 5 Users - Nhiều bài viết nhất</h3>
                        <div class="space-y-3">
                            @foreach($data['topUsers'] as $index => $user)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <span class="text-2xl font-bold text-gray-400">#{{ $index + 1 }}</span>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                                        <p class="text-sm text-gray-500">@username: {{ $user->username }}</p>
                                    </div>
                                </div>
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $user->posts_count }} bài viết
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Top Users by Likes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Top 5 Users - Nhiều likes nhất</h3>
                        <div class="space-y-3">
                            @foreach($data['topLikedUsers'] as $index => $user)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <span class="text-2xl font-bold text-gray-400">#{{ $index + 1 }}</span>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                                        <p class="text-sm text-gray-500">@username: {{ $user->username }}</p>
                                    </div>
                                </div>
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    ❤️ {{ $user->likes_count }} likes
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Posts -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Top 5 Bài viết hot nhất</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiêu đề</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tác giả</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Likes</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comments</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($data['topPosts'] as $index => $post)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-400">
                                        #{{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('blogs.show', $post->id) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                            {{ Str::limit($post->post_name, 50) }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $post->user->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            ❤️ {{ $post->likes_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            💬 {{ $post->comments_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            👁️ {{ number_format($post->views) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Top Viewed Posts Per Month -->
            @if(count($data['topViewedPostsPerMonth']) > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Bài viết có views cao nhất mỗi tháng</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($data['topViewedPostsPerMonth'] as $item)
                        <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                            <p class="text-xs text-gray-500 mb-2">{{ $item['month'] }}</p>
                            <h4 class="font-semibold text-gray-800 mb-2">
                                <a href="{{ route('blogs.show', $item['post']->id) }}" class="hover:text-blue-600">
                                    {{ Str::limit($item['post']->post_name, 40) }}
                                </a>
                            </h4>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">{{ $item['post']->user->name ?? 'N/A' }}</span>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">
                                    👁️ {{ number_format($item['post']->views) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
