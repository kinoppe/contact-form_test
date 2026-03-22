@extends('layouts.admin')

@section('content')
<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>

    <div class="admin__search">
        <form class="search-form" action="/admin" method="get">
            <input class="search-form__input" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">

            <select class="search-form__select" name="gender">
                <option value="">性別</option>
                <option value="1" {{ request('gender') == 1 ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == 2 ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == 3 ? 'selected' : '' }}>その他</option>
            </select>

            <select class="search-form__select" name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                    {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                @endforeach
            </select>

            <input class="search-form__date" type="date" name="date" value="{{ request('date') }}">

            <button class="search-form__button" type="submit">検索</button>

            <a class="search-form__reset" href="/admin">リセット</a>
        </form>
    </div>

    <div class="admin__item">
        <div class="admin__export">
            <a class="admin__export-button" href="/admin/export?{{ http_build_query(request()->query()) }}">エクスポート</a>
        </div>

        <div class="admin__pagination">
            {{ $contacts->links('vendor.pagination.default') }}
        </div>
    </div>
    <div class="admin__table">
        <table class="">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>
                        @if ($contact->gender == 1)
                            男性
                        @elseif ($contact->gender == 2)
                            女性
                        @else
                            その他
                        @endif
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content ?? '' }}</td>
                    <td>
                        <button class="table__button detail-btn"
                            data-id="{{ $contact->id }}"
                            data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                            data-gender="{{ $contact->gender }}"
                            data-email="{{ $contact->email }}"
                            data-tel="{{ $contact->tel }}"
                            data-address="{{ $contact->address }}"
                            data-building="{{ $contact->building }}"
                            data-category="{{ $contact->category->content ?? '' }}"
                            data-detail="{{ $contact->detail }}">
                            詳細
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="modal" class="modal">
    <div class="modal__content">

        <span class="modal__close">&times;</span>

        <div class="modal__body">
            <div class="modal__row">
                <p class="modal__label">お名前</p>
                <p class="modal__value" id="modal-name"></p>
            </div>

            <div class="modal__row">
                <p class="modal__label">性別</p>
                <p class="modal__value" id="modal-gender"></p>
            </div>

            <div class="modal__row">
                <p class="modal__label">メールアドレス</p>
                <p class="modal__value" id="modal-email"></p>
            </div>

            <div class="modal__row">
                <p class="modal__label">電話番号</p>
                <p class="modal__value" id="modal-tel"></p>
            </div>

            <div class="modal__row">
                <p class="modal__label">住所</p>
                <p class="modal__value" id="modal-address"></p>
            </div>

            <div class="modal__row">
                <p class="modal__label">建物名</p>
                <p class="modal__value" id="modal-building"></p>
            </div>

            <div class="modal__row">
                <p class="modal__label">お問い合わせの種類</p>
                <p class="modal__value" id="modal-category"></p>
            </div>

            <div class="modal__row">
                <p class="modal__label">お問い合わせ内容</p>
                <p class="modal__value" id="modal-detail"></p>
            </div>

            <form id="modal-delete-form" method="post">
                @csrf
                @method('DELETE')
                <button class="modal__delete">削除</button>
            </form>

        </div>
    </div>
</div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('modal');

    document.querySelectorAll('.detail-btn').forEach(btn => {
        btn.addEventListener('click', () => {

            let genderText = '';
            if (btn.dataset.gender == 1) genderText = '男性';
            else if (btn.dataset.gender == 2) genderText = '女性';
            else genderText = 'その他';

            document.getElementById('modal-name').textContent = btn.dataset.name;
            document.getElementById('modal-gender').textContent = genderText;
            document.getElementById('modal-email').textContent = btn.dataset.email;
            document.getElementById('modal-tel').textContent = btn.dataset.tel;
            document.getElementById('modal-address').textContent = btn.dataset.address;
            document.getElementById('modal-building').textContent = btn.dataset.building;
            document.getElementById('modal-category').textContent = btn.dataset.category;
            document.getElementById('modal-detail').textContent = btn.dataset.detail;

            document.getElementById('modal-delete-form').action = `/admin/delete/${btn.dataset.id}`;

            modal.style.display = 'flex';
        });
    });

    // 閉じるボタン
    document.querySelector('.modal__close').addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // 背景クリックでも閉じる
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

});
</script>
@endsection