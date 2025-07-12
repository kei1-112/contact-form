@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('title', 'Confirm')

@section('content')
<form action="store" method="post">
    @csrf
    <div class="form">
        <table class="confirm__table">
            <tr><th>お名前</th><td><input type="text" name="last_name" class="input__field" value="{{ $contact['last_name'] }}" readonly /><input type="text" name="first_name" class="input__field" value="{{ $contact['first_name'] }}" readonly /></td></tr>
            <tr><th>性別</th>
                <td>
                <input type="text" value="@if($contact['gender'] == 1) 男性
                                                                        @elseif($contact['gender'] == 2) 女性
                                                                        @elseif($contact['gender'] == 3) その他
                                                                        @else 未設定
                                                                        @endif"  readonly />
                <input type="hidden" value="{{$contact['gender']}}" name="gender">
                </td>
            </tr>
            <tr><th>メールアドレス</th><td><input type="text" name="email"class="form__input" value="{{ $contact['email'] }}" readonly /></td></tr>
            <tr><th>電話番号</th>
                <td>
                    <input type="text" value="{{ $contact['tel1'] }} - {{ $contact['tel2'] }} - {{ $contact['tel3']}}" readonly />
                    <input type="hidden" name="tel" value="{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3']}}">
                    <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
                    <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
                    <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
                </td>
            </tr>
            <tr><th>住所</th><td><input type="text" name="address" value="{{ $contact['address'] }}" readonly /></td></tr>
            <tr><th>建物名</th><td><input type="text" name="building" value="{{ $contact['building'] }}" readonly /></td></tr>
            <tr><th>お問い合わせの種類</th>
                <td>
                    <input type="text" name="category_id" value="{{ optional($categories->firstWhere('id', $contact['category_id']))->content }}" readonly />
                    <input type="hidden" value="{{$contact['category_id']}}" name="category_id">
                </td></tr>
            <tr><th>お問い合わせ内容</th><td><input type="text" name="detail" value="{{ $contact['detail'] }}" readonly /></td></tr>
        </table>
        <div class="form__button">
            <button class="form__button-submit">送信</button>
            <button formaction="{{ route('contact.edit') }}" formmethod="post" class="form__button-correction">修正</button>
        </div>
    </div>
</form>
@endsection