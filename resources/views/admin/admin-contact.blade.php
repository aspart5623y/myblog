@extends('layouts.app')

@section('content')

    <div class="header-2">
        <div class="container">
            <h4 class="text-muted text-uppercase">Contact messages</h4>
            <p>Blog viewers might have one complain or the other. Here are their messages. This feature is only available to admins only.</p>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sn = 1;
                        @endphp
                        @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $sn++ }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->message }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
