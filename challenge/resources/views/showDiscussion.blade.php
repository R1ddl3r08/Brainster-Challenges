@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-5">Welcome to the Forum</h1>
            <div class="card px-5">
                <div class="card-body">
                    <p class="text-right">{{ $discussion->category->name }} | {{ $discussion->user->name }}</p>
                    <div>
                        <img class="w-100" src='{{ asset("/storage/$discussion->picture") }}' alt="">
                    </div>
                    <h2 class="mt-3">{{ $discussion->title }}</h2>
                    <p>{{ $discussion->short_desc }}</p>
                </div>
            </div>
            <h2 class="mt-5">Comments:</h2>
            @if(!$comments->isEmpty())
                @foreach($comments as $comment)
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-between">
                            <div class="d-flex">
                                <div>
                                    <p>{{ $comment->user->name }} says:</p>
                                    <p>{{ $comment->comment }}</p>
                                </div>
                                @auth
                                    @if(auth()->user()->is_admin || auth()->user()->id == $comment->user_id)
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('comment.edit', ['id' => $comment->id]) }}" class="btn btn-light"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <form action="{{ route('comment.delete', ['id' => $comment->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-light">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                            <div>
                                <p>{{ $comment->created_at }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h3>No comments yet</h3>
            @endif
            <a href="{{ route('comment.create', ['id' => $discussion->id ]) }}" class="btn btn-secondary d-inline-block mt-3">Add comment</a>
        </div>
    </div>
</div>
@endsection
