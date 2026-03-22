@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="/thanks/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <label for="last"><span class="form__label--item">お名前</span></label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <div class="form__input-name--last">
                        <input type="text" name="last_name" id="last" placeholder="例：山田" value="{{old('last_name',request('last_name'))}}">
                        <div class="form__error">
                            @error('last_name')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="form__input-name--first">
                        <input type="text" name="first_name" placeholder="例：太郎" value="{{old('first_name',request('first_name'))}}">
                        <div class="form__error">
                            @error('first_name')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <label><input type="radio" name="gender" value="1"
                        {{old('gender',request('gender')) =='1' ? 'checked' : ''}}>男性</label>
                    <label><input type="radio" name="gender" value="2"
                        {{old('gender',request('gender')) =='2' ? 'checked' : ''}}>女性</label>
                    <label><input type="radio" name="gender" value="3"
                        {{old('gender',request('gender')) =='3' ? 'checked' : ''}}>その他</label>
                </div>
                <div class="form__error">
                    @error('gender')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <label for="email"><span class="form__label--item">メールアドレス</span></label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" id="email" placeholder="例：test@example.com" value="{{old('email',request('email'))}}">
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
                <label for="tel"><span class="form__label--item">電話番号</span></label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--tel">
                    <input type="tel" name="tel1" id="tel" placeholder="090" value="{{old('tel1',request('tel1'))}}"><span>-</span>
                    <input type="tel" name="tel2" placeholder="1234" value="{{old('tel2',request('tel2'))}}"><span>-</span>
                    <input type="tel" name="tel3" placeholder="5678" value="{{old('tel3',request('tel3'))}}">
                </div>
                <div class="form__error">
                    @error('tel1')
                    {{$message}}
                    @enderror
                </div>
                <div class="form__error">
                    @error('tel2')
                    {{$message}}
                    @enderror
                </div>
                <div class="form__error">
                    @error('tel3')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <label for="address"><span class="form__label--item">住所</span></label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" id="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{old('address',request('address'))}}">
                </div>
                <div class="form__error">
                    @error('address')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <label for="building"><span class="form__label--item">建物名</span></label>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" id="building" placeholder="例：千駄ヶ谷マンション101" value="{{old('building',request('building'))}}">
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--select">
                    <select class="item-select" name="category_id">
                        <option value=""disabled {{old('category_id',request('category_id')) ? '' : 'selected'}}>選択してください</option>
                        <option value="1"
                        {{old('category_id',request('category_id')) =='1' ? 'selected' : ''}}>商品のお届けについて</option>
                        <option value="2"
                        {{old('category_id',request('category_id')) =='2' ? 'selected' : ''}}>商品の交換について</option>
                        <option value="3"
                        {{old('category_id',request('category_id')) =='3' ? 'selected' : ''}}>商品トラブル</option>
                        <option value="4"
                        {{old('category_id',request('category_id')) =='4' ? 'selected' : ''}}>ショップへのお問い合わせ</option>
                        <option value="5"
                        {{old('category_id',request('category_id')) =='5' ? 'selected' : ''}}>その他</option>
                    </select>
                    <div class="form__error">
                        @error('category_id')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <label for="detail"><span class="form__label--item">お問い合わせ内容</span></label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="detail" id="detail" placeholder="お問い合わせ内容をご記載ください">{{old('detail',request('detail'))}}</textarea>
                </div>
                <div class="form__error">
                    @error('detail')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection