<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request, Post $post)
    {
        $data = [
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'text' => $request->text
        ];
        Comment::create($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id === auth()->id()){
            $comment->delete();
        }

        return redirect()->back();
    }
}
