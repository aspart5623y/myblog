@extends('layouts.app')

@section('content')

    <div class="header-2">
        <div class="container">
            <h4 class="text-muted text-uppercase">Add categories</h4>
            <p>Add categories on this blog. This feature is only available to admins only.</p>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h4 class="font-weight-bold mb-5">Create new category</h4>
                    
                    <form action="{{ route('category.store') }}" method="post">
                        @csrf

                        <div class="form-group mb-4">
                            <input type="text" class="form-control mb-0" name="category_name" placeholder="Category name">
                            @error('category_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" class="form-control mb-0" name="category_desc" placeholder="Describe this category">
                            @error('category_desc')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-secondary px-4">Add category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
