<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Question;
use App\Models\Reply;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function likeQuestion(Question $question)  {
        $question->increment('like');
        return back();
    }

    public function dislikeQuestion(Question $question)  {
        $question->decrement('like');

        return back();
    }

    public function likeComment(Comment $comment) {
        $comment->increment('like');

        return back();
    }

    public function dislikeComment(Comment $comment) {
        $comment->decrement('like');

        return back();
    }

    public function likeReply(Reply $reply) {
        $reply->increment('like');

        return back();
    }

    public function dislikeReply(Reply $reply) {
        $reply->decrement('like');

        return back();
    }


    
}
