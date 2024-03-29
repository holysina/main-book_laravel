<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(User $user)
    {
        $posts = $user->posts()->with(['category', 'tags'])->paginate(5);
        $tags = Tag::WhereHas('posts', function($query) use($user) {
            $query->where('author_id', $user->id);
        })->get();

        return view('blog.index', [
            'blog' => $user,
            'posts' => $posts,
            'tags' => $tags,
            'categories' => $user->categories,

        ]);
    }
}