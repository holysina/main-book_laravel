<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Post::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('Admin.Post.index',[
            'posts' => $request->user()->posts()->paginate(2),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('Admin.Post.create',[
            'categories' => $request->user()->categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $request->user()->posts()->create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug') ?? Str::slug($request->input('title')),
            'body' => $request->input('body'),
            'category_id' => $request->input('category_id'),
            'published_at' => $request->input('published_at'),
            'is_draft' => $request->boolean('is_draft') ?? false,
            'image' => $request->file('image')->store('post-image', 'public'),
        ]);

        return to_route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Post $post)
    {
        return view('admin.post.edit', [
            'categories' => $request->user()->categories,
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($post->image);

            $post->image = $request->file('image')->store('post-image', 'public');
        }

        $post->fill([
            'title' => $request->input('title'),
            'slug' => $request->input('slug') ?? Str::slug($request->input('title')),
            'body' => $request->input('body'),
            'category_id' => $request->input('category_id'),
            'published_at' => $request->input('published_at'),
            'is_draft' => $request->boolean('is_draft') ?? false,
        ]);

        $post->save();

        $post->tags()->sync(Tag::findOrCreateFromRequest($request));

        return to_route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::disk('public')->delete($post->image);

        $post->delete();

        return to_route('post.index');
    }
}
