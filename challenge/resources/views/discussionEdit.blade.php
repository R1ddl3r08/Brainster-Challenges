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
            <h1 class="text-center mb-5">Edit discussion</h1>
            <div class="col-6 mx-auto">
                <form action="{{ route('discussion.update', ['id' => $discussion->id]) }}" method="POST" enctype="multipart/form-data">
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
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $discussion->title }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="photo">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>
                    <div class="form-group mb-3">
                        <label for="short_desct">Description</label>
                        <textarea name="short_desc" id="short_desc" cols="30" rows="3" class="form-control">{{ $discussion->short_desc }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="0">Choose category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $discussion->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
