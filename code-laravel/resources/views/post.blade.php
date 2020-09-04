@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="title">New Post</div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('post.store') }}">
                        <div class="form-group">
                            @csrf
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" name="title"/>
                        </div>
                        <div class="form-group">
                            <label for="summary">Summary:</label>
                            <input type="text" class="form-control" name="summary"/>
                        </div>
                        <div class="form-group">
                            <label for="body">Body:</label>
                            <textarea rows="5" columns="5" class="form-control" name="body"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
