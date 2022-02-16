@extends('layouts.app')

@section('content')

    <div class="header-2">
        <div class="container">
            <h4 class="text-muted text-uppercase">Manage Profile</h4>
        </div>
    </div>
    <div class="section">
        <div class="container">

            @if (Session::has('updated_profile'))
                <div class="alert alert-success">{{ Session::get('updated_profile') }}</div>
            @endif

            @if (Session::has('update_error'))
                <div class="alert alert-danger">{{ Session::get('update_error') }}</div>
            @endif

            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            
            <div class="img-group">
                @if (Auth::user()->profile_image)
                    <img src="{{ asset('profile-images') }}/{{ Auth::user()->profile_image }}" class="rounded-circle" width="200" height="200" alt="">
                @else
                    <img src="{{ asset('images/avatar/avatar.jpeg') }}" class="rounded-circle" width="200" height="200" alt="">
                @endif
                
                <form action="{{ route('profile.image', ['profile' => Auth::user()->id]) }}" id="img-form" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="edit-image-button btn-secondary btn">
                        <i class="fas fa-camera"></i>
                        <input type="file" class="form-control" name="image" onchange="picturePreview(this)">
                    </div>
                </form>
                    
            </div>

            
            <a href="{{ route('profile.edit', ['profile' => Auth::user()->id]) }}" class="btn btn-secondary my-3">Edit profile</a>
            <hr>

            <div class="row mb-5">

                <div class="col-md-6">
                    <div class="row my-3">
                        <div class="col-4">Firstname:</div>
                        <div class="col-8">{{ Auth::user()->firstname }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row my-3">
                        <div class="col-4">Lastname:</div>
                        <div class="col-8">{{ Auth::user()->lastname }}</div>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="row my-3">
                        <div class="col-4">Email:</div>
                        <div class="col-8">{{  Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row my-3">
                        <div class="col-4">Username:</div>
                        <div class="col-8">{{ Auth::user()->username }}</div>
                    </div>
                </div>

            </div>

            <small class="text-muted">Joined <i>{{ Carbon\Carbon::parse(Auth::user()->created_at)->format('l d F, Y | h:i a') }}</i></small> 

        </div>
    </div>





    <div class="modal fade" id="previewImg">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img id="imgPreview" class="img-fluid" width="250" alt="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" onclick="event.preventDefault();
                        document.getElementById('img-form').submit();" id="saveBtn">Save</button>
                </div>
            </div>
        </div>
    </div>


        

    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script>
    
        function picturePreview(input) {
            
            var file =  $("input[type=file]").get(0).files[0];

            $('#previewImg').on('show.bs.modal', function() {
                var reader = new FileReader(); 
                reader.onload = function() {
                    $('#imgPreview').attr('src', reader.result);
                }
                reader.readAsDataURL(file);
            });

            $('#previewImg').modal('show');
        }
    </script>
@endsection


