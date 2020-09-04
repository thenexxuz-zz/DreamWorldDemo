@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="title">My Posts</div>
                    <a class="make-post" href="/post">Post</a>
                </div>
                @if( count($my_posts) )
                    @foreach( $my_posts as $mp )
                        <div class="card-body post editable" @click.stop="e => e.target.classList.toggle('active')">
                            <a class="edit" href="/post/{{ $mp->slug }}">Edit</a>
                            <div class="post-title">{{ $mp->title }}</div>
                            <div class="post-summary">{{ $mp->summary }}</div>
                            <div class="post-body">{{ $mp->body }}</div>
                        </div>
                    @endforeach
                @else
                    <div class="card-body">
                        You have not posted anything!
                    </div>
                @endif
            </div>
            <br>
            <div class="card">
                <div class="card-header">Others Posts</div>
                @if( count($others_posts) )
                    @foreach( $others_posts as $op )
                        <div class="card-body post" @click.stop="e => e.target.classList.toggle('active')">
                            <div class="post-title">{{ $op->title }}</div>
                            <div class="post-summary">{{ $op->summary }}</div>
                            <div class="post-author">{{ $op->user->name }}</div>
                            <div class="post-body">{{ $op->body }}</div>
                        </div>
                    @endforeach
                @else
                    <div class="card-body">
                        Nobody has posted anything!
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection





