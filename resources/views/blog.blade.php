@extends('layouts.app')

@section('content')

    <section class="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <style>
                        nav svg{
                            height: 20px;
                        }
                        nav .flex {
                            display: none;
                        }
                    </style>

                    <div class="row blog-post">
                        @foreach ($posts as $post)

                            <div class="card col-lg-6 p-0">
                                <a class="card-post" href="{{ route('post.show', ['post' => $post->id]) }}">
                                    <div class="text-center">
                                        <img src="{{ asset('post-images') }}/{{ $post->image }}" style="height: 150px; width: auto;" alt="" class="card-img-top mb-2">
                                    </div>

                                    <div class="card-body p-0">
                                        <div class="post-meta d-flex justify-content-between">
                                            <div class="date">{{ Carbon\Carbon::parse($post->created_at)->format('d F Y, g:i a') }}</div>
                                            <div class="category"><a href="#">{{ $post->category->title }}</a></div>
                                        </div>
                                        <a href="{{ route('post.show', ['post' => $post->id]) }}">
                                            <h3 class="h4">{{ $post->title }}</h3></a>
                                        <p class="text-muted">
                                            {{ Str::limit($post->body, 100) }}
                                        </p>
                                    </div>
                                    <footer class="post-footer d-flex align-items-center">
                                        @if ($post->user->profile_image)
                                            <img src="{{ asset('profile-images') }}/{{ $post->user->profile_image }}" class="post img-fluid rounded-circle" alt="">
                                        @else 
                                            <img src="{{ asset('images/avatar/avatar.jpeg') }}" class="post img-fluid rounded-circle" alt="">
                                        @endif
                                        <div class="title">
                                            <span class="name text-capitalize">{{ $post->user->username }}</span>
                                        </div>
                                        <div class="comments">
                                            <i class="far fa-comment-dots"></i>
                                            <span class="comments-num">{{ $post->comments->count() }}</span>
                                        </div>
                                    </footer>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    
                    {{ $posts->links () }}
                </div>

                @include('includes.widget')

            </div>
        </div>
    </section>

@endsection