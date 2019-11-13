@extends('layouts.app')

@section('title', 'tags')

@push('css')

@endpush

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <strong>Tags</strong>
            <div>
                <a href="{{ route('tags.create') }}" class="btn btn-success">
                    Create tag
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($tags->count() > 0)
            <div class="list-group">
                @foreach ($tags as $tag)
                <div class="list-group-item">
                    <a href="">{{ $tag->name }}</a>
                    <span class="badge badge-success">{{ $tag->posts->count() }}</span>
                    <a href="#" class="btn btn-sm btn-danger float-right" onclick="event.preventDefault();if(confirm(' Are you sure')) {
                            document.getElementById('deleteForm').submit();}">
                        Delete
                    </a>

                    <a href="{{ route('tags.edit', $tag->id) }}"
                        class="btn btn-sm btn-warning float-right mr-1">Edit</a>

                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" id="deleteForm">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
                @endforeach
            </div>
            @else
            <h6 class="text-center">No tags yet!</h6>
            @endif
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
