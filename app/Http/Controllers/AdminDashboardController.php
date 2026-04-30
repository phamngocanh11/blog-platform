<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUserCount = User::count();
        $newUserCount = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $newUsersLast7Days = User::where('created_at', '>=', now()->subDays(7))->count();

        $totalViews = Post::sum('views');
        $viewsLast7Days = Post::where('created_at', '>=', now()->subDays(7))->sum('views');

        $totalPostCount = Post::count();
        $postsLast7Days = Post::where('created_at', '>=', now()->subDays(7))->count();

        $topUsers = User::withCount('posts')
        ->orderBy('posts_count', 'desc')
        ->take(5)
        ->get();

        $topLikedUsers = User::withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(5)
            ->get();

        $userGrowth = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $userGrowth[] = [
                'month' => $month->format('F Y'),
                'count' => User::whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->count(),
            ];
        }

        $topPosts = Post::withCount(['likes', 'comments'])
            ->orderBy('likes_count', 'desc')
            ->orderBy('comments_count', 'desc')
            ->take(5)
            ->get();

        $viewsGrowth = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $viewsGrowth[] = [
                'month' => $month->format('F Y'),
                'count' => Post::whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->sum('views'),
            ];
        }

        $topViewedPostsPerMonth = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $topPost = Post::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->orderBy('views', 'desc')
                ->first();

            if ($topPost) {
                $topViewedPostsPerMonth[] = [
                    'month' => $month->format('F Y'),
                    'post' => $topPost,
                ];
            }
        }
        return view('dashboard', [
            'data' => [
                'userCount' => $totalUserCount,
                'newUserCount' => $newUserCount,
                'newUsersLast7Days' => $newUsersLast7Days,
                'viewsCount' => $totalViews,
                'viewsLast7Days' => $viewsLast7Days,
                'postCount' => $totalPostCount,
                'postsLast7Days' => $postsLast7Days,
                'topUsers' => $topUsers,
                'userGrowth' => $userGrowth,
                'viewsGrowth' => $viewsGrowth,
                'topViewedPostsPerMonth' => $topViewedPostsPerMonth,
                'topLikedUsers' => $topLikedUsers,
                'topPosts' => $topPosts,
            ]
        ]);
    }

}
