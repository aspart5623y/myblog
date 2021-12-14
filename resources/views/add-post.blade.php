@extends('layouts.app')

@section('content')

    <div class="header-2">
        <div class="container">
            <h4 class="text-muted text-uppercase">Create new post</h4>
            <p>Create a new post on this blog. This feature is only available to members only.</p>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h4 class="font-weight-bold mb-5">Write new post</h4>
                    
                    <form action="{{ route('save.post') }}" method="post" enctype="multipart/form-data">
                        @csrf



                        <input type="hidden" name="user_type" value="{{ Auth::user()->utype }}">

                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                        <div class="form-group mb-4">
                            <select name="category" class="form-control">
                                <option value="">Select a category for this post category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <input type="text" class="form-control mb-0" name="title" value="{{ old('title') }}" placeholder="Post title">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <textarea name="body" class="form-control">{{ old('body') }}</textarea>
                            @error('body')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="">Add an image to your new post</label>
                            <input type="file" class="form-control mb-0" onchange="previewFile(this)" name="image">
                            <img alt="" id="previewImg" style="max-width: 300px; margin-top: 20px;">
                        </div>

                        <button type="submit" class="btn btn-secondary px-4">Add category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



<script>
    function previewFile(input) {
        var file = $("input[type=file]").get(0).files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function() {
                $('#previewImg').attr('src', reader.result)
            }
            reader.readAsDataURL(file);
        }
    }
</script>