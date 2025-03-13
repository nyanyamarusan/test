<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a href="/" class="header__logo">FashionablyLate</a>
        </div>
    </header>

    <main>
        <h2>Contact</h2>
        <div class="content">
            <div class="form">
                <form method="POST" action="/confirm">
                    @csrf
                    <div class="form-item">
                        <label for="name">お名前<span class="required">※</span></label>
                        <div class="form-item__input">
                            <input class="name" type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                            @error('last_name') <p class="error">{{ $message }}</p> @enderror
                            <input class="name" type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                            @error('first_name') <p class="error">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="form-item">
                    <label>性別<span class="required">※</span></label>
                    <div class="form-item__gender">
                        <label class="gender-label" for="male">
                            <input class="radio-button" type="radio" id="male" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                            男性
                        </label>
                        <label class="gender-label" for="female">
                            <input class="radio-button" type="radio" id="female" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                            女性
                        </label>
                        <label class="gender-label" for="other">
                            <input class="radio-button" type="radio" id="other" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}>
                            その他
                        </label>
                    </div>
                    @error('gender') <p class="error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-item">
                        <label for="email">メールアドレス<span class="required">※</span></label>
                        <div class="form-item__input">
                            <input class="common" type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                        </div>
                        @error('email') <p class="error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-item">
                        <label for="tel">電話番号<span class="required">※</span></label>
                        <div class="form-item__input">
                            <input class="tel" type="tel" name="tel" placeholder="080">
                            <span>-</span>
                            <input class="tel" type="tel" name="tel" placeholder="1234">
                            <span>-</span>
                            <input class="tel" type="tel" name="tel" placeholder="5678">
                        </div>
                        @error('tel') <p class="error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-item">
                        <label for="address">住所<span class="required">※</span></label>
                        <div class="form-item__input">
                            <input class="common" type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                        </div>
                        @error('address') <p class="error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-item">
                        <label for="building">建物名</label>
                        <div class="form-item__input">
                            <input class="common" type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                        </div>
                        @error('building') <p class="error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-item">
                        <label for="category_id">お問い合わせの種類<span class="required">※</span></label>
                        <div class="form-item__input">
                            <div class="select">
                                <select name="category_id" id="">
                                    <option value="">選択してください</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('category_id') <p class="error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-item">
                        <label for="detail">お問い合わせ内容<span class="required">※</span></label>
                        <div class="form-item__textarea">
                            <textarea name="detail" placeholder="例: お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                        </div>
                        @error('detail') <p class="error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-item__button">
                        <button class="button__submit" type="submit">確認画面</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>