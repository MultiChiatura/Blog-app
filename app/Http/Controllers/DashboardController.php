<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

        $userPostsCount = Post::where('user_id', auth()->id())->count();
        $latestPostLikeCount = Post::withCount('postLikes')->latest()->first()->post_likes_count;

        $userPostIds = Post::where('user_id', auth()->id())->select('id')->get()->pluck('id');
        $userPostsLikeCount = DB::table('user_post')->whereIn('post_id', $userPostIds)->count();
        return view('dashboard', [
            'userPostsCount' => $userPostsCount,
            'latestPostLikeCount' => $latestPostLikeCount,
            'userPostsLikeCount' => $userPostsLikeCount
        ]);
    }
}
