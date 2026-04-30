@extends('layouts.user')

@section('content')
<style>
.prose img {
    width: 100%;
    height: auto;
}
</style>

<img class="py-8 w-full max-w-[1200px] max-h-[70vh] mx-auto object-cover transition-all duration-300 cursor-pointer"
    src="{{ $post->thumbnail }}" alt="thumb">

<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full md:w-9/12 px-4">
            <h2 class="text-3xl font-bold text-gray-800 text-center">{{ $post->post_name }}</h2>
            <p class="mt-10 text-gray-500">Đăng bởi:
                <strong class="text-[#98d0c0] cursor-pointer">
                    {{ $post->user ? $post->user->name : 'Người dùng không xác định' }}
                </strong> - Được xuất bản tại Blog vào
                {{ $post->created_at ? $post->created_at->format('d/m/Y') : 'Chưa xác định' }}.
            </p>
            <p class="mt-2 text-gray-500">Cập nhật lần cuối vào
                {{ $post->updated_at ? $post->updated_at->format('d/m/Y') : 'Chưa xác định' }}.
            </p>
            <p class="mt-2 text-gray-500">Thời gian đọc: <strong>{{ $readingTime }} phút.</strong></p>

            <div class="mt-2 flex space-x-4">
                <div class="flex items-center cursor-pointer" id="likeButton">
                    <i class="fas fa-heart" id="likeIcon" style="color: gray;"></i>
                    <span class="ml-1" id="likeCount">{{ $post->likes }}</span>
                </div>

                <div class="flex items-center cursor-pointer">
                    <i class="fas fa-eye text-gray-500"></i>
                    <span class="ml-1">{{ $post->views }}</span>
                </div>

                <div class="flex items-center cursor-pointer">
                    <i class="fas fa-comments text-gray-500"></i>
                    <span class="ml-1">{{ $comments->count() }}</span>
                </div>
            </div>

            <p class="mt-2 text-gray-500">Tags:
                @if (!empty($post->tags))
                @foreach (explode(',', $post->tags) as $tag)
                <span
                    class="bg-[#98d0c0] px-2 py-1 rounded-full text-white mx-1 my-1 text-center inline-block cursor-pointer">{{ trim($tag) }}</span>
                @endforeach
                @else
                N/A
                @endif
            </p>

            <div class="mt-4 flex items-center cursor-pointer" id="readButton">
                <i class="fas fa-volume-up text-[#3c483d]"></i>
                <span class="ml-2 text-[#3c483d]" id="readStatus">Đọc nội dung</span>
            </div>

            @if (Auth::check() && Auth::id() === $post->user_id)
                <div class="mt-4 flex space-x-4">
                    <a href="{{ route('userposts.edit', $post->id) }}" class="bg-[#3c483d] text-white rounded px-4 py-2 hover:bg-[#98d0c0] transition duration-200">Chỉnh sửa</a>

                    <form action="{{ route('userposts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white rounded px-4 py-2 hover:bg-red-600 transition duration-200">Xóa</button>
                    </form>
                </div>
            @endif

            <div class="mt-4 border-t border-gray-200 pt-4">
                <div class="prose prose-lg">
                    {!! $post->post_content !!}
                </div>
            </div>

            <div class="mt-10 border-t border-gray-200 pt-4">
                <h3 class="text-xl font-bold mb-4">Bình luận</h3>

                <div id="comments" class="space-y-4 rounded">
                    @if ($comments->count() > 0)
                    @php
                    $displayedCommentIds = [];
                    @endphp
                    @foreach ($comments as $comment)
                    @if (!in_array($comment->id, $displayedCommentIds))
                    <div class="pb-2">
                        <div class="flex items-start space-x-3 border-s-4 pl-3">
                            <img src="https://via.placeholder.com/40" alt="{{ $comment->user->name }}"
                                class="w-10 h-10 rounded-full">
                            <div>
                                <p class="font-semibold">{{ $comment->user->name }}</p>
                                <p class="text-gray-600 text-sm py-1">{{ $comment->content }}</p>
                                <p class="text-gray-400 text-xs py-1">{{ $comment->created_at->diffForHumans() }}</p>
                                <button class="text-[#3c483d] text-sm mt-1"
                                    onclick="showReplyInput({{ $comment->id }})">Trả
                                    lời</button>
                                <div id="reply-input-{{ $comment->id }}" class="hidden mt-2">
                                    <input id="replyContent-{{ $comment->id }}"
                                        class="border border-gray-300 rounded-md w-full px-3 py-2"
                                        placeholder="Nhập bình luận..." />
                                    <button
                                        class="mt-2 bg-[#3c483d] text-white rounded-md px-4 py-2 hover:bg-[#98d0c0] transition duration-200"
                                        onclick="submitReply({{ $comment->id }})">Gửi</button>
                                </div>
                            </div>
                        </div>

                        @if ($comment->replies->count() > 0)
                        <div class="ml-10 mt-2 space-y-2 reply">
                            @foreach ($comment->replies as $reply)
                            @if (!in_array($reply->id, $displayedCommentIds))
                            <div class="flex items-start space-x-3 border-s-4 pl-3 pt-3">
                                <img src="https://via.placeholder.com/30" alt="{{ $reply->user->name }}"
                                    class="w-8 h-8 rounded-full">
                                <div>
                                    <p class="font-semibold">{{ $reply->user->name }}</p>
                                    <p class="text-gray-600 text-sm py-1">{{ $reply->content }}</p>
                                    <p class="text-gray-400 text-xs py-1">{{ $reply->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @php
                            $displayedCommentIds[] = $reply->id;
                            @endphp
                            @endif
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @php
                    $displayedCommentIds[] = $comment->id;
                    @endphp
                    @endif
                    @endforeach
                    @else
                    <p class="text-gray-500">Chưa có bình luận nào.</p>
                    @endif

                    <div class="mt-6">
                        <h4 class="text-lg font-semibold mb-2">Thêm bình luận của bạn</h4>
                        <div class="flex items-center border border-gray-300 rounded-md shadow-sm">
                            <input id="commentContent"
                                class="flex-1 border-none p-2 rounded-l-md focus:outline-none focus:ring-0 focus:ring-[#3c483d] focus:border-transparent"
                                placeholder="Nhập bình luận..." />
                            <button id="submitComment"
                                class="bg-[#3c483d] text-white rounded-r-md px-4 py-2 hover:bg-[#98d0c0] transition duration-200">
                                Gửi bình luận
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10">
                <a href="{{ route('blogs.index') }}"
                    class="inline-block px-4 py-2 text-sm font-semibold text-white bg-[#3c483d] rounded hover:bg-[#98d0c0] hover:text-black transition duration-200">Quay
                    lại danh sách bài viết</a>
            </div>
        </div>

        <div class="w-full md:w-3/12 px-4 mt-8">
            <h3 class="text-xl font-bold mb-4">Bài viết trong cùng Series</h3>
            <ul>
                @if ($seriesPosts->count() > 0)
                @foreach ($seriesPosts as $seriesPost)
                <li class="mb-4">
                    <a href="{{ route('blogs.show', $seriesPost->id) }}" class="flex items-center space-x-4 text-[#3c483d]">
                        <div>
                            <span class="font-bold hover:underline">{{ $seriesPost->post_name }}</span>
                            @if ($seriesPost->category)
                            <p class="text-gray-500">Thể loại: {{ $seriesPost->category->name }}</p>
                            @endif
                            <p class="text-xs text-gray-500">{{ $seriesPost->created_at->diffForHumans() }}</p>
                        </div>
                    </a>
                </li>
                @endforeach
                @else
                <p class="text-gray-500">Không có bài viết nào trong cùng Series.</p>
                @endif
            </ul>
        </div>

        <div class="w-full px-4 ">
            <h3 class="text-xl font-bold mb-4 mt-4">Bài viết tương tự</h3>
            <div class="inline-flex">
                @foreach ($relatedPosts as $relatedPost)
                <div class="mb-4 post border-b-2 overflow-hidden cursor-pointer flex flex-row md:flex-col items-start rounded w-1/3 gap-3">
                    <a href="{{ route('blogs.show', $relatedPost->id) }}"
                        class="flex-shrink-0 space-x-4 text-[#3c483d]">
                        <img src="{{ $relatedPost->thumbnail }}" class="w-fit object-cover rounded-full"
                             alt="Post Image">
                        <div class="flex-grow p-2">
                            <div class="flex items-center mb-1">
                                <span class="text-xs text-gray-600 mr-3 font-semibold">{{ $relatedPost->user->name }}</span>
                                <span class="text-xs text-gray-400">{{ $relatedPost->created_at->diffForHumans() }}</span>
                            </div>
                            <a href="{{ route('blogs.show', $post->id) }}">
                                <h4 class="text-gray-800 font-semibold mb-1 hover:text-[#98d0c0] transition-colors duration-200">
                                    {{ $relatedPost->post_name }}</h4>
                            </a>
                            <p class="text-xs text-gray-500 leading-relaxed mb-2">
                                {{ Str::limit(strip_tags($post->post_content), 100) }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script src="https://code.responsivevoice.org/responsivevoice.js?key=yourKey"></script>
<script>
const content = @json(strip_tags($post -> post_content));

const readButton = document.getElementById("readButton");
const readStatus = document.getElementById("readStatus");

readButton.addEventListener("click", function() {
    if (responsiveVoice.isPlaying()) {
        responsiveVoice.cancel();
        readStatus.innerText = "Đọc nội dung";
    } else {
        responsiveVoice.speak(content, "Vietnamese Female", {
            onstart: function() {
                readStatus.innerText = "Dừng đọc";
            },
            onend: function() {
                readStatus.innerText = "Đọc nội dung";
            }
        });
    }
});
document.getElementById('submitComment').addEventListener('click', function() {
    const content = document.getElementById('commentContent').value;
    if (!content) return alert('Vui lòng nhập nội dung bình luận.');

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
                alert('Có lỗi xảy ra khi thêm bình luận.');
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
        alert('Vui lòng nhập nội dung trả lời.');
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
                alert('Có lỗi xảy ra khi gửi trả lời.');
            }
        })
        .catch(error => console.error('Error:', error));
}
document.addEventListener("DOMContentLoaded", function() {
    const postId = "{{ $post->id }}";
    const likeButton = document.getElementById("likeButton");
    const likeIcon = document.getElementById("likeIcon");
    let isLiked = false;

    fetch(`/blogs/${postId}/check-like`)
        .then(response => response.json())
        .then(data => {
            isLiked = data.liked;
            likeIcon.style.color = isLiked ? 'rgb(240,82,82)' : 'gray';
        })
        .catch(error => console.error('Error:', error));

    // Xử lý sự kiện nhấn vào nút like/unlike
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
                likeIcon.style.color = isLiked ? 'rgb(240,82,82)' : 'gray';
                likeCount.textContent = data.newLikeCount;
            } else {
                console.error('Error: Could not update like status');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>
@endsection
