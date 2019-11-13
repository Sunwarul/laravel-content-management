@extends('layouts.app')

@section('title', '{{ $post->title }}')

@push('css')

@endpush

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h5><strong>{{ $post->title }}</strong></h5>
                </div>
                <div class="col-md-2 ">
                    <a href="{{ route('posts.index') }}" class="btn btn-sm btn-primary float-right">
                        Go Back
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <em>{{ $post->description }}</em>
            <hr>
            <p class="lead">
                {{ $post->content }}
            </p>
            <p>
                @if(!empty($post->image))
                <img src="/storage/{{ $post->image }}" alt="Image" class="img-thumbnail">
                @endif
            </p>
            <p>
                <span class="badge badge-primary mr-3">{{ $post->category->name }}</span>
                <span class="text text-monospace">Created at: {{ $post->created_at }}</span>

            </p>
            <hr>
            <p>

                <a class="btn btn-sm btn-danger float-right mr-2" href=""
                    onclick="event.preventDefault(); document.getElementById('delForm').submit();">
                    Trash
                </a>
                <form action="{{ route('posts.destroy', $post->id) }}" id="delForm" method="POST">
                    @csrf
                    @method('DELETE')
                </form>


                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning float-right mr-2">
                    Edit Post
                </a>
            </p>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
