@extends('layouts.app')

@section('content')

    <section class="blog">
        <div class="container">
            <h2 class="font-weight-bold">
                Contact Us
            </h2>

            <ul class="breadcrumb p-0" style="background-color: transparent">
                <li class="breadcrumb-item"><a href="/" class="text-muted">Home</a></li>
                <li class="breadcrumb-item">Contact</li>
            </ul>
            <hr>

            <h4 class="font-weight-bold">Tell us your problem</h4>

            @if (Session::has('contact'))
                <div class="alert alert-success">{{ Session::get('contact') }}</div>
            @endif
            <section class="reply-form">
                <div class="col-lg-8 p-0">
                    <form action="{{ route('send.message') }}" method="POST">
                        @csrf
                        
                        <div class="row p-3">
                            <div class="col-md-6">
                                <input type="text" class="reply-input w-100 mb-3" name="name" value="{{ old('name') }}" placeholder="Enter your Name">
                            </div>
                            
                            <div class="col-md-6">
                                <input type="text" class="reply-input w-100 mb-3" name="email" value="{{ old('email') }}" placeholder="Enter your Email">
                            </div>

                            <div class="col-md-6">
                                @error('name')
                                    <p class="text-danger mb-4">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                @error('email')
                                    <p class="text-danger mb-4">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <textarea class="reply-input mb-3 w-100" name="message" value="{{ old('message') }}" placeholder="Type your comment" rows="5"></textarea>
                            </div>
                            @error('message')
                                <div class="col-md-12">
                                    <p class="text-danger mb-4">{{ $message }}</p>
                                </div>
                            @enderror

                            <button class="btn btn-secondary" type="submit">Submit Comment</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>

@endsection
