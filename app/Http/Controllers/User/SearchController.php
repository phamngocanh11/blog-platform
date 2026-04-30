<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim((string) $request->input('query', ''));
        $searchType = (string) $request->input('search_type', 'content');
        $filter = (string) $request->input('filter', '');

        $users = collect();
        $postsQuery = Post::query()->with('user')->where('hidden', 0);

        if ($query !== '') {
            if ($searchType === 'author') {
                $users = User::query()
                    ->where('name', 'like', "%{$query}%")
                    ->take(10)
                    ->get();

                $postsQuery->whereHas('user', function ($builder) use ($query) {
                    $builder->where('name', 'like', "%{$query}%");
                });
            } elseif ($searchType === 'title') {
                $postsQuery->where('post_name', 'like', "%{$query}%");
            } else {
                $postsQuery->where('post_content', 'like', "%{$query}%");
            }
        }

        switch ($filter) {
            case 'newest':
                $postsQuery->latest();
                break;
            case 'oldest':
                $postsQuery->oldest();
                break;
            case 'views_asc':
                $postsQuery->orderBy('views');
                break;
            case 'views_desc':
                $postsQuery->orderByDesc('views');
                break;
            case 'likes_asc':
                $postsQuery->orderBy('likes');
                break;
            case 'likes_desc':
                $postsQuery->orderByDesc('likes');
                break;
            case 'comments_asc':
                $postsQuery->orderBy('comments');
                break;
            case 'comments_desc':
                $postsQuery->orderByDesc('comments');
                break;
            default:
                $postsQuery->latest();
                break;
        }

        $posts = $postsQuery->paginate(12)->withQueryString();

        return view('user.search.index', compact('query', 'users', 'posts'));
    }
}
