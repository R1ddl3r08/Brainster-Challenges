@extends('master')
@section('title', 'Login')

@section('loginForm')
    <div class="loginContainer">
        <div class="formContainer">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h2>Login</h2>
                @if(session('error'))
                    <div class="alert-danger">{{ session('error') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button>Login</button>
            </form>
        </div>
    </div>
@endsection