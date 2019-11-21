<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-info text-white">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="">
            <div class="container-fluid p-0 mt-1">
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
