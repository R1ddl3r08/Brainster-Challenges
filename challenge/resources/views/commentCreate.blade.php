@extends('layouts.app')

@section('content')
   <div class="col-6 mx-auto">
        <form action="{{ route('comment.store', ['id' => request()->route('id')]) }}" method="POST">
            @csrf
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group mb-3">
                <label for="comment">Comment</label>
                <textarea name="comment" id="comment" cols="30" rows="3" class="form-control">{{ old('comment') }}</textarea>
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
   </div>
@endsection