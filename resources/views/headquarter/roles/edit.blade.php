@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('headquarter.roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">نام نقش</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}">
                    </div>
                    <button type="submit" class="btn btn-primary">ویرایش</button>
                </form>
            </div>
        </div>
    </div>
@endsection
