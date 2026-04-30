@extends('layouts.user')

@section('content')
<style>
.prose img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1.5rem 0;
}
.prose {
    max-width: 720px;
}
</style>

<article class="min-h-screen bg-surface-light">
    {{-- Hero Image --}}
    @if($post->thumbnail)
    <div class="w-full bg-primary/5">
        <img class="w-full max-w-[1200px] max-h-[500px] mx-auto object-cover" 
             src="{{ $post->thumbnail }}" 
             alt="{{ $post->post_name }}">
    </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-12">
            {{-- Main Content --}}
            <div class="flex-1 max-w-[800px]">
                {{-- Article Header --}}
                <header class="mb-8">
                    <h1 class="text-4xl md:text-5xl font-display font-bold text-primary mb-6 leading-tight">
                        {{ $post->post_name }}
                    </h1>

                    {{-- Author & Meta Info --}}
                    <div class="flex items-center gap-4 mb-6">
                        <img src="{{ $post->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name ?? 'User') }}" 
                             alt="{{ $post->user->name ?? 'User' }}"
                             class="w-12 h-12 rounded-full ring-2 ring-secondary-light">
                        <div>
                            <p class="font-medium text-primary">{{ $post->user->name ?? 'Unknown' }}</p>
                            <div class="flex items-center gap-3 text-sm text-secondary-dark">
                                <span>{{ $post->created_at->format('M d, Y') }}</span>
                                <span>•</span>
                                <span>{{ $readingTime }} min read</span>
                            </div>
                        </div>
                    </div>

                    {{-- Stats & Actions --}}
                    <div class="flex flex-wrap items-center gap-6 py-4 border-y border-secondary-light/20">
                        <button id="likeButton" class="flex items-center gap-2 text-secondary-dark hover:text-red-500 transition-colors">
                            <svg id="likeIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            <span id="likeCount" class="font-medium">{{ number_format($post->likes) }}</span>
                        </button>

                        <div class="flex items-center gap-2 text-secondary-dark">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <span class="font-medium">{{ number_format($post->views) }}</span>
                        </div>

                        <div class="flex items-center gap-2 text-secondary-dark">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <span class="font-medium">{{ $comments->count() }}</span>
                        </div>

                        <button id="readButton" class="flex items-center gap-2 text-secondary hover:text-secondary-dark transition-colors ml-auto">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                            </svg>
                            <span id="readStatus" class="text-sm font-medium">Listen</span>
                        </button>
                    </div>

                    {{-- Category & Tags --}}
                    <div class="flex flex-wrap items-center gap-3 mt-4">
                        @if($post->category)
                        <span class="px-3 py-1 bg-secondary text-white text-sm font-medium rounded-full">
                            {{ $post->category->name }}
                        </span>
                        @endif

                        @if($post->series)
                        <span class="px-3 py-1 bg-secondary-light text-secondary text-sm font-medium rounded-full">
                            Series: {{ $post->series->name }}
                        </span>
                        @endif

                        @if($post->tags)
                            @foreach(explode(',', $post->tags) as $tag)
                            <span class="px-2 py-1 bg-surface text-secondary-dark text-xs rounded">
                                #{{ trim($tag) }}
                            </span>
                            @endforeach
                        @endif
                    </div>

                    {{-- Author Actions --}}
                    @if(Auth::check() && Auth::id() === $post->user_id)
                    <div class="flex gap-3 mt-6">
                        <a href="{{ route('userposts.edit', $post->id) }}" 
                           class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                            Edit Post
                        </a>
                        <form action="{{ route('userposts.destroy', $post->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                    @endif
                </header>

                {{-- Article Content --}}
                <div class="prose prose-lg max-w-none mb-12">
                    {!! $post->post_content !!}
                </div>

                {{-- Back Button --}}
                <div class="mb-12">
                    <a href="{{ route('blogs.index') }}" 
                       class="inline-flex items-center gap-2 text-secondary hover:text-secondary-dark transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to all posts
                    </a>
                </div>

                {{-- Comments Section --}}
                <section class="border-t border-secondary-light/20 pt-12">
                    <h2 class="text-3xl font-display font-bold text-primary mb-8">
                        Comments ({{ $comments->count() }})
                    </h2>

                    {{-- Add Comment Form --}}
                    @auth
                    <div class="mb-8 bg-white rounded-xl p-6 shadow-sm border border-secondary-light/20">
                        <h3 class="text-lg font-medium text-primary mb-4">Add your comment</h3>
                        <div class="flex gap-3">
                            <input id="commentContent" 
                                   type="text"
                                   class="flex-1 px-4 py-3 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"
                                   placeholder="Share your thoughts...">
                            <button id="submitComment"
                                    class="px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors">
                                Post
                            </button>
                        </div>
                    </div>
                    @endauth

                    {{-- Comments List --}}
                    <div id="comments" class="space-y-6">
                        @if($comments->count() > 0)
                            @php $displayedCommentIds = []; @endphp
                            @foreach($comments as $comment)
                                @if(!in_array($comment->id, $displayedCommentIds))
                                <div class="bg-white rounded-xl p-6 shadow-sm border border-secondary-light/20">
                                    <div class="flex items-start gap-4">
                                        <img src="{{ $comment->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}" 
                                             alt="{{ $comment->user->name }}"
                                             class="w-10 h-10 rounded-full ring-2 ring-secondary-light">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="font-medium text-primary">{{ $comment->user->name }}</span>
                                                <span class="text-sm text-secondary-dark">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-secondary-dark mb-3">{{ $comment->content }}</p>
                                            <button onclick="showReplyInput({{ $comment->id }})" 
                                                    class="text-sm text-secondary hover:text-secondary-dark font-medium">
                                                Reply
                                            </button>

                                            {{-- Reply Input --}}
                                            <div id="reply-input-{{ $comment->id }}" class="hidden mt-4">
                                                <div class="flex gap-3">
                                                    <input id="replyContent-{{ $comment->id }}"
                                                           type="text"
                                                           class="flex-1 px-4 py-2 border border-secondary-light/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary"
                                                           placeholder="Write a reply...">
                                                    <button onclick="submitReply({{ $comment->id }})"
                                                            class="px-4 py-2 bg-secondary text-white rounded-lg hover:bg-secondary-dark transition-colors">
                                                        Send
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- Replies --}}
                                            @if($comment->replies->count() > 0)
                                            <div class="mt-4 space-y-4 pl-6 border-l-2 border-secondary-light/30">
                                                @foreach($comment->replies as $reply)
                                                    @if(!in_array($reply->id, $displayedCommentIds))
                                                    <div class="flex items-start gap-3">
                                                        <img src="{{ $reply->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($reply->user->name) }}" 
                                                             alt="{{ $reply->user->name }}"
                                                             class="w-8 h-8 rounded-full">
                                                        <div class="flex-1">
                                                            <div class="flex items-center gap-2 mb-1">
                                                                <span class="font-medium text-primary text-sm">{{ $reply->user->name }}</span>
                                                                <span class="text-xs text-secondary-dark">{{ $reply->created_at->diffForHumans() }}</span>
                                                            </div>
                                                            <p class="text-sm text-secondary-dark">{{ $reply->content }}</p>
                                                        </div>
                                                    </div>
                                                    @php $displayedCommentIds[] = $reply->id; @endphp
                                                    @endif
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @php $displayedCommentIds[] = $comment->id; @endphp
                                @endif
                            @endforeach
                        @else
                            <div class="text-center py-12 bg-white rounded-xl border border-secondary-light/20">
                                <svg class="w-16 h-16 mx-auto text-secondary-light mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                <p class="text-secondary-dark">No comments yet. Be the first to share your thoughts!</p>
                            </div>
                        @endif
                    </div>
                </section>
            </div>

            {{-- Sidebar --}}
            <aside class="lg:w-80 space-y-8">
                {{-- Series Posts --}}
                @if($seriesPosts->count() > 0)
                <div class="bg-white rounded-xl p-6 shadow-sm border border-secondary-light/20">
                    <h3 class="text-xl font-display font-bold text-primary mb-4">In This Series</h3>
                    <div class="space-y-4">
                        @foreach($seriesPosts as $seriesPost)
                        <a href="{{ route('blogs.show', $seriesPost->id) }}" 
                           class="block group">
                            <h4 class="font-medium text-primary group-hover:text-secondary transition-colors mb-1">
                                {{ $seriesPost->post_name }}
                            </h4>
                            <p class="text-sm text-secondary-dark">{{ $seriesPost->created_at->diffForHumans() }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Related Posts --}}
                @if($relatedPosts->count() > 0)
                <div class="bg-white rounded-xl p-6 shadow-sm border border-secondary-light/20">
                    <h3 class="text-xl font-display font-bold text-primary mb-4">Related Posts</h3>
                    <div class="space-y-4">
                        @foreach($relatedPosts as $relatedPost)
                        <a href="{{ route('blogs.show', $relatedPost->id) }}" 
                           class="block group">
                            @if($relatedPost->thumbnail)
                            <img src="{{ $relatedPost->thumbnail }}" 
                                 alt="{{ $relatedPost->post_name }}"
                                 class="w-full h-32 object-cover rounded-lg mb-2">
                            @endif
                            <h4 class="font-medium text-primary group-hover:text-secondary transition-colors mb-1">
                                {{ $relatedPost->post_name }}
                            </h4>
                            <p class="text-sm text-secondary-dark">{{ $relatedPost->user->name }} • {{ $relatedPost->created_at->diffForHumans() }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>
        </div>
    </div>
</article>

<script src="https://code.responsivevoice.org/responsivevoice.js?key=yourKey"></script>
<script>
const content = @json(strip_tags($post->post_content));

// Text-to-speech
const readButton = document.getElementById("readButton");
const readStatus = document.getElementById("readStatus");

readButton.addEventListener("click", function() {
    if (responsiveVoice.isPlaying()) {
        responsiveVoice.cancel();
        readStatus.innerText = "Listen";
    } else {
        responsiveVoice.speak(content, "Vietnamese Female", {
            onstart: function() {
                readStatus.innerText = "Stop";
            },
            onend: function() {
                readStatus.innerText = "Listen";
            }
        });
    }
});

// Comments
document.getElementById('submitComment')?.addEventListener('click', function() {
    const content = document.getElementById('commentContent').value;
    if (!content) return alert('Please enter a comment.');

    fetch(`/blogs/{{ $post->id }}/comments`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ content: content })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error adding comment.');
        }
    })
    .catch(error => console.error('Error:', error));
});

