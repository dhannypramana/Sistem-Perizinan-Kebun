@extends('home.layouts.main')

@section('container')
    <div class="container" style="margin-top: 100px">
        <article>
            <header class="mb-4">
                <h1 class="fw-bolder mb-1 mt-5 text-capitalize">{{ $news->title }}</h1>
                <div class="text-muted fst-italic mb-2">Posted by admin on
                    {{ $news->created_at->format('j F Y, H:i a') }} {{ $news->created_at->diffForHumans() }}</div>
            </header>
            <section class="mt-3 mb-5">
                {!! $news->body !!}
            </section>
        </article>
    </div>
@endsection
