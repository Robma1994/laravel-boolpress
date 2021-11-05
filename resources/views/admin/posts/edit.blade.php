@extends('layouts.dashboard')

@section('content')
    <form action="{{ route('admin.posts.update', $post['id'])}}" method="POST">
        @csrf
        @method('PUT')
        <h1>Edit Post</h1>
        <div class="mb-3">
            <label for="title" class="form-label">Edit Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Edit Title" value="{{$post['title']}}">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Edit Content</label>
            <textarea name="content" class="form-control" id="content" placeholder="Edit content">{!! $post['content'] !!}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection