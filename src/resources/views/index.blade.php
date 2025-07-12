@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('title', 'Contact')

@section('content')
<form action="/confirm" method="post">
@csrf
    <div class="form">
        <div class="form__group">
            <div class="form__group--item">お名前</div>
            <div class="form__input--fullname">
                <input type="input" class="form__input--name" name="last_name" value="{{ old('last_name') }}" placeholder="例:山田">
                <input type="input" class="form__input--name" name="first_name" value="{{ old('first_name') }}" placeholder="例:太郎">
            </div>
        </div>
        <div class="error__fullname">
            <div class="error__last-name">
                @if($errors->has('last_name'))
                {{$errors->first('last_name')}}
                @endif
            </div>
            <div class="error__first-name">
                @if($errors->has('first_name'))
                {{$errors->first('first_name')}}
                @endif
            </div>
        </div>
        <div class="form__group">
            <div class="form__group--item">性別</div>
            <div class="form__radio">
                <input type="radio" id="gender1" name="gender" value=1 {{ old('gender') == 1 ? 'checked' : '' }}>
                <label for="gender1" class="form__radio--button">男性</label>
                <input type="radio" id="gender2" name="gender" value=2 {{ old('gender') == 2 ? 'checked' : '' }}>
                <label for="gender2" class="form__radio--button">女性</label>
                <input type="radio" id="gender3" name="gender" value=3 {{ old('gender') == 3 ? 'checked' : '' }}>
                <label for="gender3" class="form__radio--button">その他</label>
            </div>
        </div>
        <div class="error">
            @if($errors->has('gender'))
            {{$errors->first('gender')}}
            @endif
        </div>
        <div class="form__group">
            <div class="form__group--item">メールアドレス</div>
            <div class="form__input">
                <input type="email" class="form__input--field" name="email" value="{{ old('email') }}" placeholder="例:test@example.com">
            </div>
        </div>
        <div class="error">
            @if($errors->has('email'))
            {{$errors->first('email')}}
            @endif
        </div>
        <div class="form__group">
            <div class="form__group--item">電話番号</div>
            <div class="form__input--tel">
                <input type="input" class="form__input--tel-inner" name="tel1" value="{{ old('tel1') }}" placeholder="080">-
                <input type="input" class="form__input--tel-inner" name="tel2" value="{{ old('tel2') }}" placeholder="1234">-
                <input type="input" class="form__input--tel-inner" name="tel3" value="{{ old('tel3') }}" placeholder="5678">
            </div>
        </div>
        <div class="error">
            @if($errors->has('tel1'))
                {{$errors->first('tel1')}}
            @elseif($errors->has('tel2'))
                {{$errors->first('tel2')}}
            @elseif($errors->has('tel3'))
                {{$errors->first('tel3')}}
            @endif
        </div>
        <div class="form__group">
            <div class="form__group--item">住所</div>
            <div class="form__input">
                <input type="input" class="form__input--field" name="address" value="{{ old('address') }}" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3">
            </div>
        </div>
        <div class="error">
            @if($errors->has('address'))
            {{$errors->first('address')}}
            @endif
        </div>
        <div class="form__group">
            <div class="form__group--building">建物名</div>
            <div class="form__input">
                <input type="input" class="form__input--field" name="building" value="{{ old('building') }}" placeholder="例:千駄ヶ谷マンション">
            </div>
        </div>
        <div class="form__group">
            <div class="form__group--item">お問い合わせの種類</div>
                <div class="form__select">
                    <select class="form__select--option" name="category_id">
                    <option value="" disabled selected>選択してください</option>
                        @foreach($categories as $category)
                        <option value="{{ $category['id'] }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category['content'] }}
                        </option>
                        @endforeach
                    </select>
            </div>
        </div>
        <div class="error">
            @if($errors->has('category_id'))
            {{$errors->first('category_id')}}
            @endif
        </div>
        <div class="form__group">
            <div class="form__group--item">お問い合わせ内容</div>
            <div class="form__input">
                <textarea class="form__input--textarea" name="detail" value="{{ old('detail') }}" placeholder="お問い合せ内容をご記載ください"></textarea>
            </div>
        </div>
        <div class="error">
            @if($errors->has('detail'))
            {{$errors->first('detail')}}
            @endif
        </div>
        <button class="form__button-submit">確認画面</button>
    </div>
</form>
@endsection