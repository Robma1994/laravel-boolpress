@extends('layouts.dashboard')

@section('content')
    <form action="{{ route('admin.posts.store')}}" method="POST">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Add Title">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" class="form-control" id="content" placeholder="Add content"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection