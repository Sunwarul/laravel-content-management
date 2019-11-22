@extends('layouts.app')

@section('title', 'Create Post')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('content')

<div class="container">

    <div class="card">
        <div class="card-header">
            <strong>{{ (isset($post)) ? 'Update Post' : 'Create Post' }}</strong>
        </div>
        <div class="card-body">
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST"
                enctype="multipart/form-data" id="postForm">
                @csrf
                @if(isset($post))
                @method('PUT')
                @endif
                @include('partials.form_error')
                <div class="form-group">
                    <input type="text" name="title" placeholder="Post Title" class="form-control" required
                        value="{{ isset($post) ? $post->title : request()->old('title') }}">
                </div>
                <div class="form-group">
                    <textarea name="description" id="description" cols="33" rows="3" class="form-control"
                        placeholder="Post description" required>{{ isset($post) ? $post->description : request()->old('description') }}</textarea>

                </div>
                {{-- <div class="form-group">
                    <div id="editor" class="form-control"></div>
                    <input type="hidden" name="content">
                </div>
                 --}}
                 <div class="form-group">
                    <textarea name="content" id="content" cols="33" rows="9" class="form-control"
                    placeholder="Post description" required>{{ isset($post) ? $post->content : request()->old('content') }}</textarea>
                 </div>
                @if(isset($post) && !empty($post->image))
                <img src="/storage/{{ $post->image }}" class="img-thumbnail">
                @endif
                <div class="form-group">
                    <input type="file" class="form-control" name="image" placeholder="Upload Image">
                </div>

                <div class="input-group mb-3">
                    <select class="custom-select" id="inputGroupSelect01" name="category">
                        @if(isset($post))
                        <option value="{{ $post->category->id }}">
                            {{ $post->category->name }}
                        </option>
                        @else
                        <option value="" selected>Choose a category ...</option>
                        @endif
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                @if($tags->count() > 0)
                <div class="form-group">
                    <select name="tags[]" id="tags" class="form-control js-example-basic-multiple" multiple>
                        @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" @if(isset($post)) @if($post->hasTag($tag->id))
                            selected
                            @endif
                            @endif
                            >{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        {{ isset($post) ? 'Update Post' : 'Save Post' }}
                    </button>
                    @if(isset($post))
                    <a href="{{ route('posts.index') }}" class="btn btn-primary">
                        Cancel
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

</div>

@endsection

@push('js')
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>

// var quill = new Quill('#editor', {
//   theme: 'snow'
// });

// var form = document.getElementById('postForm');
// form.onsubmit = function() {
//   // Populate hidden form on submit
//   var content = document.querySelector('input[name=content]');
//   content.value = JSON.stringify(quill.getContents());
//   return true;
// };



</script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@endpush
