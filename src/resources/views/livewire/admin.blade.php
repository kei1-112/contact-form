<div>
<table class="table">
    <tr class="table__list--tr">
        <th class="table__list--th">お名前</th>
        <th class="table__list--th">性別</th>
        <th class="table__list--th">メールアドレス</th>
        <th class="table__list--th">お問い合わせの種類</th>
        <th class="table__list--th">　　　　　</th>
    </tr>
    @foreach($contacts as $contact)
    <tr class="table__list--tr">
        <td class="table__list--td">{{$contact['last_name']}}　{{$contact['first_name']}}</td>
        <td class="table__list--td">
        @if($contact['gender'] == 1)
        男性
        @elseif($contact['gender'] == 2)
        女性
        @else
        その他
        @endif
        </td>
        <td class="table__list--td">{{$contact['email']}}</td>
        <td class="table__list--td">{{ optional($categories->firstWhere('id', $contact['category_id']))->content }}</td>
        <td class="table__list--td">
                <button wire:click="openModal({{$contact['id']}})" class="button__detail">
                    詳細
                </button>
        </td>
    </tr>
    @endforeach
</table>

@if($showModal)
<div class="modal">
    <div class="modal__content">
        <div class="button__modal">
            <button wire:click="closeModal()" class="button__modal-close">
                ×
            </button>
        </div>
        <table class="detail-table">
            <tr>
                <th class="table__detail--th">お名前</th>
                <td class="table__detail--td">{{$detailContact['last_name']}}　{{$detailContact['first_name']}}
                </td>
            </tr>
            <tr>
                <th class="table__detail--th">性別</th>
                <td class="table__detail--td">
                @if($detailContact['gender'] == 1)
                    男性
                    @elseif($detailContact['gender'] == 2)
                    女性
                    @else
                    その他
                @endif
                </td>
            </tr>
            <tr>
                <th class="table__detail--th">メールアドレス</th>
                <td class="table__detail--td">
                    {{$detailContact['email']}}
                </td>
            </tr>
            <tr>
                <th class="table__detail--th">電話番号</th>
                <td class="table__detail--td">
                    {{$detailContact['tel']}}
                </td>
            </tr>
            <tr>
                <th class="table__detail--th">住所</th>
                <td class="table__detail--td">
                    {{$detailContact['address']}}
                </td>
            </tr>
            <tr>
                <th class="table__detail--th">建物名</th>
                <td class="table__detail--td">
                    {{$detailContact['building']}}
                </td>
            </tr>
            <tr>
                <th class="table__detail--th">お問合せの種類</th>
                <td class="table__detail--td">
                {{ optional($categories->firstWhere('id', $detailContact['category_id']))->content }}
                </td>
            </tr>
            <tr>
                <th class="table__detail--th">お問合せ内容</th>
                <td class="table__detail--td">
                    {{$detailContact['detail']}}
                </td>
            </tr>
        </table>
        <button wire:click="deleteData({{$detailContact['id']}})" class="button__delete">
            削除
        </button>
    </div>
</div>

@endif
</div>