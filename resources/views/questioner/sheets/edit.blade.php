@extends('layouts.app')

@section('title')
    ویرایش نظرسنجی ' {{ $sheet->name }} '
@endsection

@section('scripts-head')
    <script>
        var questions = new Array;
        questions = {!! $sheet->questions !!}
        var choices = new Array;
        @foreach ($sheet->questions as $question)
            @if (!$question->choices->isEmpty())
                @foreach ($question->choices as $choice)
                    choices.push({!! $choice !!})
                @endforeach
            @endif
        @endforeach
    </script>
@endsection

@section('styles')
    <style>
        body {
            overflow-y: scroll;
        }

    </style>
@endsection

@section('breadcrumb')
    <div class="d-flex align-items-center justify-content-between mb-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('questioner.sheets.index') }}">نظرسنجی ها</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">ویرایش نظرسنجی ' {{ $sheet->name }} '</li>
            </ol>
        </nav>
        <a class="btn btn-sm btn-outline-dark pt-2" href="{{ route('questioner.sheets.index') }}">بازگشت</a>
    </div>
@endsection

@section('content')
    <form action="{{ route('questioner.sheets.update', $sheet) }}" class="needs-validation" novalidate method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-4">
                <div class="d-flex justify-content-center">
                    <span class="h5">جزئیات فرم</span>
                </div>
                <div class="question-content py-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" value="{{ $sheet->name }}"
                            placeholder="عنوان سوال" required>
                        <label for="name">نام</label>
                        <div class="invalid-feedback">
                            لطفا نام فرم را وارد نمایید
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" id="description" name="description" style="height: 100px"
                            placeholder="توضیحات سوال">{{ $sheet->description }}</textarea>
                        <label for="description">توضیحات</label>
                        <div id="descriptionHelp" class="form-text">(اختیاری)
                            توضیحات در اولین بخش صفحه نظرسنجی نمایش داده می شود
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <span class="h5">کاربر بر اساس</span>
                </div>
                <div class="question-content py-3">
                    <div class="form-check form-check-inline">
                        <input @if ($sheet->user_type == 1) checked @endif
                            class="form-check-input" type="radio" name="user_type" id="user_type_code" value="1" required>
                        <label class="form-check-label" for="user_type_code">کد ملی</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input @if ($sheet->user_type == 2) checked @endif
                            class="form-check-input" type="radio" name="user_type" id="user_type_mobile" value="2" required>
                        <label class="form-check-label" for="user_type_mobile">شماره همراه</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input @if ($sheet->user_type == 3) checked @endif
                            class="form-check-input" type="radio" name="user_type" id="user_type_email" value="3" required>
                        <label class="form-check-label" for="user_type_email">پست الکترونیک</label>
                    </div>
                </div>
                <div class="d-grid gap-1 mt-3">
                    <p class="text-warning d-flex align-items-center"><i
                            class="bi bi-exclamation-triangle-fill pt-1 px-1"></i> پس از طراحی سوالات اقدام به
                        ثبت نهایی فرم نمایید</p>
                    <button class="btn btn-primary" type="submit">ثبت نهایی فرم</button>
                </div>
                <div class="form-text text-danger mt-3">
                    <ul class="error-questions">
                    </ul>
                </div>
            </div>
            <div class="col-4">
                <div class="d-flex justify-content-center">
                    <span class="h5">لیست سوالات</span>
                </div>
                <div class="questions-box py-2"></div>
                <div class="d-flex align-items-center question-add-box my-2">
                    <span class="col text-center p-1"><i class="bi-plus-lg"></i></span>
                </div>
            </div>
            <div class="col-4">
                <div class="question-forms"></div>
            </div>
        </div>
        <div class="delete-questions"></div>
        <div class="delete-choices"></div>
    </form>
@endsection

@section('scripts-body')
    <script src="{{ asset('js/sheets/edit.js') }}"></script>
@endsection
