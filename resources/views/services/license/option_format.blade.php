@extends('services.layouts.index')

@section('container')
    <div class="px-3">
        <h2>Data Template Surat</h2>
        <hr class="divider rounded">
    </div>

    <div class="list container-fluid mt-5 px-5">
        @php
            $count = 1;
        @endphp
        @foreach ($license_formats as $ls)
            <div class="row item bg-white border rounded d-flex align-items-center p-3 mb-3">
                <div class="col">
                    <span class="pl-5">{{ $count++ }}</span>
                </div>
                <div class="col">
                    <div class="sub-title p-1 text-dark fw-bolder">Nama</div>
                    <div class="value p-1">{{ $ls->format_title }}</div>
                </div>
                <div class="col">
                    <div class="sub_title p-1 text-dark fw-bolder ml-2">Aksi</div>
                    <div class="value p-1">
                        <div class="dropdown">
                            <img class="btn dropdown-toggle"data-toggle="dropdown"
                                src="{{ asset('/assets/images/svg/gear.svg') }}">
                            <span class="caret"></span></img>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('details_template', ['id' => $ls->id]) }}" class="dropdown-item">
                                        <img src="{{ asset('assets/images/svg/edit.svg') }}" class="mr-1">
                                        <span>Generate Template</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
