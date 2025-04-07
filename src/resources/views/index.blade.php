@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('title','Admin')

@section('content')

<div class="form-content">
    <form method="GET" action="/admin/search" class="search-form">
        @csrf
        <div class="search-form__item">
            <input type="text" name="keyword" class="search-form__item-input" placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword') }}">
        </div>
        <div class="select__gender">
            <select name="gender" class="form-control">
                <option value="">性別</option>
                <option value="all">全て</option>
                <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
                <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
                <option value="その他" {{ request('gender') == 'その他' ? 'selected' : '' }}>その他</option>
            </select>
        </div>
        <div class="select__category">
            <select name="category_id" class="form-control">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="select__date">
            <input type="date" name="date" class="form-control" value="{{ old('date') }}">
        </div>
        <div class="search-button">
            <button type="submit" class="search-button__submit">検索</button>
        </div>
        <div class="reset-button">
            <button type="reset" class="reset-button__reset">リセット</button>
        </div>
    </form>
</div>

<div class="export-pagination">
    <div class="export-pagination__item">
        <form method="GET" action="{{ route('export') }}">
            @csrf
            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
            <input type="hidden" name="gender" value="{{ request('gender') }}">
            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            <input type="hidden" name="date" value="{{ request('date') }}">
            <button class="export-button" type="submit">エクスポート</button>
        </form>
        <div class="pagination">
        {{ $contacts->links('vendor.pagination.default') }}
        </div>
    </div>
</div>

<div class="result-content">
    <div class="result-table">
        <table>
            <tr class="result-table__row">
                <th class="result-table__item">お名前</th>
                <th class="result-table__item">性別</th>
                <th class="result-table__item">メールアドレス</th>
                <th class="result-table__item">お問い合わせの種類</th>
                <th class="result-table__item"></th>
            </tr>
            @foreach($contacts as $contact)
            <tr class="result-table__row">
                <td class="result-table__item-content">{{ $contact['last_name'] . ' ' . $contact['first_name'] }}</td>
                <td class="result-table__item-content">{{ $genderLabels[$contact['gender']] ?? '不明' }}</td>
                <td class="result-table__item-content">{{ $contact['email'] }}</td>
                <td class="result-table__item-content">{{ $contact['category']['content'] }}</td>
                <td class="result-table__item-content">
                    <form method="GET" action="/admin" class="detail-form">
                        <input type="hidden" name="detail_id" value="{{ $contact->id }}">
                        <button type="submit" class="button-info">詳細</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@if(request('detail_id'))
@php
    $detail = $contacts->firstWhere('id', request('detail_id'));
@endphp
@if($detail)
<div class="modal" id="detailModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <form method="GET" action="/admin" class="close-form">
                    @csrf
                    <button type="submit" class="close" name="detail_id">×</button>
                </form>
            </div>
            <div class="modal-body" id="modalBody">
                <table class="modal-table">
                    <tr class="modal-table__row">
                        <th class="modal-table__item">お名前</th>
                        <td class="modal-table__item-content">{{ $detail['last_name'] . ' ' . $detail['first_name'] }}</td>
                    </tr>
                    <tr class="model-table__row">
                        <th class="modal-table__item">性別</th>
                        <td class="modal-table__item-content">{{ $genderLabels[$detail['gender']] }}</td>
                    </tr>
                    <tr class="model-table__row">
                        <th class="modal-table__item">電話番号</th>
                        <td class="modal-table__item-content">{{ $detail['tel'] }}</td>
                    </tr>
                    <tr class="model-table__row">
                        <th class="modal-table__item">住所</th>
                        <td class="modal-table__item-content">{{ $detail['address'] }}</td>
                    </tr>
                    <tr class="model-table__row">
                        <th class="modal-table__item">建物名</th>
                        <td class="modal-table__item-content">{{ $detail['building'] }}</td>
                    </tr>
                    <tr class="model-table__row">
                        <th class="modal-table__item">お問い合わせの種類</th>
                        <td class="modal-table__item-content">{{ $detail['category']['content'] }}</td>
                    </tr>
                    <tr class="model-table__row">
                        <th class="modal-table__item">お問い合わせ内容</th>
                        <td class="modal-table__item-content">{{ $detail['detail'] }}</td>
                    </tr>
                </table>
                <form action="/admin/delete" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="delete-button">
                        <button class="delete-button__submit" type="submit">削除</button>
                        <input type="hidden" name="id" value="{{ $contacts['id'] }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endif
@endsection
