@extends('layouts.app')

@section('title')
    نظرسنجی ها
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
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-sm align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام</th>
                    <th scope="col">تعداد سوالات</th>
                    <th scope="col">زمان شروع</th>
                    <th scope="col">زمان پایان</th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">لینک</th>
                    <th scope="col">تاریخ ثیت</th>
                    <th scope="col">عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sheets as $sheet)
                    <tr class="copy-container">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $sheet->name }}</td>
                        <td>{{ $sheet->questions_count }}</td>
                        <td>{{ $sheet->start_date_fa }}</td>
                        <td>{{ $sheet->end_date_fa }}</td>
                        <td>{{ $sheet->status_fa }}</td>
                        <td>
                            <span class="copy-text">{{ $sheet->url }}</span>
                            @if ($sheet->is_stated && !$sheet->is_ended)<button
                                    class="copy-btn btn btn-sm" type="button" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="کپی"><i class="bi bi-clipboard-plus"></i>
                                </button>
                            @endif
                        </td>
                        <td>{{ $sheet->created_at_fa }}</td>
                        <td>
                            @if ($sheet->is_stated)
                                @if (!$sheet->is_ended)
                                    <button class="btn btn-sm btn-outline-dark pt-2" type="submit"
                                        form="end_sheet_{{ $sheet->id }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="پایان نظرسنجی"><i
                                            class="bi bi-pause-fill"></i></button>
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
                                <button class="btn btn-sm btn-outline-danger pt-2" type="submit"
                                    form="delete_sheet_{{ $sheet->id }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="حذف"><i class="bi bi-trash-fill"></i></button>
                            @endif
                            @if ($sheet->is_ended)
                                <a class="btn btn-sm btn-outline-dark pt-2"
                                    href="{{ route('questioner.sheets.report', $sheet) }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="گزارش نظرسنجی"><i class="bi bi-bar-chart-fill"></i></a>
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
                        <td colspan="6" class="text-center">نظرسنجی ایجاد نشده است</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('scripts-body')
    <script>
        $(document).on('click', '.copy-btn', function() {
            var parent = $(this).parents('.copy-container')
            var copyText = parent.find('.copy-text').text()

            navigator.clipboard.writeText(copyText);

            Toast.fire({
                icon: 'success',
                title: 'لینک در کپی شد'
            })
        })
    </script>
@endsection
