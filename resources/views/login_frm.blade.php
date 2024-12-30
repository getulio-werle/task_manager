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
                <input type="text" name="text_username" id="text_username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <label for="text_password" class="form-label">Username</label>
                <input type="password" name="text_password" id="text_password" class="form-control" placeholder="Passoword" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </div>
        </form>
    </div>
</div>

@endsection