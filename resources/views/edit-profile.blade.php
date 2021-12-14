@extends('layouts.app')

@section('content')

    <div class="header-2">
        <div class="container">
            <h4 class="text-muted text-uppercase">Manage Profile</h4>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="col-lg-6 col-md-10">
                <form action="{{ route('update.profile') }}" method="POST">
                    @csrf

                    <div class="form-group mb-4">
                        <input type="text" class="form-control mb-0" name="firstname" value="{{ Auth::user()->firstname }}" placeholder="Firstname">
                        @error('firstname')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <input type="text" class="form-control mb-0" name="lastname" value="{{ Auth::user()->lastname }}" placeholder="Lastname">
                        @error('lastname')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <input type="text" class="form-control mb-0" name="email" value="{{ Auth::user()->email }}" placeholder="Email">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <input type="text" class="form-control mb-0" name="username" value="{{ Auth::user()->username }}" placeholder="Username">
                        @error('username')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                

                    <button type="submit" class="btn btn-secondary px-4">Update Profile</button>

                </form>
            </div>

        </div>
    </div>
@endsection