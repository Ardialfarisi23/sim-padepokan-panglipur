@extends('layouts.auth')


@section('title', 'Login')


@section('content')
<div class="login-wrapper">


    <!-- LEFT IMAGE -->
    <div class="login-left">
        <img src="{{ asset('assets/img/padepokan-login.jpeg') }}" alt="Padepokan">
    </div>


    <!-- RIGHT FORM -->
    <div class="login-form-area">
        <div class="login-box">


            <h2 class="login-title">Login</h2>
            <p class="login-subtitle">
                Masuk ke Sistem Informasi<br>
                Padepokan Laskar Panglipur
            </p>


            @if ($errors->any())
                <div class="login-error">
                    {{ $errors->first() }}
                </div>
            @endif


            <form method="POST" action="{{ route('login') }}">
                @csrf


                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required autofocus>
                </div>


                <div class="form-group">
                    <label>Kata Sandi</label>
                    <input type="password" name="password" required>
                </div>


                <button type="submit" class="btn-login-submit">
                    Masuk
                </button>
            </form>


        </div>
    </div>


</div>
@endsection
