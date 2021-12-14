@extends('layouts.app')

@section('content')

    <div class="header-2">
        <div class="container">
            <h4 class="text-muted text-uppercase">EDIT categories</h4>
            <p>Edit categories on this blog. This feature is only available to admins only.</p>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h4 class="font-weight-bold mb-5">Edit this category</h4>
                    
                    <form action="{{ route('category.update') }}" method="post">
                        @csrf

                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <div class="form-group mb-4">
                            <input type="text" class="form-control mb-0" value="{{ $category->title }}" name="category_name" placeholder="Category name">
                            @error('category_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" class="form-control mb-0" value="{{ $category->description }}" name="category_desc" placeholder="Describe this category">
                            @error('category_desc')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-secondary px-4">Update category</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
