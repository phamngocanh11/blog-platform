@extends('layouts.user')

@section('content')
<div class="min-h-screen bg-surface-light py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-4xl font-display font-bold text-primary mb-2">Profile Settings</h1>
            <p class="text-secondary-dark">Manage your account information and preferences</p>
        </div>

        {{-- Success/Error Messages --}}
        @if (session('success'))
            <div class="mb-6 bg-secondary-light/20 border border-secondary-light text-secondary px-6 py-4 rounded-lg flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-lg flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-8">
                {{-- Profile Information --}}
                <div class="bg-white rounded-2xl shadow-sm border border-secondary-light/20 p-8">
                    <h2 class="text-2xl font-display font-bold text-primary mb-6">Profile Information</h2>
                    
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('POST')

                        <div>
                            <label for="name" class="block text-sm font-medium text-primary mb-2">Display Name</label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required
                                   class="w-full px-4 py-3 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-primary mb-2">Email Address</label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required
                                   class="w-full px-4 py-3 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" 
                                    class="px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Change Password --}}
                <div class="bg-white rounded-2xl shadow-sm border border-secondary-light/20 p-8">
                    <h2 class="text-2xl font-display font-bold text-primary mb-6">Change Password</h2>
                    
                    <form action="{{ route('profile.changePassword') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('POST')

                        <div>
                            <label for="current_password" class="block text-sm font-medium text-primary mb-2">Current Password</label>
                            <input type="password" 
                                   name="current_password" 
                                   id="current_password" 
                                   required
                                   class="w-full px-4 py-3 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                        </div>

                        <div>
                            <label for="new_password" class="block text-sm font-medium text-primary mb-2">New Password</label>
                            <input type="password" 
                                   name="new_password" 
                                   id="new_password" 
                                   required
                                   class="w-full px-4 py-3 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                        </div>

                        <div>
                            <label for="new_password_confirmation" class="block text-sm font-medium text-primary mb-2">Confirm New Password</label>
                            <input type="password" 
                                   name="new_password_confirmation" 
                                   id="new_password_confirmation" 
                                   required
                                   class="w-full px-4 py-3 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" 
                                    class="px-6 py-3 bg-secondary text-white font-medium rounded-lg hover:bg-secondary-dark transition-colors">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>

                {{-- My Posts --}}
                <div class="bg-white rounded-2xl shadow-sm border border-secondary-light/20 p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-display font-bold text-primary">My Posts</h2>
                        <a href="{{ route('userposts.index') }}" 
                           class="text-secondary hover:text-secondary-dark text-sm font-medium">
                            View All →
                        </a>
                    </div>
                    
                    @if($posts->count() > 0)
                        <div class="space-y-4">
                            @foreach ($posts as $post)
                                <a href="{{ route('blogs.show', $post->id) }}" 
                                   class="block p-4 bg-surface-light rounded-lg hover:bg-surface transition-colors">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h3 class="font-medium text-primary mb-1">{{ $post->post_name }}</h3>
                                            <p class="text-sm text-secondary-dark">{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="flex items-center gap-4 text-sm text-secondary-dark ml-4">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                                {{ $post->likes }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                {{ $post->views }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto text-secondary-light mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-secondary-dark mb-4">You haven't published any posts yet</p>
                            <a href="{{ route('userposts.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                                Write Your First Post
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Sidebar Stats --}}
            <div class="space-y-6">
                {{-- Profile Card --}}
                <div class="bg-white rounded-2xl shadow-sm border border-secondary-light/20 p-6 text-center">
                    <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" 
                         alt="{{ $user->name }}"
                         class="w-24 h-24 rounded-full mx-auto mb-4 ring-4 ring-secondary-light">
                    <h3 class="text-xl font-display font-bold text-primary mb-1">{{ $user->name }}</h3>
                    <p class="text-sm text-secondary-dark mb-4">{{ $user->email }}</p>
                    <div class="pt-4 border-t border-secondary-light/20">
                        <p class="text-sm text-secondary-dark mb-1">Member since</p>
                        <p class="font-medium text-primary">{{ $user->created_at->format('M Y') }}</p>
                    </div>
                </div>

                {{-- Stats Card --}}
                <div class="bg-white rounded-2xl shadow-sm border border-secondary-light/20 p-6">
                    <h3 class="text-lg font-display font-bold text-primary mb-4">Statistics</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-secondary-dark">Total Posts</span>
                            <span class="text-2xl font-bold text-primary">{{ $posts->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-secondary-dark">Total Likes</span>
                            <span class="text-2xl font-bold text-secondary">{{ $totalLikes }}</span>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="bg-white rounded-2xl shadow-sm border border-secondary-light/20 p-6">
                    <h3 class="text-lg font-display font-bold text-primary mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('userposts.create') }}" 
                           class="flex items-center gap-3 p-3 bg-surface-light rounded-lg hover:bg-surface transition-colors">
                            <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span class="text-primary font-medium">Write New Post</span>
                        </a>
                        <a href="{{ route('userposts.index') }}" 
                           class="flex items-center gap-3 p-3 bg-surface-light rounded-lg hover:bg-surface transition-colors">
                            <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="text-primary font-medium">Manage Posts</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
