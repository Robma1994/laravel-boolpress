@extends('layouts.dashboard')

@section('content')
    @foreach ($posts as $post)
        <div class="card">
            <div class="d-flex">
                <h5 class="card-header">{{$post['title']}}</h5>
                <button class="btn btn-outline-info">
                    {{-- Utilizziamo l'if perchè abbiamo dato la possibilità di non inserire la categoria inserendo NULL --}}
                    {{-- Se la colonna category è popolata e non è NULL, allora entra in post, entra in category e restituiscimi il name --}}
                    @if ($post->category)
                    {{-- category è l'oggetto istanziato quando abbiamo popolato la classe/tabella CategoriesTableSeeder --}}
                     {{$post->category->name}}
                    @endif
                </button>
            </div>
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

