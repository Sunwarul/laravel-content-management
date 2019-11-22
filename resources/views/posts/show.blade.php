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
                {!! $post->content !!}
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
        <div>
            <div class="container px-5">
                <div id="disqus_thread"></div>
            </div>
            <script>
                /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

        var disqus_config = function () {
            this.page.url = "{{ config('app.url') }}/posts/{{ $post->id }}";  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = {{ $post->id }}; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };

        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://laravel-cms-6.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered
                    by Disqus.</a></noscript>

        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
