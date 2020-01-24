@extends('layouts.master')
@section('content')
    @include('includes.message-block')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header>
                <h3>What do you have to say?</h3>
                <form action="{{ route('post.create') }}" method="post">
                    <div class="form-group">
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control" value="{{ Request::old('body') }}"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create post</button>
                    <input type="hidden" name="_token" value="{{ Session::token()  }}">

                </form>
            </header>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-3-offset">
            <header><h3>What do people say...</h3></header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{ $post->id }}">
                    <p>{{ $post->body }}</p>
                    <div class="info">
                        Posted by {{$post->user->first_name }} on {{ $post->created_at }}
                    </div>
                    <div class="interaction">
                        <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like ==1 ? 'You like this post' : 'Like': 'Like' }}</a>
                        <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like ==0 ? 'You don\'t like this post' : 'DisLike': 'DisLike' }}</a>

                        @if(Auth::user() == $post->user)
{{--                            <a href="{{ route('post.edit', ['post->']) }}">Edit</a>--}}
                            <a href="#" class="edit">Edit</a>
                            <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
                        @endif
                    </div>
                </article>
                @endforeach

        </div>
    </section>
    <div class="modal" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">Edit the post</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let token = '{{Session::token() }}';
        let urlEdit  = '{{ route('edit') }}';
        let urlLike  = '{{ route('like') }}';
    </script>
    @endsection
