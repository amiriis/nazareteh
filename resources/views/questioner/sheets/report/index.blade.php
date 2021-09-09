@extends('layouts.panels')

@section('title')
    گزارش نظرسنجی ' {{ $sheet->name }} '
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
                <li class="breadcrumb-item active" aria-current="page">گزارش نظرسنجی ' {{ $sheet->name }} '</li>
            </ol>
        </nav>
        <a class="btn btn-sm btn-outline-dark pt-2" href="{{ route('questioner.sheets.index') }}">بازگشت</a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card my-3">
                <div class="card-body d-flex">
                    <div class="col-7 pe-3 border-end">
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span>عنوان:</span><span class="ps-1">{{ $sheet->name }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span>توضیحات:</span><span class="ps-1">{{ $sheet->description }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span>نوع کاربر:</span><span class="ps-1">{{ $sheet->user_type_fa }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span>تعداد شرکت کننده:</span><span
                                class="ps-1">{{ $sheet->responders->count() }} نفر</span>
                        </div>
                    </div>
                    <div class="col-5 ps-3">
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span>تاریخ شروع:</span><span class="ps-1">{{ $sheet->start_at_fa }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span>تاریخ پایان:</span><span class="ps-1">{{ $sheet->end_at_fa }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span>زمان:</span><span class="ps-1">{{ $sheet->all_time_fa }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h5 class="text-center mb-3">شرکت کننده ها</h5>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-light align-middle">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ $sheet->user_type_fa }}</th>
                            <th scope="col">تاریخ ثبت</th>
                            <th scope="col">جزئیات</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($sheet->responders as $responder)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $responder->user }}</td>
                                <td>{{ $responder->answer_at_fa }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-dark pt-2"
                                        href="{{ route('questioner.sheets.report.responder', ['sheet' => $sheet, 'responder' => $responder]) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="نمایش پاسخ ها"><i
                                            class="bi bi-eye-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">هیچ پاسخ دهنده ای پیدا نشد</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col">
            <h5 class="text-center mb-3">سوال ها</h5>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-light align-middle">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">عنوان</th>
                            <th scope="col">نوع</th>
                            <th scope="col">جزئیات</th>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($sheet->questions as $question)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $question->title }}</td>
                                <td>{{ $question->type_fa }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-dark pt-2"
                                        href="{{ route('questioner.sheets.report.question', ['sheet' => $sheet, 'question' => $question]) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="نمایش پاسخ ها"><i
                                            class="bi bi-eye-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">هیچ سوالی پیدا نشد</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
