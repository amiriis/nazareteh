@extends('layouts.panels')

@section('title')
    سوال '{{ $question->title }}' در نظرسنجی '{{ $sheet->name }}'
@endsection

@section('styles')
    <link href="{{ asset('css/questioner.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
    <div class="d-flex align-items-center justify-content-between mb-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('questioner.sheets.index') }}">نظرسنجی ها</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('questioner.sheets.report', $sheet) }}">گزارش نظرسنجی '
                        {{ $sheet->name }} '</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">سوال ' {{ $question->title }} '</li>
            </ol>
        </nav>
        <a class="btn btn-sm btn-outline-dark pt-2" href="{{ route('questioner.sheets.report', $sheet) }}">بازگشت</a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card my-3">
                <div class="card-body d-flex">
                    <div class="col-7 pe-3 border-end">
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span>عنوان:</span><span class="ps-1">{{ $question->title }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span>توضیحات:</span><span class="ps-1">{{ $question->description }}</span>
                        </div>
                    </div>
                    <div class="col-5 ps-3">
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span>عنوان نظرسنجی:</span><span class="ps-1">{{ $question->sheet->name }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span>نوع:</span><span class="ps-1">{{ $question->type_fa }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($question->has_choice)
        @if ($question->has_multiple_choice)
            <h4 class="mb-3">پاسخ های انتخابی</h4>
        @else
            <h4 class="mb-3">پاسخ های گزینه ای</h4>
        @endif
        <div class="row mb-3">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="table-light align-middle">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">تعداد</th>
                                <th scope="col">میانگین</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($question->choices as $choice)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $choice->title }}</td>
                                    <td>{{ $question->multipleChoiceAnswers->where('choice_id', $choice->id)->count() }}
                                    </td>
                                    <td><span>{{ round(($question->multipleChoiceAnswers->where('choice_id', $choice->id)->count() / $question->multipleChoiceAnswers->count()) * 100) }}</span><i class="bi bi-percent"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    @if ($question->has_descriptive)
        <h4>پاسخ های تشریحی</h4>
        <div class="d-flex flex-wrap">
            @foreach ($question->descriptiveAnswers as $descriptiveAnswer)
                <div class="col-12 py-3">
                    <div class="card">
                        <div class="card-body px-0">
                            <div class="h6 pb-3 px-3 border-bottom mb-3">
                                <span>{{ $sheet->user_type_fa }}:</span><span
                                    class="p-1">{{ $descriptiveAnswer->responer->user }}</span>
                            </div>
                            <div class="px-3">
                                <textarea class="form-control-plaintext text-primary"
                                    readonly>{{ $descriptiveAnswer->answer }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
