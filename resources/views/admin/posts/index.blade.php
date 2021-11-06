@extends('layouts.dashboard')

@section('content')
    @foreach ($posts as $post)
        <div class="card">
            <h5 class="card-header">{{$post['title']}}</h5>
            <div class="card-body">
                <a href="{{ route('admin.posts.show', $post['id'])}}" class="btn btn-primary">Go details</a>
                <a href="{{ route('admin.posts.edit', $post['id'])}}" class="btn btn-warning">Modify Post</a>
                <form class="d-inline confirm-delete-post" method="POST" action="{{ route('admin.posts.destroy', $post['id']) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">DELETE</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection

