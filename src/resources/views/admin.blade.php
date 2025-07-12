@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('button')
<div class="header__button">
    <form action="/logout" method="post" class="header__form">
        @csrf
        <button class="header__button--submit" type="submit">logout</button>
    </form>
</div>
@endsection

@section('title', 'Admin')

@section('content')
<form action="/search" method="get">
    @csrf
    <div class="search">
        <div class="search__input">
            <input type="text" class="search__input--field" placeholder="名前やメールアドレスを入力してください" name="name">
        </div>
        <div class="form__select-box--gender">
            <select class="form__select" name="gender">
                <option value="" disabled selected>性別</option>
                <option value=0>全て</option>
                <option value=1>男性</option>
                <option value=2>女性</option>
                <option value=3>その他</option>
            </select>
        </div>
        <div class="form__select-box--category">
            <select class="form__select" name="category_id">
                <option value="" disabled selected>お問い合わせの種類</option>
                @foreach($categories as $category)
                <option value="{{ $category['id']}}">{{ $category['content']}}</option>
                @endforeach
            </select>
        </div>
        <div class="search__date">
            <input type="date" class="form__calendar" name="date">
        </div>
        <div class="search__button">
            <button type="submit" class="search__button--search">検索</button>
        </div>
        <div class="search__button">
            <a href="/admin" class="search__button--reset" >リセット</a>
        </div>
    </div>
</form>

<div class="navigation">
    <div class="navigation__export">
        <a href="{{ route('admin.export', [
            'name' => request('name'),
        'gender' => request('gender'),
        'category_id' => request('category_id'),
        'date' => request('date'),
]) }}"
        class="button__export">エクスポート</a>
    </div>
    <div class="navigation__pagination">
        {{ $contacts->links() }}
    </div>
</div>

@livewire('admin',[
    'name' => request('name'),
    'gender' => request('gender'),
    'category_id' => request('category_id'),
    'date' => request('date'),
    ])

@endsection
