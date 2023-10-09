@extends('auth.layouts.index')

@section('title')
    Verifikasi Email
@endsection

@section('form')
    <div class="border">
        <div class="bg-light p-5 rounded text-center">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    A fresh verification link has been sent to your email address.
                </div>
            @endif

            <h1>Email Verification</h1>

            Before proceeding, please check your email for a verification link. If you did not receive the email,
            <form action="{{ route('verification.send') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link p-0">
                    click here to request another
                </button>.
            </form>
        </div>
    </div>
@endsection
