@extends('layouts.dashboard')

@section('content')

    <div class="card">
        <h1 class="card-header">Description</h1>
        <div class="card-body">
        <p>{{$details['content']}}</p>   
        <a href="{{ route('admin.posts.index')}}" class="btn btn-primary">Back to list</a>
        </div>
    </div>
@endsection

