<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required|min:3',
        ]);

        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->user()->associate($request->user());
        $post = Post::find($request->post_id);
        $post->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required|min:3',
        ]);
        
        $reply = new Comment();
        $reply->comment = $request->get('comment');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($reply);

        return back();
    }
}
