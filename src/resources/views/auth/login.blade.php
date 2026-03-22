@extends('layouts.guest')

@section('title')
Login
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('header')
<div class="register__link">
    <a class="register__button-submit" href="/register">register</a>
</div>
@endsection

@section('content')
<div class="login-form">
    <div class="login-form__heading">
        <h2>Login</h2>
    </div>
    <div class="login-form__content">
        <form class="form" action="/login" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <label for="email"><span class="form__label--item">メールアドレス</span></label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" name="email" id="email" placeholder="例：test@example.com" value="{{old('email')}}">
                    </div>
                    <div class="form__error">
                        @error('email')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <label for="password"><span class="form__label--item">パスワード</span></label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password" id="password" placeholder="例：coachtech1106">
                    </div>
                    <div class="form__error">
                        @error('password')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection