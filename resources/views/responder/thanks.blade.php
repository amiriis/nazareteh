@extends('layouts.pages')

@section('title')
    {{ $sheet->name }}
@endsection

@section('styles')
    <link href="{{ asset('css/responder.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="page-container questions-box p-3 d-flex flex-column">
            <p class="text-center text-success h5 p-0 m-0">نظر شما با موفقیت ثبت شد</p>
        </div>
    </div>
@endsection
