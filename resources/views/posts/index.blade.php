@extends('layouts.app')

@section('title', 'Posts')

@push('css')

@endpush

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        @if($trashed)
        <strong>Trashed posts</strong>
        <div>
            <a href="#" class="btn btn-outline-danger">Restore All</a>
        </div>
        @else
        <strong>All posts</strong>
        <div>
            <a class="btn btn-success" href="{{ route('posts.create') }}">
                Create Post
            </a>
        </div>
        @endif
    </div>
    <div class="card-body">
        {{--  @section('trashed_count', $posts->count())  --}}
        @if($posts->count() > 0)
        <ul class="list-group-flush">
            @foreach ($posts as $post)
            <li class="list-group-item">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            @if(!$post->trashed())
                            <a class="btn btn-sm btn-success" href="{{ route('posts.show', $post->id) }}">
                                Read
                            </a>
                            <a class="btn btn-sm btn-warning" href="{{ route('posts.edit', $post->id) }}">
                                Edit
                            </a>
                            @else

                            <form action="{{ route('posts.restore', $post->id) }}" id="restoreForm" method="POST"
                                class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-primary text-white">
                                    Restore
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('posts.destroy', $post->id) }}" id="delForm" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                </button>
                            </form>
                        </div>
                        <div>
                            <div>
                                @if(isset($post->category))
                                <div class="badge badge-secondary">Category: {{ $post->category->name }}</div>
                                @endif
                            </div>
                            <div>
                                @if($post->tags->count() > 0)
                                <div class="badge bdge-primary">
                                    Tags: |
                                    @foreach($post->tags as $post_tag)
                                    {{ $post_tag->name }} |
                                    @endforeach
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="p-4">
                            <h4>
                                {{ $post->title }}
                            </h4>
                            <div class="row">
                                <div class="col-md-5">
                                    @if(!empty($post->image))
                                    <img alt="Image" src="{{ asset('/storage/'.$post->image) }}" width="300">
                                    @endif
                                </div>
                                <div class="col-md-7">
                                    {{ substr($post->content, 0, 400) }} ...
                                    <br>
                                    <br>
                                    @if(!$post->trashed())
                                    <a class="btn btn-sm btn-primary" href="{{ route('posts.show', $post->id) }}">
                                        Read More
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        {{ $posts->links() }}

        @else
        <h3 class="text-center">
            No Post yet!
        </h3>
        @endif
    </div>
</div>

@endsection
@push('js')

@endpush
