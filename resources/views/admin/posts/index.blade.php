@extends('layouts.dashboard')

@section('content')
    @foreach ($posts as $post)
        <div class="card">
            <h5 class="card-header">{{$post['title']}}</h5>
            <div class="card-body">
            <p class="card-text">{{$post['content']}}</p>
            <a href="#" class="btn btn-primary">Go details</a>
            </div>
        </div>
    @endforeach
@endsection

