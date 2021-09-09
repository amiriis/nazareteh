@extends('layouts.panels')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="{{ route('headquarter.roles.create') }}">ایجاد نقش</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">شناسه</th>
                            <th scope="col">نام</th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a type="button" class="btn btn-primary" href="{{ route('headquarter.roles.edit', $role) }}">ویرایش</a>
                                    <button type="submit" class="btn btn-primary" form="delete-role">حذف</button>
                                    <form id="delete-role" action="{{ route('headquarter.roles.destroy', $role) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
