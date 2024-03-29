<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index ()
    {
        
        $latestPosts = Post::with(['author', 'category'])->latest()->take(3)->get();
        $latestBlogs = User::orderBy(
            Post::select('created_at')
                ->whereColumn('users.id', 'posts.author_id')
                ->latest()
                ->take(1)
        , 'desc')
        ->take(3)->get();

        // $mostViewedPosts = Post::orderBy('views', 'desc')->take(3)->get();
        $mostViewedPosts = Post::with(['author', 'category'])->orderBy('views', 'desc')->take(3)->get();
        $blogCount = User::count();
        return view('welcome',[
         'blogCount' => $blogCount,
         'latestPosts' => $latestPosts,
         'latestBlogs' => $latestBlogs,
         'mostViewedPosts' =>$mostViewedPosts,
        ]);

        
    }
}
