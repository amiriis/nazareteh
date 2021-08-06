@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="{{ route('headquarter.users.create') }}">ایجاد کاربر</a>
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
                            <th scope="col">پست الکترونیک</th>
                            <th scope="col">نقش</th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getRoleNames()->first() }}</td>
                                <td>
                                    <a type="button" class="btn btn-primary" href="{{ route('headquarter.users.edit', $user) }}">ویرایش</a>
                                    <button type="submit" class="btn btn-primary" form="delete-user">حذف</button>
                                    <form id="delete-user" action="{{ route('headquarter.users.destroy', $user) }}" method="POST">
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
