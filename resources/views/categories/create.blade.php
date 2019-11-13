@extends('layouts.app')

@section('title', 'Create Category')

@push('css')

@endpush

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>{{ isset($category) ? 'Update Categories' : 'Create Category' }}</strong>
        </div>
        <div class="card-body">
            <form
                action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}"
                method="POST">
                @csrf
                @if(isset($category))
                @method('PUT')
                @endif
                @include('partials.form_error')
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Type Category" name="name" value="{{ isset($category) ? $category->name : '' }}">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info"
                        value="{{ isset($category) ? 'Update Category' : 'Create Category' }}">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
