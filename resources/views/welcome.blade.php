@extends('layouts.pages')

@section('styles')
    <style>
        body {
            background-color: #f1f1f1;
            width: 100vw;
            height: 100vh;
        }

    </style>
@endsection

@section('title')
   چونکه نظرت مـهـمـه
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="page-container p-3 d-flex flex-column text-center">
            <h1 class="mb-3">نظرتـه</h1>
            <h5 class="text-secondary mb-3">چونکه نظرت مـهـمـه</h5>
            <div class="d-flex flex-column mt-3">
                <a href="{{ route('register') }}" class="mb-3 btn btn-lg btn-primary">نظرسنجی ــت رو بساز</a>
                <a href="{{ route('login') }}" class="btn btn-sm btn-link">ورود به پنل</a>
            </div>
        </div>
    </div>
@endsection
