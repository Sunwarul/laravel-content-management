<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bangers&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
</head>

<body>
    <div id="app">
        @include('layouts.navbar')
        <main class="py-2">
            <div class="container-fluid p-1 mt-1">
                @include('partials.messages')
                <div class="row">
                    @auth
                    <div class="col-md-2">
                        <ul class="list-group">
                            @if(auth()->user()->isAdmin())
                            <div class="list-group-item">
                               <a href="{{ route('users.index') }}">Users</a>
                            </div>
                            @endif
                            <li class="list-group-item">
                                <a href="{{ route('posts.index') }}">All Posts</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('tags.index') }}">Tags</a>
                            </li>

                            <li class="list-group-item">
                                <a href="{{ route('categories.index') }}">Categories</a>
                            </li>

                        </ul>
                        <ul class="list-group mt-3">
                            <li class="list-group-item">
                                <a href="{{ route('trashed-posts.index') }}">
                                    Trashed Posts
                                    {{--  <div class="badge badge-warning">@yield('trashed_count')</div>  --}}
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endauth
                    <div class="@auth col-md-10 @else col-md-12 @endauth">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
    @stack('js')
</body>

</html>
