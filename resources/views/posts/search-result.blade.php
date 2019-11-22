@extends('layouts.app')

@section('title', 'Search Result')

@push('css')

@endpush

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">Search Result {{ $posts->count() }}</div>
        <div class="card-body">
            <div class="list-group">
                @foreach ($posts as $post)
                <h5><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h5>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
