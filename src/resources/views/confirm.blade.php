<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a href="/" class="header__logo">FashionablyLate</a>
        </div>
    </header>

    <main>
        <h2>Confirm</h2>
        <div class="content">
            <div class="form">
                <form method="POST" action="/thanks">
                    @csrf
                    <div class="form-item">
                        <table>
                            <tr>
                                <th>お名前</th>
                                <td><input type="text" name="name" value="{{ $contact['last_name'] }} {{ $contact['first_name'] }}" readonly></td>
                            </tr>
                            <tr>
                                <th>性別</th>
                                <td><input type="text" name="gender" value="{{ $contact->gender_label }}" readonly></td>
                            </tr>
                            <tr>
                                <th>メールアドレス</th>
                                <td><input type="email" name="email" value="{{ $contact['email'] }}" readonly></td>
                            </tr>
                            <tr>
                                <th>住所</th>
                                <td><input type="text" name="address" value="{{ $contact['address'] }}" readonly></td>
                            </tr>
                            <tr>
                                <th>建物名</th>
                                <td><input type="text" name="building" value="{{ $contact['building'] }}" readonly></td>
                            </tr>
                            <tr>
                                <th>お問い合わせの種類</th>
                                <td><input type="text" name="category_id" value="{{ $categoryContent }}" readonly></td>
                            </tr>
                            <tr>
                                <th>お問い合わせ内容</th>
                                <td><textarea name="detail" readonly>{{ $contact['detail'] }}"</textarea></td>
                            </tr>
                        </table>
                        <div class="form-button">
                            <button class="button__submit" type="submit">送信</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="back-buttony">
                <a href="/contact" class="button__modify">修正</a>
            </div>
        </div>
    </main>
</body>
</html>
