<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index(Request $request)
    {
        $query = Like::with(['user', 'post']);

        if ($request->filled('username')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('username', 'like', '%' . $request->username . '%');
            });
        }

        if ($request->filled('post_name')) {
            $query->whereHas('post', function($q) use ($request) {
                $q->where('post_name', 'like', '%' . $request->post_name . '%');
            });
        }

        $likes = $query->paginate(11);

        return view('admin.likes.index', compact('likes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        Like::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
        ]);

        return response()->json(['success' => true]);
    }

    public function userLikes($userId)
    {
        $likes = Like::with('post')->where('user_id', $userId)->get();
        return view('admin.likes.user', compact('likes'));
    }

    public function postLikes($postId)
    {
        $likedUsers = Like::with('user')->where('post_id', $postId)->get();
        return view('admin.likes.post', compact('likedUsers'));
    }

    public function destroy($postId)
    {
        $like = Like::where('user_id', auth()->id())->where('post_id', $postId)->first();

        if (!$like && auth()->user()->cannot('delete', Like::class)) {
            return response()->json(['success' => false], 403);
        }

        if ($like) {
            $like->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function like($postId)
    {
        $post = Post::findOrFail($postId);

        if (!Like::where('user_id', auth()->id())->where('post_id', $postId)->exists()) {
            \DB::transaction(function () use ($postId, $post) {
                Like::create([
                    'user_id' => auth()->id(),
                    'post_id' => $postId,
                ]);
                $post->increment('likes');
            });

            return response()->json(['success' => true,'newLikeCount' => $post->likes,]);
        }

        return response()->json(['success' => false]);
    }

    public function unlike($postId)
    {
        $like = Like::where('user_id', auth()->id())->where('post_id', $postId)->first();

        if ($like) {
            $like->delete();

            // Giảm số lượng like của bài viết
            $post = Post::findOrFail($postId);
            $post->decrement('likes');

            return response()->json(['success' => true, 'newLikeCount' => $post->likes]);
        }

        return response()->json(['success' => false], 404);
    }

//     public function checkLike($postId)
//     {
//         $liked = Like::where('post_id', $postId)
//             ->where('user_id', auth()->id())
//             ->exists();
//
//         return response()->json(['liked' => $liked]);
//     }

    public function checkLike($postId)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (auth()->check()) {
            $liked = Like::where('post_id', $postId)
                ->where('user_id', auth()->id())
                ->exists();
            return response()->json(['liked' => $liked]);
        } else {
            return response()->json(['liked' => false]); // Nếu người dùng chưa đăng nhập
        }
    }
}
