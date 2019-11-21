@extends('layouts.app')

@section('title', '{{ $user->name }}')

@push('css')

@endpush

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5><strong>User Profile</strong></h5>
            <div>
                <a href="{{ route('users.profile-edit') }}" class="btn btn-sm btn-outline-info">Edit Profile</a>
            </div>
        </div>
        <div class="card-body">
            <h6>Name: {{ $user->name }}</h6><br>
            <h6>About Me:</h6>
            <hr>
            <p class="lead">
                {{ $user->about }}
            </p>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
