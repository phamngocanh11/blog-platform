@extends('layouts.user')

@section('content')
<div class="bg-surface min-h-screen">
    <div class="max-w-container mx-auto px-6 py-12">
        
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Main Content - 3/4 -->
            <div class="lg:w-3/4">
                
                <!-- Pinned Posts Section -->
                @if($pinnedPosts->count())
                    <section class="mb-section-gap">
                        <div class="flex items-center gap-3 mb-8">
                            <h2 class="font-display text-headline-lg text-on-surface">Featured Posts</h2>
                            <span class="px-3 py-1 bg-secondary text-on-secondary text-xs font-body font-semibold rounded-full">
                                Pinned
                            </span>
                        </div>
                        
                        <div class="space-y-6">
                            @foreach($pinnedPosts as $post)
                                <article class="group flex gap-6 p-6 bg-surface-container-lowest rounded-lg border border-outline-variant hover:shadow-lg hover:border-secondary/30 transition-all duration-300">
                                    <!-- Thumbnail -->
                                    <a href="{{ route('blogs.show', $post->id) }}" class="flex-shrink-0">
                                        <img src="{{ $post->thumbnail }}" 
                                             class="w-24 h-24 object-cover rounded-lg ring-2 ring-outline-variant group-hover:ring-secondary transition-all"
                                             alt="{{ $post->post_name }}">
                                    </a>
                                    
                                    <!-- Content -->
                                    <div class="flex-grow min-w-0">
                                        <!-- Meta -->
                                        <div class="flex items-center gap-4 mb-3">
                                            <span class="font-body text-label-sm text-secondary font-semibold">
                                                {{ $post->user->name }}
                                            </span>
                                            <span class="font-body text-label-sm text-on-surface-variant">
                                                {{ $post->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        
                                        <!-- Title -->
                                        <a href="{{ route('blogs.show', $post->id) }}">
                                            <h3 class="font-display text-headline-md text-on-surface group-hover:text-primary transition-colors mb-2 line-clamp-2">
                                                {{ $post->post_name }}
                                            </h3>
                                        </a>
                                        
                                        <!-- Excerpt -->
                                        <p class="font-body text-body-md text-on-surface-variant line-clamp-2">
                                            {{ Str::limit(strip_tags($post->post_content), 150) }}
                                        </p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Recommended Posts Section -->
                @if($recommendedPosts->count())
                    <section class="mb-section-gap">
                        <h2 class="font-display text-headline-lg text-on-surface mb-8">Recommended for You</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($recommendedPosts as $post)
                                <article class="group flex flex-col bg-surface-container-lowest rounded-lg border border-outline-variant hover:shadow-lg hover:border-secondary/30 transition-all duration-300 overflow-hidden">
                                    <!-- Image -->
                                    <a href="{{ route('blogs.show', $post->id) }}" class="relative overflow-hidden">
                                        <img src="{{ $post->thumbnail }}" 
                                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                                             alt="{{ $post->post_name }}">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    </a>
                                    
                                    <!-- Content -->
                                    <div class="p-6 flex-grow flex flex-col">
                                        <!-- Meta -->
                                        <div class="flex items-center gap-3 mb-3">
                                            <span class="font-body text-label-sm text-secondary font-semibold">
                                                {{ $post->user->name }}
                                            </span>
                                            <span class="font-body text-label-sm text-on-surface-variant">
                                                {{ $post->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        
                                        <!-- Title -->
                                        <a href="{{ route('blogs.show', $post->id) }}">
                                            <h3 class="font-display text-xl font-medium text-on-surface group-hover:text-primary transition-colors mb-2 line-clamp-2">
                                                {{ $post->post_name }}
                                            </h3>
                                        </a>
                                        
                                        <!-- Excerpt -->
                                        <p class="font-body text-body-md text-on-surface-variant line-clamp-3 flex-grow">
                                            {{ Str::limit(strip_tags($post->post_content), 120) }}
                                        </p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- All Posts Section -->
                <section class="mb-12">
                    <h2 class="font-display text-headline-lg text-on-surface mb-8">Latest Articles</h2>
                    
                    <div class="space-y-4">
                        @foreach($allPosts as $post)
                            <article class="group flex gap-6 p-6 bg-surface-container-lowest rounded-lg border border-outline-variant hover:shadow-lg hover:border-secondary/30 transition-all duration-300">
                                <!-- Thumbnail -->
                                <a href="{{ route('blogs.show', $post->id) }}" class="flex-shrink-0">
                                    <img src="{{ $post->thumbnail }}" 
                                         class="w-20 h-20 object-cover rounded-lg ring-2 ring-outline-variant group-hover:ring-secondary transition-all"
                                         alt="{{ $post->post_name }}">
                                </a>
                                
                                <!-- Content -->
                                <div class="flex-grow min-w-0">
                                    <!-- Meta -->
                                    <div class="flex items-center gap-4 mb-2">
                                        <span class="font-body text-label-sm text-secondary font-semibold">
                                            {{ $post->user->name }}
                                        </span>
                                        <span class="font-body text-label-sm text-on-surface-variant">
                                            {{ $post->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    
                                    <!-- Title -->
                                    <a href="{{ route('blogs.show', $post->id) }}">
                                        <h3 class="font-display text-xl font-medium text-on-surface group-hover:text-primary transition-colors mb-2 line-clamp-1">
                                            {{ $post->post_name }}
                                        </h3>
                                    </a>
                                    
                                    <!-- Excerpt -->
                                    <p class="font-body text-body-md text-on-surface-variant line-clamp-2">
                                        {{ Str::limit(strip_tags($post->post_content), 150) }}
                                    </p>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8 flex items-center justify-between">
                        <p class="font-body text-body-md text-on-surface-variant">
                            Page {{ $allPosts->currentPage() }} of {{ $allPosts->lastPage() }}
                        </p>
                        <div class="pagination-modern">
                            {{ $allPosts->links() }}
                        </div>
                    </div>
                </section>
            </div>

            <!-- Sidebar - 1/4 -->
            <aside class="lg:w-1/4">
                <div class="lg:sticky lg:top-6 space-y-8">
                    
                    <!-- Most Liked Posts -->
                    @if($mostLikedPosts->count())
                        <section class="bg-surface-container-lowest p-6 rounded-lg border border-outline-variant">
                            <h3 class="font-display text-headline-md text-on-surface mb-6 flex items-center gap-2">
                                <svg class="w-5 h-5 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                                </svg>
                                Most Liked
                            </h3>
                            
                            <div class="space-y-4">
                                @foreach($mostLikedPosts as $post)
                                    <article class="group">
                                        <a href="{{ route('blogs.show', $post->id) }}" class="block">
                                            <img src="{{ $post->thumbnail }}" 
                                                 class="w-full h-32 object-cover rounded-lg mb-3 group-hover:opacity-90 transition-opacity"
                                                 alt="{{ $post->post_name }}">
                                        </a>
                                        
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="font-body text-xs text-secondary font-semibold">
                                                {{ $post->user->name }}
                                            </span>
                                            <span class="font-body text-xs text-on-surface-variant">
                                                {{ $post->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        
                                        <a href="{{ route('blogs.show', $post->id) }}">
                                            <h4 class="font-display text-base font-medium text-on-surface group-hover:text-primary transition-colors line-clamp-2">
                                                {{ $post->post_name }}
                                            </h4>
                                        </a>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- Most Viewed Posts -->
                    @if($mostViewedPosts->count())
                        <section class="bg-surface-container-lowest p-6 rounded-lg border border-outline-variant">
                            <h3 class="font-display text-headline-md text-on-surface mb-6 flex items-center gap-2">
                                <svg class="w-5 h-5 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                Trending
                            </h3>
                            
                            <div class="space-y-4">
                                @foreach($mostViewedPosts as $post)
                                    <article class="group flex gap-3">
                                        <a href="{{ route('blogs.show', $post->id) }}" class="flex-shrink-0">
                                            <img src="{{ $post->thumbnail }}" 
                                                 class="w-16 h-16 object-cover rounded-lg group-hover:opacity-90 transition-opacity"
                                                 alt="{{ $post->post_name }}">
                                        </a>
                                        
                                        <div class="flex-grow min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-body text-xs text-secondary font-semibold">
                                                    {{ $post->user->name }}
                                                </span>
                                            </div>
                                            
                                            <a href="{{ route('blogs.show', $post->id) }}">
                                                <h4 class="font-display text-sm font-medium text-on-surface group-hover:text-primary transition-colors line-clamp-2">
                                                    {{ $post->post_name }}
                                                </h4>
                                            </a>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @endif
                    
                </div>
            </aside>
        </div>
        
    </div>
</div>

<style>
/* Custom Pagination Styles */
.pagination-modern nav {
    @apply flex items-center gap-2;
}

.pagination-modern .pagination {
    @apply flex items-center gap-2;
}

.pagination-modern .page-link {
    @apply px-4 py-2 font-body text-body-md text-on-surface bg-surface-container rounded-lg border border-outline-variant hover:bg-surface-container-high hover:border-secondary transition-all;
}

.pagination-modern .page-item.active .page-link {
    @apply bg-primary text-on-primary border-primary;
}

.pagination-modern .page-item.disabled .page-link {
    @apply opacity-50 cursor-not-allowed;
}
</style>
@endsection
