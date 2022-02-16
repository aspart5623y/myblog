@extends('layouts.app')

@section('content')
<div class="section">
    <div class="container">
        
        <style>
            nav svg{
                height: 20px;
            }
            nav .flex {
                display: none;
            }
        </style>

        <h3 class="font-weight-bold my-3">Search Result</h3>

        <div class="row blog-post">
            @foreach ($searchResult as $result)
                <div class="card col-lg-4 p-0">
                    <a class="card-post" href="{{ route('post.show', ['post' => $result->id]) }}">
                        <div class="text-center">
                            <img src="{{ asset('post-images') }}/{{ $result->image }}" style="height: 150px; width: auto;" alt="" class="card-img-top border mb-2">
                        </div>

                        <div class="card-body p-0">
                            <div class="post-meta d-flex justify-content-between">
                                <div class="date">{{ Carbon\Carbon::parse($result->created_at)->format('d F Y, g:i a') }}</div>
                                <div class="category"><a href="#">{{ $result->category->title }}</a></div>
                            </div>
                            <a href="{{ route('post.show', ['post' => $result->id]) }}">
                                <h3 class="h4">{{ $result->title }}</h3></a>
                            <p class="text-muted">
                                {{ Str::limit($result->body, 100) }}
                            </p>
                        </div>
                        <footer class="post-footer d-flex align-items-center">
                            <img src="{{ asset('profile-images') }}/{{ $result->user->profile_image }}" class="post img-fluid rounded-circle" alt="">
                            <div class="title">
                                <span class="name text-capitalize">{{ $result->user->username }}</span>
                            </div>
                            <div class="comments">
                                <i class="far fa-comment-dots"></i>
                                <span class="comments-num">12</span>
                            </div>
                        </footer>
                    </a>
                </div>
            @endforeach
        </div>

        {{ $searchResult->links () }}
            
    </div>
</div>
@endsection
