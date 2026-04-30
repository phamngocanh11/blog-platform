<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Post;
use App\Models\User; 
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index(Request $request)
    {
        $query = Bookmark::with(['user', 'post']);

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

        $bookmarks = $query->paginate(11);

        return view('admin.bookmarks.index', compact('bookmarks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        Bookmark::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
        ]);

        return response()->json(['success' => true]);
    }

    public function userBookmarks($userId)
    {
        $bookmarks = Bookmark::with('post')->where('user_id', $userId)->get();
        return view('admin.bookmarks.user', compact('bookmarks'));
    }

    public function postBookmarks($postId)
    {
        $bookmarkedUsers = Bookmark::with('user')->where('post_id', $postId)->get();
        return view('admin.bookmarks.post', compact('bookmarkedUsers'));
    }

    public function destroy($postId)
    {
        $bookmark = Bookmark::where('user_id', auth()->id())->where('post_id', $postId)->first();

        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
