<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheets')
    <livewire:scripts />
</head>
<body>
@include('elements.navigation')
<div class="container-fluid">
    <div class="row">
        <main role="main" class="ml-sm-auto col-12 pt-3 px-4">
            <div id="title-bar" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">@isset($title) {{ $title }} @endisset @isset($sub_title)<small class="header-small"> - {{ $sub_title }}</small> @endisset</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    @if(isset($header_buttons))
                        @foreach($header_buttons as $button)
                            <div class="btn-group mr-2">
                                <button id="{{ $button['id'] }}" onclick="{{ $button['onclick'] }}()" wire:click="{{ $button['wire_click'] }}" type="{{ $button['type'] }}" class="btn btn-{{ $button['colour'] }}">{{ $button['title'] }}</button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row align-items-center">
                @yield('page')
            </div>
        </main>
    </div>
</div>
{{--@error('*')
    <p class="alert alert-danger alert-validation"><strong>{{ $message }}</strong></p>
@enderror--}}
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<livewire:scripts />
@yield('scripts')
</body>
</html>
