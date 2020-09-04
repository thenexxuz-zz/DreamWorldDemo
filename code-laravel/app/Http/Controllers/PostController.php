<?php

namespace App\Http\Controllers;

use App\Post;
use http\Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('post');
    }

    public function store(Request $request)
    {
        $post = new Post([
            'slug' => uniqid(),
            'title' => $request->input('title'),
            'summary' => $request->input('summary'),
            'body' => $request->input('body'),
            'user_id' => auth()->id(),
        ]);
        $post->save();
        return redirect('dashboard');
    }

    public function show(Request $request, $slug)
    {
        $post = Post::findBySlug($slug);

        if (auth()->id() === $post->user->id) {
            return view('post.edit', [
                'slug' => $slug,
                'post' => $post
            ]);
        }
        return view('error.404');
    }

    public function update(Request $request, $slug)
    {
        $post = Post::findBySlug($slug);
        $post->title = $request->input('title');
        $post->summary = $request->input('summary');
        $post->body = $request->input('body');
        $post->save();

        return redirect('dashboard');
    }

    public function delete(Request $request, $slug)
    {
    }
}
