@extends('templates/login_layout')
@section('content')

<div class="login-wrapper">
    <div class="login-box">
        <h2 class="text-center">Login</h2>
        <hr>
        <form action="{{ route('login_submit') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="text_username" class="form-label">Username</label>
                <input type="text" name="text_username" id="text_username" class="form-control" placeholder="Username" required value="{{ old('text_username') }}">
                @error('text_username')
                    <div class="text-danger">{{ $errors->get('text_username')[0] }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="text_password" class="form-label">Username</label>
                <input type="password" name="text_password" id="text_password" class="form-control" placeholder="Passoword" required value="{{ old('text_password') }}">
                @error('text_password')
                    <div class="text-danger">{{ $errors->get('text_password')[0] }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </div>
        </form>
        @if(session()->has('login_error'))
            <div class="alert alert-danger">{{ session()->get('login_error') }}</div>
        @endif
    </div>
</div>

@endsection