@extends('layouts.app')

@section('title', 'Create Category')

@push('css')

@endpush

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>Create Category</strong>
        </div>
        <div class="card-body">
            <form action="">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Type Category">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
