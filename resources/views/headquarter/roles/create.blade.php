@extends('layouts.panels')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('headquarter.roles.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">نام نقش</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <button type="submit" class="btn btn-primary">ایجاد</button>
                </form>
            </div>
        </div>
    </div>
@endsection
