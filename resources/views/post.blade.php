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
                                        <img src="{{ asset('profile-images') }}/{{ $post->user->profile_image }}" height="50" class="rounded-circle" alt="">
                                    @else 
                                        <img src="{{ asset('images/avatar/avatar.jpeg') }}" class="rounded-circle" height="50" alt="">
                                    @endif
                                </div>
                                <div class="title">
                                    <span class="name text-capitalize">{{ $post->user->username }}</span>
                                </div> 
                                <div class="date">
                                    <span class="date-text"><i class="far fa-clock"></i> &nbsp; {{ Carbon\Carbon::parse($post->created_at)->format('d F Y, g:i a') }}</span>
                                </div> 
                                <div class="comments">
                                    <span class="comments-num"><i class="far fa-comment-dots"></i> 12</span>
                                </div> 
                                <div class="views">
                                    <span><i class="far fa-eye"></i> 500</span>
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
                        <div class="comments-header d-flex">
                            <h5>Posts Comments</h5> &nbsp
                            <span>(3)</span>
                        </div>
                        <div class="comment-body">
                            <div class="comment-post media">
                                <img src="{{ asset('images/img/user.svg') }}" alt="" class="align-self-start mr-3 img-fluid" style="width: 40px;">
                                <div class="media-body">
                                    <strong>Mark Smith</strong><br><small>May 2020</small>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    </p>
                                    <a href=""><small>Reply</small></a>

                                    <cite class="replies">Replies <i class="fas fa-reply"></i></cite>
                                    <div class="reply media">
                                        <img src="{{ asset('images/img/user.svg') }}" alt="" class="align-self-start mr-3 img-fluid" style="width: 40px;">
                                        <div class="media-body">
                                            <strong>Mark Smith</strong><br><small>May 2020</small>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="reply media">
                                        <img src="{{ asset('images/img/user.svg') }}" alt="" class="align-self-start mr-3 img-fluid" style="width: 40px;">
                                        <div class="media-body">
                                            <strong>Mark Smith</strong><br><small>May 2020</small>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="comment-post media">
                                <img src="{{ asset('images/img/user.svg') }}" alt="" class="align-self-start mr-3 img-fluid" style="width: 40px;">
                                <div class="media-body">
                                    <strong>Mark Smith</strong><br><small>May 2020</small>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    </p>
                                    <a href=""><small>Reply</small></a>

                                </div>
                            </div>
                            <div class="comment-post media">
                                <img src="{{ asset('images/img/user.svg') }}" alt="" class="align-self-start mr-3 img-fluid" style="width: 40px;">
                                <div class="media-body">
                                    <strong>Mark Smith</strong><br><small>May 2020</small>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    </p>
                                    <a href=""><small>Reply</small></a>

                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="reply-form">
                        <div class="reply-header">
                            <h5>Leave a Comment</h5>
                        </div>
                            <form>
                                <div class="row p-3">
                                    <input type="text" class="reply-input mr-md-3 col-md" placeholder="Enter your Name">
                                    <input type="text" class="reply-input ml-md-3 col-md" placeholder="Enter your Email (will not be published)">
                                    <textarea class="reply-input col-md-12" placeholder="Type your comment" rows="5"></textarea>
                                    <button class="btn btn-secondary">Submit Comment</button>
                                </div>
                            </form>
                    </section>
                </div>



                @include('includes.widget')
            </div>
        </div>
    </section>

@endsection
