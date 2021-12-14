@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">

            <h1 class="font-weight-bold my-3">Welcome {{ Auth::user()->username }},</h1>

            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <div class="row">

                {{-- number of users --}}
                <div class="col-sm-6">
                    <div class="card my-3">
                        <div class="card-body">
                            <h1>{{ $users->count() }}</h1>
                            <p class="text-muted">Users</p>
                        </div>
                    </div>
                </div>

                {{-- number of posts --}}
                <div class="col-sm-6">
                    <div class="card my-3">
                        <div class="card-body">
                            <h1>{{ $posts->count() }}</h1>
                            <p class="text-muted">All posts</p>
                        </div>
                    </div>
                </div>

                {{-- number of categories --}}
                <div class="col-sm-6">
                    <div class="card my-3">
                        <div class="card-body">
                            <h1>{{ $categories->count() }}</h1>
                            <p class="text-muted">Categories</p>
                        </div>
                    </div>
                </div>

                {{-- number of pending post --}}
                <div class="col-sm-6">
                    <div class="card my-3">
                        <div class="card-body">
                            <h1>{{ $pending_posts->count() }}</h1>
                            <p class="text-muted">Pending Posts</p>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
@endsection
