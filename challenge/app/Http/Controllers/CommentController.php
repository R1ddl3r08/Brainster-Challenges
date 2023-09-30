<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Discussion;
use App\Models\Comment;

class CommentController extends Controller
{
    public function create()
    {
        return view('commentCreate');
    }

    public function store(CommentRequest $request, $id)
    {
        $userId = Auth::id();

        $discussion = Discussion::find($id);

        if(!$discussion){
            return redirect()->route('home')->with('error', 'Discussion not found');
        }

        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->user_id = $userId;
        $comment->discussion_id = $id;
        $comment->save();

        return redirect()->route('discussion.show', ['id' => $id])->with('success', 'Comment added successfully.');
    }

    public function edit($id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            return view('commentEdit', ['comment' => $comment]);
        } else {
            return redirect()->back()->with('error', 'Comment not found.');
        }
    }

    public function update(CommentRequest $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->route('home')->with('error', 'Comment not found.');
        }
        
        $validatedData = $request->validated();

        $comment->comment = $validatedData['comment'];

        $comment->save();

        return redirect()->route('discussion.show', ['id' => $comment->discussion_id])->with('success', 'Comment updated successfully.');
    }

    public function delete(Request $request, $id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Comment not found.');
        }
    }
}
