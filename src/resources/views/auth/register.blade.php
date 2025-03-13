@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('nav')
<li class="header-nav__item">
    <a href="/login" class="header-nav__link">
        <button class="header-nav__button" type="submit">login</button>
    </a>
</li>
@endsection

@section('title','Register')

@section('content')
<div class="form">
    <form method="POST" action="/register">
        @csrf
        <div class="form-item">
            <label for="name">お名前</label>
            <input type="text" name="name" placeholder="例: 山田 太郎" value="{{ old('name') }}">
            @error('name') <p class="error">{{ $message }}</p> @enderror
        </div>
        <div class="form-item">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
            @error('email') <p class="error">{{ $message }}</p> @enderror
        </div>
        <div class="form-item">
            <label for="password">パスワード</label>
            <input type="password" name="password" placeholder="例: coachtech1106">
            @error('password') <p class="error">{{ $message }}</p> @enderror
        </div>
        <div class="form-item__button">
            <button class="button__submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection