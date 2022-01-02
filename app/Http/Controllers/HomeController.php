<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class HomeController extends Controller
{
    function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->search;
            $posts = Post::where('title', 'like', '%' . $search . '%')->orderBy('id', 'desc')->paginate(2);
        } else {
            $posts = Post::orderBy('id', 'desc')->paginate(3);
        }
        return view('home', compact('posts'));
    }

    function detail(Request $request, $slug, $postId)
    {
        Post::find($postId)->increment('views');
        $detail = Post::find($postId);
        return view('detail', compact('detail'));
    }

    function save_comment(Request $request, $slug, $id)
    {
        $request->validate([
            'comment' => 'required'
        ]);
        $comments = new Comment();
        $comments->user_id = $request->user()->id;
        $comments->post_id = $id;
        $comments->comment = $request->comment;
        $comments->save();
        return redirect('detail/' . $slug . '/' . $id)->with('msg', 'Comment has been submitted.');
    }
}
