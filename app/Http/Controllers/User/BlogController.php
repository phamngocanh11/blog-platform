<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $baseQuery = Post::query()
            ->with(['user', 'category', 'series'])
            ->where('hidden', 0);

        $pinnedPosts = (clone $baseQuery)
            ->where('pinned', 1)
            ->latest()
            ->take(5)
            ->get();

        $recommendedPosts = (clone $baseQuery)
            ->where('pinned', 0)
            ->latest()
            ->take(6)
            ->get();

        $allPosts = (clone $baseQuery)
            ->latest()
            ->paginate(10);

        $mostLikedPosts = (clone $baseQuery)
            ->orderByDesc('likes')
            ->take(5)
            ->get();

        $mostViewedPosts = (clone $baseQuery)
            ->orderByDesc('views')
            ->take(5)
            ->get();

        return view('user.blog.index', compact(
            'pinnedPosts',
            'recommendedPosts',
            'allPosts',
            'mostLikedPosts',
            'mostViewedPosts'
        ));
    }

    public function show(Post $post)
    {
        if ((int) $post->hidden === 1) {
            abort(404);
        }

        $post->load(['user', 'category', 'series']);
        $post->increment('views');

        $comments = Comment::query()
            ->with(['user', 'replies.user'])
            ->where('post_id', $post->id)
            ->whereNull('parent_id')
            ->latest()
            ->get();

        $readingTime = max(1, (int) ceil(str_word_count(strip_tags((string) $post->post_content)) / 180));

        $seriesPosts = Post::query()
            ->with(['user', 'category'])
            ->where('series_id', $post->series_id)
            ->where('id', '!=', $post->id)
            ->where('hidden', 0)
            ->latest()
            ->take(8)
            ->get();

        $relatedPosts = Post::query()
            ->with('user')
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('hidden', 0)
            ->latest()
            ->take(3)
            ->get();

        return view('user.blog.show', compact(
            'post',
            'comments',
            'readingTime',
            'seriesPosts',
            'relatedPosts'
        ));
    }
}
