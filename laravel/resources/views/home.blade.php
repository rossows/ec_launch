@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">メニュー</div>
                <ul class="list-group">
                    <a href="{{ route('product::index') }}" class="list-group-item">商品一覧</a>
                    <a href="{{ route('product::create') }}" class="list-group-item">商品登録</a>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
