@extends('layouts.app')

@section('title', 'Welcome')

@push('css')

@endpush

@section('content')

<div class="container">
    @guest
    <div class="jumbotron jumbotron-fluid bg-info">
        <h1 class="display-1 text-center">Welcome</h1>
        <hr>
        <a href="{{ route('login') }}" class="btn btn-block btn-primary">Login</a>
        <a href="{{ route('register') }}" class="btn btn-block btn-primary">Register</a>
    </div>
    @else
    <div class="card py-5 text-center">
        <h2>You are logged in!</h2>
        <p>How you feeling <em>Sir?</em>
            <a href="{{ route('posts.index') }}"><u>Read some posts here</u></a></p>
    </div>
    @endguest
</div>

@endsection

@push('js')

@endpush
