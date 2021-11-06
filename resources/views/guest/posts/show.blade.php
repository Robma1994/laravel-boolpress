@extends('layouts.app')

@section('content')

    <div class="card">
        <h1 class="card-header">Description</h1>
        <div class="card-body">
            <h1>{{$post['title']}}</h1>
            <p>{{$post['content']}}</p>   
            <a href="{{ route('posts.index')}}" class="btn btn-primary">Back to list</a>
        </div>
    </div>
@endsection

