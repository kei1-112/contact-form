@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('button')
<div class="header__button">
    <a class="header__button--link" href="/login">
    login
    </a>
</div>
@endsection

@section('title', 'Register')

@section('content')
<form action="/register" method="post">
    @csrf
    <div class="form">

        <div class="form__group">
            <div class="form__group-item">お名前</div>
            <input type="input" class="form__input" name="name" placeholder="例:山田　太郎" value="{{ old('name') }}">
        </div>
        <div class="form__error">
            @if($errors->has('name'))
            {{$errors->first('name')}}
            @endif
        </div>
        <div class="form__group">
            <div class="form__group-item">メールアドレス</div>
                <input type="email" class="form__input" name="email" placeholder="例:test@example.com" value="{{ old('email') }}">
        </div>
        <div class="form__error">
            @if($errors->has('email'))
            {{$errors->first('email')}}
            @endif
        </div>
        <div class="form__group">
            <div class="form__group-item">パスワード</div>
            <input type="password" class="form__input" name="password" placeholder="例:coachtech1106" value="{{ old('password') }}">
        </div>
        <div class="form__error">
            @if($errors->has('password'))
            {{$errors->first('password')}}
            @endif
        </div>
        <button class="form__button-submit" type="submit">登録</button>
    </div>
</form>
@endsection