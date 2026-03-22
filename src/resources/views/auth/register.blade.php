@extends('layouts.guest')

@section('title')
Register
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('header')
<div class="login__link">
    <a class="login__button-submit" href="/login">login</a>
</div>
@endsection

@section('content')
<div class="register-form">
    <div class="register-form__heading">
        <h2>Register</h2>
    </div>
    <div class="register-form__content">
        <form class="form" action="/register" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <label for="name"><span class="form__label--item">お名前</span></label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="name" id="name" placeholder="例：山田 太郎" value="{{old('name')}}">
                    </div>
                    <div class="form__error">
                        @error('name')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>

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
                <button class="form__button-submit" type="submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection