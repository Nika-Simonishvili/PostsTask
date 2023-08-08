@extends('layouts.app')

@section('content')
    <div class="container-fluid table-top">

        <a href="{{route('posts.index')}}">
            <button type="button" class="btn btn-primary">Go Back</button>
        </a>

        <div class="form-container">
            <h2 class="mb-4">Add Post</h2>
            <form action="{{route('posts.update', ['post' => $post['id']])}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="taskTitle" class="col-sm-3 col-form-label">Post Title</label>
                    <div class="col-sm-9">
                        <input type="text"
                               class="form-control"
                               value="{{$post['title']}}"
                               id="title" name="title"
                               required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="taskDescription" class="col-sm-3 col-form-label">Post Body</label>
                    <div class="col-sm-9">
                        <textarea class="form-control"
                                  id="body" name="body"
                                  rows="3" required>
                            {{$post['body']}}
                        </textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
        </div>
    </div>
@endsection