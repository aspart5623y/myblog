@extends('layouts.app')

@section('content')

    <div class="header-2">
        <div class="container">
            <h4 class="text-muted text-uppercase">Manage categories</h4>
            <p>Manage categories on this blog. This feature is only available to admins only.</p>
        </div>
    </div>
    <div class="section">
        <div class="container">
            @if (Session::has('category_added'))
                <div class="alert alert-success">
                    {{ Session::get('category_added') }}
                </div>
            @endif
            <div class="text-right py-4">
                <a href="/admin/add-categories" class="btn btn-secondary px-4">Add new category</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sn = 1;
                        @endphp
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $sn++ }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <a href="/admin/edit-category/{{ $category->id }}" class="btn"><i class="fas fa-edit text-muted" style="font-size: 19px;"></i></a>
                                    <a href="/admin/delete-category/{{ $category->id }}" class="btn"><i class="fas fa-times-circle text-danger" style="font-size: 19px;"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
