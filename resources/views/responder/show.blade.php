@extends('layouts.pages')

@section('title')
    {{ $sheet->name }}
@endsection

@section('scripts-head')
    <script>
        var serverToJs = {
            questions: {!! $sheet->questions !!}
        }
    </script>
@endsection

@section('styles')
    <link href="{{ asset('css/responder.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="page-container questions-box p-3 d-flex flex-column">
            <form id="form_responder_store" action="{{route('reponder.store',['sheet' => $sheet->token, 'responder' => $responder->token])}}" method="POST">
                @csrf
                <div class="questions-container"></div>
            </form>
            <div class="d-flex py-3 align-items-center">
                <div class="col">
                    <button class="previous-step btn btn-link" aria-hidden="false">قبلی</button>
                </div>
                <span class="col text-center text-message"><span class="question-step px-1"></span>از<span class="question-total px-1"></span></span>
                <div class="col text-end">
                    <button default-text="بعدی" class="next-step btn btn-primary"></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts-body')
    <script src="{{ asset('js/sheets/show.js') }}"></script>
@endsection
