@extends('layouts.dashboard')

@section('content')
    @foreach ($posts as $post)
        <div class="card">
            <h5 class="card-header">{{$post['title']}}</h5>
            <div class="card-body">
            <a href="{{ route('admin.posts.show', $post['id'])}}" class="btn btn-primary">Go details</a>
            <a href="{{ route('admin.posts.edit', $post['id'])}}" class="btn btn-warning">Modify Post</a>
            </div>
        </div>
    @endforeach
@endsection

