@extends('layouts.app')

@section('content')

    <section class="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <div class="mainpost">
                        @if($post->image != '')
                            <div class="text-center">
                                <img src="{{ asset('post-images') }}/{{ $post->image }}" style="width: 100%;" alt="" class="card-img-top mb-2">
                            </div>
                        @endif

                        <div class="post-meta d-flex justify-content-between">
                            <div class="category"><a href="#">{{ $post->category->title }}</a></div>
                        </div>
                        <div class="mainpost-title">
                            <h1>{{ $post->title }}<span class="mx-3"><i class="far fa-bookmark"></i></span></h1>
                            <footer class="mainpost-title-footer row align-items-center">
                                <div class="mainpost-footer-img" style="width: 60px;">
                                    @if ($post->user->profile_image)
                                        <img src="{{ asset('profile-images') }}/{{ $post->user->profile_image }}" style="height: 40px; width: 40px;" class="rounded-circle" alt="">
                                    @else 
                                        <img src="{{ asset('images/avatar/avatar.jpeg') }}" class="rounded-circle" style="height: 40px; width: 40px;" alt="">
                                    @endif
                                </div>
                                <div class="title">
                                    <span class="name text-capitalize">{{ $post->user->username }}</span>
                                </div> 
                                <div class="date">
                                    <span class="date-text"><i class="far fa-clock"></i> &nbsp; {{ Carbon\Carbon::parse($post->created_at)->format('d F Y, g:i a') }}</span>
                                </div> 
                                <div class="comments">
                                    <span class="comments-num"><i class="far fa-comment-dots"></i> {{ $comments->count() }}</span>
                                </div> 
                                <div class="views">
                                    <span><i class="far fa-eye"></i> {{ $views->count() }}</span>
                                </div>
                            </footer>
                        </div>

                        <div class="mainpost-body">
                            <p class="lead">
                                {{ $post->body }}
                            </p> <br><br>
                        
                        </div>
                    </div>

                    <section class="comments">
                        @if (Session::has('comment_saved'))
                            <div class="alert alert-success">{{ Session::get('comment_saved') }}</div>
                        @endif
                        <div class="comments-header d-flex">
                            <h5>Posts Comments</h5> &nbsp;
                            <span>({{ $comments->count() }})</span>
                        </div>
                        <div class="comment-body">

                            @if ($comments->count() > 0)
                                @php
                                    $sn = 1; 
                                @endphp

                                @foreach ($comments as $comment)
                                    <div class="comment-post media">
                                        @if ($comment->user->profile_image)
                                            <img src="{{ asset('profile-images') }}/{{ $comment->user->profile_image }}" alt="" class="align-self-start mr-3 rounded-circle" height="40" width="40">
                                        @else 
                                            <img src="{{ asset('images/avatar/avatar.jpeg') }}" class="align-self-start mr-3 rounded-circle" height="40" width="40" alt="">
                                        @endif
                                        <div class="media-body">
                                            <strong>{{ $comment->user->username }}</strong><br><small>{{ Carbon\Carbon::parse($comment->created_at)->format('d F Y, g:i a') }}</small>
                                            <p>
                                                {{ $comment->comment }}
                                            </p>
                                            <a href="#reply-{{ $sn }}" data-toggle="collapse"><small>Reply</small></a>
                                            <div class="collapse mb-3" id="reply-{{ $sn }}">
                                                <form action="{{ route('post.reply', ['post' => $post->id, 'comment' => $comment->id]) }}" method="post">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="text" placeholder="reply..." name="reply" class="form-control @error('reply') is-invalid @enderror">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary">reply</button>
                                                        </div>
                                                    </div>
                                                    @error('reply') <small class="text-danger">{{ $message }}</small> @enderror
                                                </form>
                                            </div>
                                            <div class="blockquote-footer">Replies <i class="fas fa-reply"></i></div>

                                            @if ($comment->reply->count() > 0)
                                                @foreach ($comment->reply as $reply)
                                                    <div class="reply media">
                                                        @if ($comment->user->profile_image)
                                                            <img src="{{ asset('profile-images') }}/{{ $reply->user->profile_image }}" alt="" class="align-self-start mr-3 rounded-circle" height="40" width="40">
                                                        @else 
                                                            <img src="{{ asset('images/img/user.svg') }}" alt="" class="align-self-start mr-3 img-fluid" style="width: 40px;">
                                                        @endif
                                                        <div class="media-body">
                                                            <strong>{{ $reply->user->username }}</strong><br><small>{{ Carbon\Carbon::parse($reply->created_at)->format('d F Y, g:i a') }}</small>
                                                            <p>
                                                                {{ $reply->reply }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>
                                    
                                    @php
                                        $sn++; 
                                    @endphp 
                                @endforeach

                            @else
                                <div class="alert alert-secondary">There are no comments for this post yet</div>
                            @endif
                            
                            
                        </div>
                    </section>
                    <section class="reply-form">
                        <div class="reply-header">
                            <h5>Leave a Comment</h5>
                        </div>
                        <form method="POST" action="{{ route('post.comment', ['post' => $post->id]) }}">
                            @csrf
                            <div class="p-3">
                                <textarea class="reply-input col-md-12 mb-0 @error('comment') is-invalid @enderror" name="comment" placeholder="Type your comment" rows="5"></textarea>
                                @error('comment')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <br><br>
                                <button type="submit" class="btn btn-secondary">Post Comment</button>
                            </div>
                        </form>
                    </section>
                </div>

                @include('includes.widget')
            </div>
        </div>
    </section>

@endsection