function showReplyInput(commentId) {
    const replyInput = document.getElementById(`reply-input-${commentId}`);
    if (replyInput) {
        replyInput.classList.toggle('hidden');
    }
}

function submitReply(commentId) {
    const replyContent = document.getElementById(`replyContent-${commentId}`).value;
    if (!replyContent) {
        alert('Please enter a reply.');
        return;
    }

    fetch(`/blogs/comments/${commentId}/reply`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ content: replyContent })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error sending reply.');
        }
    })
    .catch(error => console.error('Error:', error));
}

// Like functionality
document.addEventListener("DOMContentLoaded", function() {
    const postId = "{{ $post->id }}";
    const likeButton = document.getElementById("likeButton");
    const likeIcon = document.getElementById("likeIcon");
    const likeCount = document.getElementById("likeCount");
    let isLiked = false;

    fetch(`/blogs/${postId}/check-like`)
        .then(response => response.json())
        .then(data => {
            isLiked = data.liked;
            if (isLiked) {
                likeIcon.setAttribute('fill', 'currentColor');
                likeButton.classList.add('text-red-500');
            }
        })
        .catch(error => console.error('Error:', error));

    likeButton.addEventListener('click', function() {
        const url = `/blogs/${postId}/` + (isLiked ? 'unlike' : 'like');
        const method = isLiked ? 'DELETE' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                isLiked = !isLiked;
                if (isLiked) {
                    likeIcon.setAttribute('fill', 'currentColor');
                    likeButton.classList.add('text-red-500');
                } else {
                    likeIcon.setAttribute('fill', 'none');
                    likeButton.classList.remove('text-red-500');
                }
                likeCount.textContent = new Intl.NumberFormat().format(data.newLikeCount);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>
@endsection
