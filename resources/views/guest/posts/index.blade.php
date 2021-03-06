@extends('layouts.app')

@section('content')
    @foreach ($posts as $post)
        <div class="card">
            <h5 class="card-header">{{$post['title']}}</h5>
            <div class="card-body">
                <a href="{{ route('posts.show', $post['id'])}}" class="btn btn-primary">Go details</a>
            </div>
        </div>
    @endforeach
@endsection