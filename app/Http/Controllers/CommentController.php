<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        // Kiểm tra parent comment nếu có
        if ($request->parent_id) {
            $parentComment = Comment::find($request->parent_id);
            
            // Kiểm tra parent comment có thuộc cùng post không
            if ($parentComment && $parentComment->post_id != $postId) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Parent comment không thuộc bài viết này.'
                ], 400);
            }

            // Giới hạn độ sâu nested comments (tối đa 2 cấp)
            if ($parentComment && $parentComment->parent_id !== null) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Chỉ được reply tối đa 2 cấp.'
                ], 400);
            }
        }

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->post_id = $postId;
        $comment->user_id = auth()->id();
        $comment->parent_id = $request->input('parent_id');
        $comment->save();

        $post = Post::findOrFail($postId);
        $post->increment('comments');

        return response()->json(['success' => true]);
    }

    public function replyToComment(Request $request, $commentId)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = Comment::find($commentId);
        if (!$comment) {
            return response()->json(['success' => false, 'message' => 'Comment not found.'], 404);
        }

        // Giới hạn độ sâu nested comments (tối đa 2 cấp)
        if ($comment->parent_id !== null) {
            return response()->json([
                'success' => false, 
                'message' => 'Chỉ được reply tối đa 2 cấp.'
            ], 400);
        }

        try {
            $reply = new Comment();
            $reply->content = $request->get('content');
            $reply->user_id = auth()->id(); 
            $reply->parent_id = $commentId; 
            $reply->post_id = $comment->post_id;
            $reply->save();

            return response()->json(['success' => true, 'comment' => $reply]);
        } catch (\Exception $e) {
            \Log::error('Reply error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra.'], 500);
        }
    }
}
