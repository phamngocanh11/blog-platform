<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query()->with(['user', 'category', 'series']);

        if ($request->filled('search')) {
            $query->where('post_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('tags')) {
            $query->where('tags', 'like', '%' . $request->tags . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('series')) {
            $query->where('series_id', $request->series);
        }

        if ($request->filled('hidden')) {
            $query->where('hidden', $request->hidden);
        }

        if ($request->filled('pinned')) {
            $query->where('pinned', $request->pinned);
        }

        $posts = $query->paginate(10);
        $categories = Category::all();
        $seriesList = Series::all();

        return view('admin.posts.index', compact('posts', 'categories', 'seriesList'));
    }

    public function create()
    {
        $categories = Category::all();
        $series = Series::all();
        return view('admin.posts.create', compact('categories', 'series'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'post_name' => 'required|string|max:255',
                'post_content' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'series_id' => 'nullable|exists:series,id',
                'tags' => 'nullable|string',
                'hidden' => 'required|boolean',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            \Log::info('Thumbnail upload attempt:', [$request->file('thumbnail')]);

            $thumbnailUrl = null;

            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $path = $file->store('thumbnails', 'public');
                $thumbnailUrl = Storage::url($path);
            }

            $tags = $request->input('tags');
            $tagsArray = $tags ? array_map('trim', explode(',', $tags)) : [];
            $validatedData = $request->only(['post_name', 'post_content', 'category_id', 'series_id', 'hidden']);
            $validatedData['tags'] = implode(',', $tagsArray);
            $validatedData['thumbnail'] = $thumbnailUrl;
            $validatedData['user_id'] = auth()->id();

            Post::create($validatedData);

            return response()->json(['success' => true, 'message' => 'Bài viết đã được tạo thành công!']);
        } catch (\Exception $e) {
            \Log::error('Lỗi trong phương thức store: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.'], 500);
        }
    }

    public function show(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->with('user')->get();

        $readingTime = ceil(str_word_count(strip_tags($post->post_content)) / 150);

        return view('user.blog.show', compact('post', 'comments', 'readingTime'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $series = Series::all();
        return view('admin.posts.edit', compact('post', 'categories', 'series'));
    }

    public function update(Request $request, Post $post)
    {
        // Validate các dữ liệu đầu vào
        $request->validate([
            'post_name' => 'required|string|max:255',
            'post_content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'series_id' => 'nullable|exists:series,id',
            'hidden' => 'required|boolean',
            'tags' => 'nullable|string',
            'pinned' => 'nullable|boolean', // Thêm validation cho 'pinned'
        ]);

        try {
            $tags = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];
            $tagsString = implode(',', $tags);

            $validatedData = $request->only(['post_name', 'post_content', 'category_id', 'series_id', 'hidden']);
            $validatedData['tags'] = $tagsString;

            $validatedData['pinned'] = $request->input('pinned', 0); // Giá trị mặc định là 0 nếu không có

            $post->update($validatedData);

            return response()->json(['success' => true, 'message' => 'Bài viết đã được cập nhật thành công!']);
        } catch (\Exception $e) {
            \Log::error('Lỗi cập nhật bài viết: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.'], 500);
        }
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return redirect()->route('posts.index')->with('status', 'Bài viết đã được xóa thành công!');
        } catch (\Exception $e) {
            \Log::error('Lỗi xóa bài viết: ' . $e->getMessage());
            return redirect()->route('posts.index')->with('error', 'Có lỗi xảy ra khi xóa bài viết.');
        }
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('images', 'public');

            return response()->json(['success' => true, 'url' => Storage::url($imagePath)]);
        }

        return response()->json(['success' => false, 'message' => 'Upload failed.']);
    }


}
