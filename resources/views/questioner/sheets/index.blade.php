@extends('layouts.panels')

@section('title')
    نظرسنجی ها
@endsection

@section('styles')
    <link href="{{ asset('css/questioner.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
    <div class="d-flex align-items-center justify-content-between mb-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">نظرسنجی ها</li>
            </ol>
        </nav>
        <a class="btn btn-sm btn-outline-primary pt-2" href="{{ route('questioner.sheets.create') }}">ایجاد نظرسنجی
            جدید</a>
    </div>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-light align-middle">
                <tr>
                    <th scope="col" rowspan="2">#</th>
                    <th scope="col" rowspan="2">نام</th>
                    <th scope="col" colspan="5">تعداد سوال ها</th>
                    <th scope="col" rowspan="2">وضعیت</th>
                    <th scope="col" rowspan="2">تاریخ ثبت</th>
                    <th scope="col" rowspan="2">عملیات</th>
                </tr>
                <tr>
                    <th scope="col">تشریحی</th>
                    <th scope="col">گزینه ای</th>
                    <th scope="col">انتخابی</th>
                    <th scope="col">تشریحی + گزینه ای</th>
                    <th scope="col">تشریحی + انتخابی</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @forelse ($sheets as $sheet)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $sheet->name }}</td>
                        <td>{{ $sheet->questions_descriptive_count }}</td>
                        <td>{{ $sheet->questions_choice_count }}</td>
                        <td>{{ $sheet->questions_multi_choice_count }}</td>
                        <td>{{ $sheet->questions_choice_and_descriptive_count }}</td>
                        <td>{{ $sheet->questions_multi_choice_and_descriptive_count }}</td>
                        <td>{{ $sheet->status_fa }}</td>
                        <td>{{ $sheet->created_at_fa }}</td>
                        <td>
                            @if ($sheet->is_stated)
                                @if (!$sheet->is_ended)
                                    <button class="btn btn-sm btn-outline-dark pt-2" type="submit"
                                        form="end_sheet_{{ $sheet->id }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="پایان نظرسنجی"><i
                                            class="bi bi-pause-fill"></i></button>
                                    <button class="url-sheet btn btn-sm btn-outline-dark pt-2" value="{{ $sheet->url }}"
                                        type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="لینک نظرسنجی"><i class="bi bi-share-fill"></i>
                                    </button>
                                @endif
                            @else
                                @if ($sheet->status == 1)
                                    <button class="btn btn-sm btn-outline-dark pt-2" type="submit"
                                        form="start_sheet_{{ $sheet->id }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="شروع نظرسنجی"><i
                                            class="bi bi-play-fill"></i></button>
                                @endif
                                <a class="btn btn-sm btn-outline-dark pt-2"
                                    href="{{ route('questioner.sheets.edit', $sheet) }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="ویرایش"><i class="bi bi-pencil-fill"></i></a>
                                <button class="btn-delete-sheet btn btn-sm btn-outline-danger pt-2" type="button"
                                    form="delete_sheet_{{ $sheet->id }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="حذف"><i class="bi bi-trash-fill"></i></button>
                            @endif
                            @if ($sheet->is_ended)
                                <a class="btn btn-sm btn-outline-dark pt-2"
                                    href="{{ route('questioner.sheets.report', $sheet) }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="گزارش نظرسنجی"><i class="bi bi-bar-chart-fill"></i></a>
                                <button class="btn-delete-sheet btn btn-sm btn-outline-danger pt-2" type="button"
                                    form="delete_sheet_{{ $sheet->id }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="حذف"><i class="bi bi-trash-fill"></i></button>
                            @endif
                            @if ($sheet->is_stated && !$sheet->is_ended)
                                <form id="end_sheet_{{ $sheet->id }}"
                                    action="{{ route('questioner.sheets.end', $sheet) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                </form>
                            @else
                                @if ($sheet->status == 1)
                                    <form id="start_sheet_{{ $sheet->id }}"
                                        action="{{ route('questioner.sheets.start', $sheet) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                @endif
                                <form id="delete_sheet_{{ $sheet->id }}"
                                    action="{{ route('questioner.sheets.destroy', $sheet) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">نظرسنجی ایجاد نشده است</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('scripts-body')
    <script>
        $(document).on('click', '.url-sheet', function() {
            const copyText = $(this).val()

            navigator.clipboard.writeText(copyText);

            Toast.fire({
                icon: 'success',
                title: 'لینک کپی شد'
            })
        })

        $(document).on('click', '.btn-delete-sheet', function(e) {
            const form = $(`#${$(this).attr('form')}`)
            Swal.fire({
                title: 'حذف نظرسنجی',
                text: 'آیا میخواهید نظرسنجی مورد نظر را حدف کنید',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله حذف کن',
                cancelButtonText: 'خیر'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit()
                }
            })
        })
    </script>
@endsection
