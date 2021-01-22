<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
        ]);

        Post::create([
            'title' => $request->title,
            'slug' => \Str::slug($request->title)
        ]);

        return redirect()->back();
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }
}
