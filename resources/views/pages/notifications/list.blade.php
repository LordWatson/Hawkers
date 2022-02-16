@extends('layouts.app')
@section('stylesheets')
    <link href="{{ asset('css/notifications.css') }}" rel="stylesheet">
@endsection
@section('page')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <livewire:notifications-list/>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/notifications.js') }}" defer></script>
@endsection
