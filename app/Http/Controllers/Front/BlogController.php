<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::published()->with('author')->paginate(6);
        $recentPosts = BlogPost::published()->take(4)->get();
        return view('front.blog.index', compact('posts', 'recentPosts'));
    }

    public function show(BlogPost $post)
    {
        if (!$post->is_published) {
            abort(404);
        }

        $post->load('author');
        $recentPosts = BlogPost::published()->where('id', '!=', $post->id)->take(4)->get();
        return view('front.blog.show', compact('post', 'recentPosts'));
    }
}
