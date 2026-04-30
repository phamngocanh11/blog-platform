@extends('layouts.user')

@section('content')
<div class="min-h-screen bg-surface-light py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-4xl font-display font-bold text-primary mb-2">Search Results</h1>
            <p class="text-secondary-dark">Found results for "<span class="font-medium text-primary">{{ $query }}</span>"</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Main Content --}}
            <div class="flex-1">
                {{-- Search Form --}}
                <div class="bg-white rounded-2xl shadow-sm border border-secondary-light/20 p-6 mb-8">
                    <form action="{{ route('search') }}" method="GET" class="space-y-4">
                        <div class="flex gap-3">
                            <input type="text" 
                                   id="search-input" 
                                   name="query" 
                                   value="{{ old('query', $query) }}"
                                   placeholder="Search for posts, authors, tags..."
                                   class="flex-1 px-4 py-3 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                            <button type="submit" 
                                    id="search-button"
                                    class="px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <select name="search_type" 
                                    class="px-4 py-3 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                                <option value="content" {{ request('search_type') == 'content' ? 'selected' : '' }}>Search by Content</option>
                                <option value="title" {{ request('search_type') == 'title' ? 'selected' : '' }}>Search by Title</option>
                                <option value="author" {{ request('search_type') == 'author' ? 'selected' : '' }}>Search by Author</option>
                                <option value="tags" {{ request('search_type') == 'tags' ? 'selected' : '' }}>Search by Tags</option>
                            </select>

                            <select name="filter" 
                                    class="px-4 py-3 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                                <option value="">Sort By</option>
                                <option value="newest" {{ request('filter') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                <option value="oldest" {{ request('filter') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                <option value="views_desc" {{ request('filter') == 'views_desc' ? 'selected' : '' }}>Most Viewed</option>
                                <option value="likes_desc" {{ request('filter') == 'likes_desc' ? 'selected' : '' }}>Most Liked</option>
                            </select>
                        </div>
                    </form>
                </div>

                {{-- Results --}}
                @if($users->isEmpty() && $posts->isEmpty())
                    <div class="bg-white rounded-2xl shadow-sm border border-secondary-light/20 p-12 text-center">
                        <svg class="w-24 h-24 mx-auto text-secondary-light mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <h3 class="text-2xl font-display font-bold text-primary mb-2">No results found</h3>
                        <p class="text-secondary-dark">Try adjusting your search or filters</p>
                    </div>
                @else
                    {{-- Users Results --}}
                    @if(!$users->isEmpty())
                        <div class="mb-8">
                            <h2 class="text-2xl font-display font-bold text-primary mb-4">Authors</h2>
                            <div class="bg-white rounded-2xl shadow-sm border border-secondary-light/20 divide-y divide-secondary-light/20">
                                @foreach($users as $user)
                                    <div class="p-4 hover:bg-surface-light transition-colors">
                                        <div class="flex items-center gap-4">
                                            <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" 
                                                 alt="{{ $user->name }}"
                                                 class="w-12 h-12 rounded-full ring-2 ring-secondary-light">
                                            <div>
                                                <h3 class="font-medium text-primary">{{ $user->name }}</h3>
                                                <p class="text-sm text-secondary-dark">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Posts Results --}}
                    @if(!$posts->isEmpty())
                        <div>
                            <h2 class="text-2xl font-display font-bold text-primary mb-4">
                                Posts ({{ $posts->total() }})
                            </h2>
                            <div class="space-y-4">
                                @foreach($posts as $post)
                                    <article class="bg-white rounded-2xl shadow-sm border border-secondary-light/20 overflow-hidden hover:shadow-md transition-shadow">
                                        <div class="flex flex-col sm:flex-row">
                                            @if($post->thumbnail)
                                                <a href="{{ route('blogs.show', $post->id) }}" class="sm:w-48 h-48 sm:h-auto flex-shrink-0">
                                                    <img src="{{ $post->thumbnail }}" 
                                                         alt="{{ $post->post_name }}"
                                                         class="w-full h-full object-cover">
                                                </a>
                                            @endif
                                            <div class="flex-1 p-6">
                                                <div class="flex items-center gap-3 mb-3">
                                                    <img src="{{ $post->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}" 
                                                         alt="{{ $post->user->name }}"
                                                         class="w-8 h-8 rounded-full">
                                                    <div class="text-sm">
                                                        <span class="font-medium text-primary">{{ $post->user->name }}</span>
                                                        <span class="text-secondary-dark"> • {{ $post->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>

                                                <a href="{{ route('blogs.show', $post->id) }}">
                                                    <h3 class="text-xl font-display font-bold text-primary mb-2 hover:text-secondary transition-colors">
                                                        {{ $post->post_name }}
                                                    </h3>
                                                </a>

                                                <p class="text-secondary-dark mb-4 line-clamp-2">
                                                    {{ Str::limit(strip_tags($post->post_content), 150) }}
                                                </p>

                                                <div class="flex flex-wrap items-center gap-4">
                                                    @if($post->category)
                                                        <span class="px-3 py-1 bg-secondary-light/20 text-secondary text-sm font-medium rounded-full">
                                                            {{ $post->category->name }}
                                                        </span>
                                                    @endif

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
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>

                            {{-- Pagination --}}
                            @if($posts->hasPages())
                                <div class="mt-8">
                                    {{ $posts->links() }}
                                </div>
                            @endif
                        </div>
                    @endif
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="lg:w-80 space-y-6">
                {{-- Search Tips --}}
                <div class="bg-white rounded-2xl shadow-sm border border-secondary-light/20 p-6">
                    <h3 class="text-lg font-display font-bold text-primary mb-4">Search Tips</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-secondary-dark mb-2">Search by title:</p>
                            <button onclick="populateSearch('title:Example')" 
                                    class="px-3 py-1 bg-surface text-secondary rounded hover:bg-surface-light transition-colors">
                                title:Example
                            </button>
                        </div>
                        <div>
                            <p class="text-secondary-dark mb-2">Search by author:</p>
                            <button onclick="populateSearch('user:Name')" 
                                    class="px-3 py-1 bg-surface text-secondary rounded hover:bg-surface-light transition-colors">
                                user:Name
                            </button>
                        </div>
                        <div>
                            <p class="text-secondary-dark mb-2">Search by tags:</p>
                            <button onclick="populateSearch('tags:javascript')" 
                                    class="px-3 py-1 bg-surface text-secondary rounded hover:bg-surface-light transition-colors">
                                tags:javascript
                            </button>
                        </div>
                        <div>
                            <p class="text-secondary-dark mb-2">Search by category:</p>
                            <button onclick="populateSearch('category:Tech')" 
                                    class="px-3 py-1 bg-surface text-secondary rounded hover:bg-surface-light transition-colors">
                                category:Tech
                            </button>
                        </div>
                        <div>
                            <p class="text-secondary-dark mb-2">Search by series:</p>
                            <button onclick="populateSearch('series:Tutorial')" 
                                    class="px-3 py-1 bg-surface text-secondary rounded hover:bg-surface-light transition-colors">
                                series:Tutorial
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Quick Tag Search --}}
                <div class="bg-white rounded-2xl shadow-sm border border-secondary-light/20 p-6">
                    <h3 class="text-lg font-display font-bold text-primary mb-4">Search by Tag</h3>
                    <form action="{{ route('search') }}" method="GET" class="space-y-3">
                        <input type="hidden" name="search_type" value="tags">
                        <input type="text" 
                               name="query" 
                               placeholder="Enter tag name..."
                               class="w-full px-4 py-2 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                        <button type="submit" 
                                class="w-full px-4 py-2 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors">
                            Search Tags
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </div>
</div>

<script>
    function populateSearch(query) {
        document.getElementById('search-input').value = query;
        document.getElementById('search-button').click();
    }
</script>
@endsection
