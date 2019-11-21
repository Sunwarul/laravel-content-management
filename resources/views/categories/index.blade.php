@extends('layouts.app')

@section('title', 'Categories')

@push('css')

@endpush

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <strong>Categories</strong>
            <div>
                <a href="{{ route('categories.create') }}" class="btn btn-success">
                    Create Category
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($categories->count() > 0)
            <div class="list-group">
                @foreach ($categories as $category)
                <div class="list-group-item">
                    <a href="">{{ $category->name }}</a>
                    {{-- <span class="badge badge-success">{{ $category->posts->count() }}</span> --}}

                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-sm btn-danger float-right" value="Delete">
                    </form>


                    <a href="{{ route('categories.edit', $category->id) }}"
                        class="btn btn-sm btn-warning float-right mr-1">Edit</a>

                </div>
                @endforeach
            </div>
            @else
            <h6 class="text-center">No Categories yet!</h6>
            @endif
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
