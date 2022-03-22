@extends('layouts.app')

@section('content')
    <section class="header">
        <div class="masthead">
            <div class="col-md-8 p-0">
                <h1 class="masthead-heading">Bootstrap 4 Blog - A free template by Bootstrap Temple</h1>
            </div>
            <a href="" class="masthead-link text-uppercase">Discover More</a>
        </div>
    </section>


    <section class="introduction">
        <div class="container">
            <div class="intro m-0">
                <h3 class="introducton-header">Some great intro here</h3>
                <p class="introduction-text col-lg-8 p-0">
                    Place a nice introduction here to catch reader's attention. 
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Ut enim ad minim veniam, quis nostrud nisi ut aliquip ex ea commodo consequat. 
                    Duis aute irure dolor in reprehenderi.
                </p>
            </div>
        </div>
    </section>

    <section class="post-section">
        @php
            $random_sn = 0;
        @endphp
        @foreach ($random_posts as $random_post)
            @php

                $random_sn++; 

                if ($random_sn == 2) {  
                    $order = 'order-lg-1';
                    $order2 = 'order-lg-2';
                } else {
                    $order = 'order-lg-2';
                    $order2 = 'order-lg-1';
                }

            @endphp

            <!--post-->
            <div class="posts">
                <div class="container">
                    <div class="mpost row">
                        <div class="post-img col-lg-5 align-self-center p-lg-0 {{ $order }}">
                            <img src="{{ asset('/post-images') }}/{{ $random_post->image }}" style="height: 250px; width: auto; max-width: 100%;" alt="">
                        </div>
                        <div class="col-lg-7 p-lg-0 {{ $order2 }}">
                            <div class="post-ad">
                                <header class="post-header">
                                    <div class="category">
                                        <a href="">{{ $random_post->category->title }}</a>
                                        <a href=""><h2 class="post-title">{{ $random_post->title }}</h2></a>
                                    </div>
                                </header>
                                <p>
                                    {{ Str::limit($random_post->body, 100) }}
                                </p>
                                <footer class="post-footer row align-items-center">
                                    @if ($random_post->user->profile_image)
                                            <img src="{{ asset('profile-images') }}/{{ $random_post->user->profile_image }}" class="post img-fluid rounded-circle" alt="">
                                        @else 
                                            <img src="{{ asset('images/avatar/avatar.jpeg') }}" class="post img-fluid rounded-circle" alt="">
                                        @endif
                                    <div class="title">
                                        <span class="name">{{ $random_post->user->username }}</span>
                                    </div>
                                    <div class="date">
                                        <i class="far fa-clock"></i>
                                        <span class="date-text">{{ Carbon\Carbon::parse($random_post->created_at)->format('d F Y, g:i a') }}</span>
                                    </div>
                                    <div class="comments">
                                        <i class="far fa-comment-dots"></i>
                                        <span class="comments-num">{{ $random_post->comments->count() }}</span>
                                    </div>
                                </footer>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
        
    </section>

    <section class="divider-section">
        <div class="divider">
            <div class="container">
                <div class="col-lg-7 p-0">
                    <h3 class="divider-text">
                        Lorem ipsum dolor sit amet, 
                        consectetur adipisicing elit, 
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                    </h3>
                </div>
                <a href="" class="divider-link text-uppercase">View More</a>
            </div>
        </div>
    </section>

    <section class="latest-section">
        <div class="latest">
            <div class="container">
                <h3 class="latest-header">Latest from the blog</h3>
                <p class="latest-subheader">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

                <div class="row">

                    @foreach ($latest_posts as $latest_post)
                        <div class="card col-lg-4 p-0">
                            <img src="{{ asset('/post-images') }}/{{ $latest_post->image }}" alt="" style="height: 150px; width: auto;" class="card-img-top">
                            <div class="card-body p-0">
                                <div class="post-meta d-flex justify-content-between">
                                    <div class="date">{{ Carbon\Carbon::parse($latest_post->created_at)->format('d F Y, g:i a') }}</div>
                                    <div class="category"><a href="#">{{ $latest_post->category->title }}</a></div>
                                </div>
                                <a href="/post/{{ $latest_post->id }}">
                                    <h3 class="h4">{{ $latest_post->title }}</h3></a>
                                <p class="text-muted">
                                    {{ Str::limit($latest_post->body, 100) }}
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    <section class="subscribe">
        <div class="container">
            <h2 class="subscribe-header">Subscribe to Newsletter</h2>
            <div class="col-lg-7 p-0">
                <p class="subscribe-text">
                    Lorem ipsum dolor sit amet, 
                    consectetur adipisicing elit, 
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @elseif (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                <form action="{{ route('newsletter') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="email" class="subscribe-form @error('email') is-invalid @enderror" name="email" placeholder="Type your email address">
                        <button type="submit" class="subscribe-btn">Subscribe</button>
                    </div>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </form>
            </div>
        </div>
    </section>


    <section class="gallery">
        <div class="row">
            <div class="mix col-lg-3 col-md-3 col-sm-6">
                <div class="item">
                    <a href="./assets/img/gallery-1.jpg" data-fancybox="gallery" class="image">
                        <img src="{{ asset('/images/img/gallery-1.jpg') }}" alt="...">
                        <div class="overlay d-flex align-items-center justify-content-center">
                            <i class="fas fa-search"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="mix col-lg-3 col-md-3 col-sm-6">
                <div class="item">
                    <a href="./assets/img/gallery-2.jpg" data-fancybox="gallery" class="image">
                        <img src="{{ asset('/images/img/gallery-2.jpg') }}" alt="...">
                        <div class="overlay d-flex align-items-center justify-content-center">
                            <i class="fas fa-search"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="mix col-lg-3 col-md-3 col-sm-6">
                <div class="item">
                    <a href="./assets/img/gallery-3.jpg" data-fancybox="gallery" class="image">
                        <img src="{{ asset('/images/img/gallery-3.jpg') }}" alt="...">
                        <div class="overlay d-flex align-items-center justify-content-center">
                            <i class="fas fa-search"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="mix col-lg-3 col-md-3 col-sm-6">
                <div class="item">
                    <a href="./assets/img/gallery-4.jpg" data-fancybox="gallery" class="image">
                        <img src="{{ asset('/images/img/gallery-4.jpg') }}" alt="...">
                        <div class="overlay d-flex align-items-center justify-content-center">
                            <i class="fas fa-search"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>



@endsection
