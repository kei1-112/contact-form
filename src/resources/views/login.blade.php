@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('button')
<div class="header__button">
    <a class="header__button--link" href="/register">
        register
    </a>
</div>
@endsection

@section('title', 'Login')

@section('content')
<form action="/login" method="post">
    @csrf
    <div class="form">
        <div class="form__group">
            <div class="form__group--item">メールアドレス</div>
            <input type="email" class="form__input" name="email" placeholder="例:test@example.com">
        </div>
        <div class="form__error">
            @if($errors->has('email'))
            {{$errors->first('email')}}
            @endif
        </div>
        <div class="form__group">
            <div class="form__group--item">パスワード</div>
            <input type="password" class="form__input" name="password" placeholder="例:coachtech1106">
        </div>
        <div class="form__error">
            @if($errors->has('password'))
            {{$errors->first('password')}}
            @endif
        </div>
        <button class="form__button-submit" type="submit">ログイン</button>
    </div>
</form>
@endsection