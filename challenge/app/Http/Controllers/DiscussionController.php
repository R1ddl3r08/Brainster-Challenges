<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\DiscussionRequest;
use App\Http\Requests\UpdateDiscussionRequest;
use App\Models\Discussion;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class DiscussionController extends Controller
{   
    public function show($id)
    {
        $discussion = Discussion::with(['category', 'user'])->find($id);
        $comments = Comment::with('user')->where('discussion_id', $id)->get();

        return view('showDiscussion', ['discussion' => $discussion, 'comments' => $comments]);
    }

    public function userDiscussions($id)
    {
        $discussions = Discussion::where('user_id', $id)->get();

        return view('home', ['discussions' => $discussions]);
    }

    public function create()
    {
        $categories = Category::get();
        return view('discussionCreate', ['categories' => $categories]);
    }

    public function store(DiscussionRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        } else {
            $photoPath = null;
        }

        $userId = auth()->user()->id;

        $discussion = new Discussion;
        $discussion->title = $validatedData['title'];
        $discussion->short_desc = $validatedData['short_desc'];
        $discussion->category_id = $validatedData['category'];
        $discussion->picture = $photoPath;
        $discussion->user_id = $userId;
        $discussion->save();

        return redirect()->route('home')->with('success', 'Discussion successfully created! It needs to be approved before you dig into it though! :)');
    }

    public function pending()
    {
        $discussions = Discussion::with(['category', 'user'])->where('is_approved', false)->get();

        return view('home', ['discussions' => $discussions, 'actions' => true]);
    }

    public function approve(Request $request, $id)
    {
        $discussion = Discussion::find($id);

        if ($discussion) {
            $discussion->update(['is_approved' => true]);
            return redirect()->back()->with('success', 'Discussion approved successfully.');
        } else {
            return redirect()->back()->with('error', 'Discussion not found.');
        }
    }

    public function delete(Request $request, $id)
    {
        $discussion = Discussion::find($id);

        if ($discussion) {
            $discussion->delete();
            return redirect()->back()->with('success', 'Discussion deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Discussion not found.');
        }
    }

    public function edit($id)
    {
        $discussion = Discussion::find($id);
        $categories = Category::get();

        if ($discussion) {
            return view('discussionEdit', ['discussion' => $discussion, 'categories' => $categories]);
        } else {
            return redirect()->back()->with('error', 'Discussion not found.');
        }
    }

    public function update(UpdateDiscussionRequest $request, $id)
    {
        $discussion = Discussion::find($id);

        if (!$discussion) {
            return redirect()->route('home')->with('error', 'Discussion not found.');
        }
        
        $validatedData = $request->validated();

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $discussion->picture = $photoPath;
        }

        $discussion->title = $validatedData['title'];
        $discussion->short_desc = $validatedData['short_desc'];
        $discussion->category_id = $validatedData['category'];

        $discussion->save();

        return redirect()->route('home')->with('success', 'Discussion successfully updated!');
    }
}
