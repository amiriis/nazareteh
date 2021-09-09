@extends('layouts.panels')

@section('title')
    پاسخ شرکت کننده '{{ $responder->user }}' به نظرسنجی '{{ $sheet->name }}'
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
                <li class="breadcrumb-item active" aria-current="page">پاسخ شرکت کننده ' {{ $responder->user }} '</li>
            </ol>
        </nav>
        <a class="btn btn-sm btn-outline-dark pt-2" href="{{ route('questioner.sheets.report', $sheet) }}">بازگشت</a>
    </div>
@endsection

@section('content')
    <div class="d-flex flex-wrap">
        @foreach ($sheet->questions as $question)
            <div class="col-12 py-3">
                <div class="card">
                    <div class="card-body">
                        <div class="h6 mb-3">
                            <span>{{ $loop->iteration }}</span>.<span
                                class="p-1">{{ $question->title }}</span>
                        </div>
                        <p class="mb-3">{{ $question->description }}</p>

                        @if ($question->has_choice)
                            <div class="list-group mb-3">
                                @if ($question->has_multiple_choice)
                                    @foreach ($question->choices as $choice)
                                        <label class="list-group-item{{($question->multipleChoiceAnswers->where('responder_id', $responder->id)->where('choice_id', $choice->id)->first()) ? ' list-group-item-primary': '' }}">
                                            <input {{($question->multipleChoiceAnswers->where('responder_id', $responder->id)->where('choice_id', $choice->id)->first()) ? 'checked': '' }}  class="form-check-input input-choice me-2" type="checkbox"
                                                disabled>{{ $choice->title }}</label>
                                    @endforeach
                                @else
                                    @foreach ($question->choices as $choice)
                                        <label class="list-group-item{{($question->multipleChoiceAnswers->where('responder_id', $responder->id)->where('choice_id', $choice->id)->first()) ? ' list-group-item-primary': '' }}">
                                            <input {{($question->multipleChoiceAnswers->where('responder_id', $responder->id)->where('choice_id', $choice->id)->first()) ? 'checked': '' }} class="form-check-input input-choice me-2" type="radio"
                                                disabled>{{ $choice->title }}</label>
                                    @endforeach
                                @endif
                            </div>
                        @endif
                        @if ($question->has_descriptive)
                            <div class="border rounded px-3">
                                <label class="col-sm-2 col-form-label">جواب تشریحی</label>
                                <textarea class="form-control-plaintext text-primary"
                                    readonly>{{ $question->descriptiveAnswers->where('responder_id', $responder->id)->first()->answer }}</textarea>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
