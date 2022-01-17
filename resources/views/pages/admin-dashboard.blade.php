@extends('layouts.app')
@section('stylesheets')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/post.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
@endsection
@section('page')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Users</div>
                    <div class="card-body fixed-scroll">
                        @foreach($users as $user)
                            <div class="form-group row">
                                <div class="col-md-8"><a href="/profile/{{ $user->id }}">{{ $user->name }}</a></div>
                                <div class="col-md-4">{{ $user->roles[0]->name }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Posts</div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Posts</div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/post.js') }}" defer></script>
@endsection
