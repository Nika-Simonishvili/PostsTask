@extends('layouts.app')

@section('content')
    <div class="container-fluid table-top">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $post['title'] }}</h5>
                <p class="card-text">{{ $post['body'] }}</p>
            </div>
        </div>

        <a href="{{route('posts.edit', ['post' => $post['id']])}}">
            <button type="button" class="btn btn-success">Edit</button>
        </a>


        <form action="{{route('posts.destroy', ['post' => $post['id']])}}" method="POST">
            @csrf
            @method("DELETE")
            <input type="submit" class="btn btn-danger" value="Delete">
        </form>
    </div>
@endsection