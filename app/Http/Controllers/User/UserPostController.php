<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserPostController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', auth()->id())
            ->with(['category', 'series'])
            ->latest()
            ->paginate(10);

        return view('user.post.list', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('user.post.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'post_name' => ['required', 'string', 'max:255'],
            'post_content' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'series' => ['nullable', 'string', 'max:255'],
            'tags' => ['nullable', 'string'],
            'hidden' => ['required', 'boolean'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
        ]);

        $seriesId = null;
        if (!empty($validatedData['series'])) {
            $series = Series::firstOrCreate(['name' => trim($validatedData['series'])]);
            $seriesId = $series->id;
        }

        $thumbnailUrl = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $thumbnailUrl = Storage::url($thumbnailPath);
        }

        Post::create([
            'user_id' => auth()->id(),
            'post_name' => $validatedData['post_name'],
            'post_content' => $validatedData['post_content'],
            'category_id' => $validatedData['category_id'],
            'series_id' => $seriesId,
            'tags' => $validatedData['tags'] ?? null,
            'hidden' => (int) $validatedData['hidden'],
            'thumbnail' => $thumbnailUrl,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tạo bài viết thành công.',
        ]);
    }

    public function uploadImage(Request $request)
    {
        $validatedData = $request->validate([
            'image' => ['required', 'image', 'max:2048'],
        ]);

        $imagePath = $validatedData['image']->store('images', 'public');

        return response()->json([
            'success' => true,
            'url' => Storage::url($imagePath),
        ]);
    }

    public function edit(Post $post)
    {
        abort_if($post->user_id !== auth()->id(), 403);

        $categories = Category::all();
        $currentSeries = $post->series;

        return view('user.post.edit', compact('post', 'categories', 'currentSeries'));
    }

    public function update(Request $request, Post $post)
    {
        abort_if($post->user_id !== auth()->id(), 403);

        $validatedData = $request->validate([
            'post_name' => ['required', 'string', 'max:255'],
            'post_content' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'series' => ['nullable', 'string', 'max:255'],
            'tags' => ['nullable', 'string'],
            'hidden' => ['required', 'boolean'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
        ]);

        $seriesId = null;
        if (!empty($validatedData['series'])) {
            $series = Series::firstOrCreate(['name' => trim($validatedData['series'])]);
            $seriesId = $series->id;
        }

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $post->thumbnail = Storage::url($thumbnailPath);
        }

        $post->fill([
            'post_name' => $validatedData['post_name'],
            'post_content' => $validatedData['post_content'],
            'category_id' => $validatedData['category_id'],
            'series_id' => $seriesId,
            'tags' => $validatedData['tags'] ?? null,
            'hidden' => (int) $validatedData['hidden'],
        ]);
        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật bài viết thành công.',
        ]);
    }

    public function destroy(Post $post)
    {
        abort_if($post->user_id !== auth()->id(), 403);

        $post->delete();

        return redirect()->route('blogs.index')->with('success', 'Đã xóa bài viết.');
    }

    public function postsByTag(string $tag)
    {
        $posts = Post::query()
            ->where('hidden', 0)
            ->where('tags', 'like', '%'.$tag.'%')
            ->latest()
            ->get();

        return view('user.post.posts_by_tag', compact('tag', 'posts'));
    }
}
