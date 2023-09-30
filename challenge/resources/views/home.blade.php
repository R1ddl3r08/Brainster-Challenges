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
            <a href="/discussion/create" class="btn btn-secondary">Add new discussion</a>
            @auth
                <div class="mt-2">
                    <a href="/discussions/user/{{ auth()->user()->id }}" class="btn btn-primary">Your discussions</a>
                </div>
                @if(auth()->user()->is_admin)
                    <div class="mt-2">
                        <a href="/discussion/pending" class="btn btn-primary">Approve discussion</a>
                    </div>
                @endif
            @endauth
            <div class="row mt-5">
                @if(!$discussions->isEmpty())
                    @foreach($discussions as $discussion)
                        <div class="card p-3 mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <a href="{{ route('discussion.show', ['id' => $discussion->id]) }}" class="text-decoration-none text-black">
                                            <div class="row">
                                                <div class="col-4">
                                                    <img src='{{ asset("/storage/$discussion->picture") }}' alt="Discussion photo" class="w-100">
                                                </div>
                                                <div class="col-8">
                                                    <h3>{{ $discussion->title }}</h3>
                                                    <p>{{ $discussion->short_desc }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-3 align-self-center">
                                        <div class="row">
                                            @auth
                                                @if(auth()->user()->is_admin || auth()->user()->id == $discussion->user_id)
                                                    <div class="col d-flex">
                                                        @if(auth()->user()->is_admin && $discussion->is_approved == false)
                                                            <form action="{{ route('discussion.approve', ['id' => $discussion->id]) }}" method="POST">
                                                                @csrf
                                                                <button class="btn btn-light">
                                                                    <i class="fa-solid fa-check"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        <a href="{{ route('discussion.edit', ['id' => $discussion->id]) }}" class="btn btn-light"><i class="fa-solid fa-pen-to-square"></i></a>
                                                        <form action="{{ route('discussion.delete', ['id' => $discussion->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-light">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endauth
                                            <div class="col">
                                                <p class="text-secondary">{{ $discussion->category->name }} | {{ $discussion->user->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h2 class="text-center text-secondary">Nothing here yet! Start a topic!</h2>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
