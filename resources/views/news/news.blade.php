@extends('home.layouts.main')

@section('container')
    <div class="container" style="margin-top: 100px">
        <h1>Portal Berita Kebun Raya ITERA</h1>
        <ol class="mt-4">
            @foreach ($news as $n)
                <li>
                    <a class="text-decoration-none text-capitalize" href="{{ route('detailsNewsHome', ['id' => $n->id]) }}">
                        {{ $n->title }}
                    </a>
                </li>
            @endforeach
        </ol>
    </div>
@endsection
