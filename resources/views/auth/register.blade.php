@extends('layouts.auth')

@section('page_name', 'Create an Account')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-body py-5">
                    <h4 class="font-weight-bold d-block d-lg-none text-center mb-3">Create an account</h4>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Enter your username" name="username" value="{{ old('username') }}" required autofocus>

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group ">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm your password" required autocomplete="new-password">
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <div class="text-center mb-4">
                                    <button type="submit" class="btn btn-secondary">
                                        {{ __('Register') }}
                                    </button>
                                </div>

                                @if (Route::has('login'))
                                    <small class="text-muted">Already have an account?</small>
                                    <a class="text-primary" href="{{ route('login') }}">
                                        Access Dashboard 
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
