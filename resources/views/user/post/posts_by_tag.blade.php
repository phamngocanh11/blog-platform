@extends('layouts.user')

@section('content')
<div class="min-h-screen bg-surface-light py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <a href="{{ route('blogs.index') }}" 
                   class="text-secondary-dark hover:text-primary transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h1 class="text-4xl font-display font-bold text-primary">
                    Posts tagged with 
                    <span class="px-3 py-1 bg-secondary-light/20 text-secondary rounded-lg">#{{ $tag }}</span>
                </h1>
            </div>
            <p class="text-secondary-dark">{{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} found</p>
        </div>

        {{-- Posts Grid --}}
        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                    <article class="bg-white rounded-2xl shadow-sm border border-secondary-light/20 overflow-hidden hover:shadow-md transition-shadow">
                        @if($post->thumbnail)
                            <a href="{{ route('blogs.show', $post->id) }}">
                                <img src="{{ $post->thumbnail }}" 
                                     alt="{{ $post->post_name }}"
                                     class="w-full h-48 object-cover">
                            </a>
                        @endif
                        
                        <div class="p-6">
                            {{-- Author & Date --}}
                            <div class="flex items-center gap-2 mb-3">
                                <img src="{{ $post->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}" 
                                     alt="{{ $post->user->name }}"
                                     class="w-6 h-6 rounded-full">
                                <div class="text-sm text-secondary-dark">
                                    <span class="font-medium">{{ $post->user->name }}</span>
                                    <span> • {{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            {{-- Title --}}
                            <a href="{{ route('blogs.show', $post->id) }}">
                                <h2 class="text-xl font-display font-bold text-primary mb-3 hover:text-secondary transition-colors line-clamp-2">
                                    {{ $post->post_name }}
                                </h2>
                            </a>

                            {{-- Excerpt --}}
                            <p class="text-secondary-dark mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($post->post_content), 120) }}
                            </p>

                            {{-- Meta --}}
                            <div class="flex items-center justify-between pt-4 border-t border-secondary-light/20">
                                <div class="flex items-center gap-4 text-sm text-secondary-dark">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                        {{ number_format($post->likes) }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        {{ number_format($post->views) }}
                                    </span>
                                </div>
                                
                                @if($post->category)
                                    <span class="text-xs px-2 py-1 bg-secondary-light/20 text-secondary rounded">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="bg-white rounded-2xl shadow-sm border border-secondary-light/20 p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-secondary-light mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <h3 class="text-2xl font-display font-bold text-primary mb-2">No posts found</h3>
                <p class="text-secondary-dark mb-6">There are no posts with the tag "{{ $tag }}"</p>
                <a href="{{ route('blogs.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors">
                    Browse All Posts
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
