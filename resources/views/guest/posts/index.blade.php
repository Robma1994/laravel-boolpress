@extends('layouts.app')

@section('content')
    @foreach ($posts as $post)
        <div class="card">
            <h5 class="card-header">{{$post['title']}}</h5>
            <div class="card-body">
            </div>
        </div>
    @endforeach
@endsection