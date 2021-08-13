@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="d-flex justify-content-center">
                    <span class="h4">لیست سوالات</span>
                </div>
                <div class="questions-box py-2">
                    <div class="d-flex question-container my-2">
                        <div class="col-11 d-flex align-items-center question-item-box">
                            <span class="col p-2 text-center question-item-num">1</span>
                            <span class="col-11 p-2 question-item-title">عنوان نوان سوانوان سوانوان سوانوان سوانوان سوانوان
                                سوانوان سوانوان سوانوان سوانوان سوانوان سوانوان سوانوان سوانوان سوانوان سوانوان
                                سواسوال</span>
                        </div>
                        <div class="col-1 d-flex align-items-center justify-content-center question-item-delete">
                            <i class="bi-trash"></i>
                        </div>
                    </div>
                    <div class="d-flex question-container my-2">
                        <div class="col-11 d-flex align-items-center question-item-box active">
                            <span class="col p-2 text-center question-item-num">2</span>
                            <span class="col-11 p-2 question-item-title">عنوان سوال</span>
                        </div>
                        <div class="col-1 d-flex align-items-center justify-content-center question-item-delete">
                            <i class="bi-trash"></i>
                        </div>
                    </div>
                    <div class="d-flex question-container my-2">
                        <div class="col-11 d-flex align-items-center question-item-box">
                            <span class="col p-2 text-center question-item-num">38888</span>
                            <span class="col-11 p-2 question-item-title">عنوان سوال</span>
                        </div>
                        <div class="col-1 d-flex align-items-center justify-content-center question-item-delete">
                            <i class="bi-trash"></i>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center question-add-box my-2">
                    <span class="col text-center p-1"><i class="bi-plus-lg"></i></span>
                </div>
            </div>
            <div class="col">
                <div class="d-flex justify-content-center">
                    <span class="h4">جزئیات</span>
                </div>
                <div class="question-content py-2">
                    یسش
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <span class="h4">تنظیمات</span>
                </div>
                <div class="question-content py-2">
                    یسش
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <span class="h4">گزینه ها</span>
                </div>
                <div class="question-content py-2">
                    یسش
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
