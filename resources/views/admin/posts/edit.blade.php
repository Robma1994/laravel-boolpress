@extends('layouts.dashboard')

@section('content')
    <form action="{{ route('admin.posts.update', $post['id'])}}" method="POST">
        @csrf
        @method('PUT')
        <h1>Edit Post</h1>
        <div class="mb-3">
            <label for="title" class="form-label">Edit Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Edit Title" class="@error('title') is-invalid @enderror" value="{{old('title', $post['title'])}}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Edit Content</label>
            <textarea name="content" class="form-control" id="content" placeholder="Edit content" class="@error('content') is-invalid @enderror">{!! old('content', $post['content']) !!}</textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection