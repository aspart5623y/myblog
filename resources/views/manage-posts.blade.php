@extends('layouts.app')

@section('content')

    <div class="header-2">
        <div class="container">
            <h4 class="text-muted text-uppercase">Manage Posts</h4>
            <p>Manage posts on this blog. This feature is only available to members only.</p>
        </div>
    </div>
    <div class="section">
        <div class="container">
            @if (Session::has('post_validation'))
                <div class="alert alert-success">
                    {{ Session::get('post_validation') }}
                </div>
            @endif
            <div class="text-right py-4">
                <a href="/add-post" class="btn btn-secondary px-4">Create Post</a>
            </div>
            <style>
                nav svg{
                    height: 20px;
                }
                nav .flex {
                    display: none;
                }
            </style>

            <div class="row blog-post mb-5">
                @foreach ($posts as $post)
                    
                    <div class="card col-xl-4 col-md-6 my-4 p-0">
                        <a href="" class="card-post">

                            <div class="text-center">
                                <img src="{{ asset('post-images') }}/{{ $post->image }}" style="height: 150px; width: auto;" alt="" class="card-img-top mb-2">
                            </div>
    
                            <div class="card-body p-0">
                                <a href="javascript:void(0)" id="{{ $post->id }}" class="close mx-2 delete_modal"><i class="far fa-trash-alt"></i></a>
                                <a href="/edit-post/{{ $post->id }}" class="close mx-2"><i class="far fa-edit"></i></a>
                                <div class="post-meta d-flex justify-content-between">
                                    <div class="date">{{ $post->created_at }}</div>
                                    <div class="category"><a href="#">{{ $post->category->title }}</a></div>
                                </div>
                                <a href="post.html">
                                    <h3 class="h4">{{ $post->title }}</h3></a>
                                <p class="text-muted">
                                    {{ Str::limit($post->body, 100) }}
                                </p>
                            </div>
                            <footer class="post-footer d-flex mb-2 align-items-center">
                                @if ($post->user->profile_image)
                                    <img src="{{ asset('profile-images') }}/{{ $post->user->profile_image }}" class="post img-fluid rounded-circle" alt="">
                                @else 
                                    <img src="{{ asset('images/avatar/avatar.jpeg') }}" class="post img-fluid rounded-circle" alt="">
                                @endif
                                <div class="title">
                                    <span class="name text-capitalize">{{ $post->user->username }}</span>
                                </div>
                                <div class="date">
                                    <i class="far fa-clock"></i>
                                    <span class="date-text">{{ Carbon\Carbon::parse($post->created_at)->format('d F Y, g:i a') }}</span>
                                </div>
                            </footer>
                            <div class="card-footer p-0">
                                @if (Auth::user()->utype == 'user')
                                    @if ($post->status == 'pending')
                                        <div class="alert alert-info font-weight-bold text-capitalize text-center mb-0">
                                            {{ $post->status }}
                                        </div>
                                    @elseif ($post->status == 'approved')
                                        <div class="alert alert-success font-weight-bold text-capitalize text-center mb-0">
                                            {{ $post->status }}
                                        </div>
                                    @endif
                                @elseif (Auth::user()->utype == 'admin')
                                    @if ($post->user_id == Auth::user()->id)
                                        <div class="alert alert-success font-weight-bold text-capitalize text-center mb-0">
                                            {{ $post->status }}
                                        </div>
                                    @else
                                        @if ($post->status == 'pending')
                                            <div class="my-2 text-center">
                                                <a href="/approve-post/{{ $post->id }}" class="btn btn-success"><i class="fas fa-check"></i> &nbsp; Approve post</a>
                                            </div>
                                        @elseif ($post->status == 'approved')
                                            <div class="alert alert-success font-weight-bold text-capitalize text-center mb-0">
                                                {{ $post->status }}
                                            </div>
                                        @endif
                                    @endif 
                                @endif
                            </div>
                        </a>
                    </div>

                @endforeach
            </div>
            {{ $posts->links () }}
        </div>
    </div>
@endsection





<div class="modal fade" id="deletePost">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p class="text-muted">Are you sure you want to delete this post?</p>
                <a href="" class="btn btn-secondary px-4 modal_link">Confirm</a>
                <button type="button" data-dismiss="modal" class="btn btn-light border px-4">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $(document).ready(function(){  
        $('.delete_modal').on('click', function(){
            $id = $(this).attr('id');

            $('#deletePost').on('show.bs.modal', function(){
                $('.modal_link').attr('href', '/delete-post/' + $id);
            });
            $('#deletePost').modal('show');
        });
    });
</script>
