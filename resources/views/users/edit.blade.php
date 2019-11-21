@extends('layouts.app')

@section('title', 'Edit Profile')

@push('css')

@endpush

@section('content')

<div class="card">
    <div class="card-header">
        Edit Profile
    </div>
    <div class="card-body">
        <form action="{{ route('users.profile-update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <textarea name="about" id="about" cols="30" rows="10" class="form-control">{{ $user->about }}</textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update Profile">
            </div>
        </form>
    </div>
</div>

@endsection

@push('js')

@endpush
