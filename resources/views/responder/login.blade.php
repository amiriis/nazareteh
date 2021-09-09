@extends('layouts.pages')

@section('title')
    {{ $sheet->name }}
@endsection

@section('scripts-head')
    <script>
        var serverToJs = {
            user_type: {{ $sheet->user_type }}
        }
    </script>
@endsection

@section('styles')
    <link href="{{ asset('css/responder.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="page-container p-3 d-flex flex-column">
            <div class="sheet-container mb-3">
                <div class="sheet-name text-center">
                    <h3>{{ $sheet->name }}</h3>
                </div>
                <div class="sheet-description">
                    <p>{{ $sheet->description }}</p>
                </div>
            </div>
            <form action="" method="POST" id="login_form">
                @csrf
                <div class="login-container d-flex align-items-center">
                    <div class="col me-2 form-floating">
                        <input type="text" name="user" class="form-control" id="user_input" placeholder="کاربر">
                        <label for="user_input">{{ $sheet->user_type_fa }}</label>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-lg">شروع</button>
                    </div>
                </div>
            </form>
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show m-0 mt-3" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts-body')
    <script src="{{ asset('js/sheets/login.js') }}"></script>
@endsection
