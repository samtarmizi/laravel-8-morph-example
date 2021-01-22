
@extends('layouts.app')
<style>
    .display-comment .display-comment {
        margin-left: 40px
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @error('comment')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="card">
                <div class="card-body">
                    <h5>Display Title</h5>
                    <p>{{ $post->title }}</p>
                </div>

                @if($post->comments->count() > 0)
                    <div class="card-body">
                        <h5>Display Comments</h5>
                        @include('post.partials.replies', ['comments' => $post->comments, 'post_id' => $post->id])
                        <hr />
                    </div>
                @endif

                <div class="card-body">
                    <h5>Leave a comment</h5>
                    <form method="post" action="{{ route('comment.add') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="comment" class="form-control" />
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Add Comment" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 