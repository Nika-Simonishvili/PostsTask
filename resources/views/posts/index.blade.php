@extends('layouts.app')

@section('content')
    <div class="container-fluid table-top">

        <a href="{{route('posts.create')}}">
            <button type="button" class="btn btn-primary">Add new post.</button>
        </a>

        @if(Session::has('success'))
            <p class="text-success">{{ session()->get('success') }}</p>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">user Identifier</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>

            @forelse($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->userId}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->body}}</td>
                    <td>
                        <a href="{{route('posts.show', ['post' => $post->id])}}">
                            <button type="button" class="btn btn-primary">View</button>
                        </a>

                        <a href="{{route('posts.edit', ['post' => $post->id])}}">
                            <button type="button" class="btn btn-success">Edit</button>
                        </a>

                        <form action="{{route('posts.destroy', ['post' => $post->id])}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>
            @empty
                <p>No Posts yet.</p>
            @endforelse

            </tbody>
        </table>
    </div>
@endsection