@extends('layouts.app')

@section('title', 'Create tag')

@push('css')

@endpush

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>{{ isset($tag) ? 'Update tags' : 'Create tag' }}</strong>
        </div>
        <div class="card-body">
            <form
                action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}"
                method="POST">
                @csrf
                @if(isset($tag))
                @method('PUT')
                @endif
                @include('partials.form_error')
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Type tag" name="name" value="{{ isset($tag) ? $tag->name : '' }}">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info"
                        value="{{ isset($tag) ? 'Update tag' : 'Create tag' }}">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
