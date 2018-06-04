@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">商品編集</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('product::update', ['id' => $productEntity->getId()]) }}">
                            {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">商品名</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $productEntity->getName()}}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="genre" class="col-md-4 control-label">ジャンル</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="genre" name="genre">
                                        <option value="書籍" {{ $productEntity->getGenre() == '書籍' ?  'selected="selected"' : ''}}>
                                            書籍
                                        </option>
                                        <option value="食品" {{ $productEntity->getGenre() == '食品' ?  'selected="selected"' : ''}}>
                                            食品
                                        </option>
                                        <option value="家電" {{ $productEntity->getGenre() == '家電' ?  'selected="selected"' : ''}}>
                                            家電
                                        </option>
                                        <option value="パソコン" {{ $productEntity->getGenre() == 'パソコン' ?  'selected="selected"' : ''}}>
                                            パソコン
                                        </option>
                                        <option value="スポーツ" {{ $productEntity->getGenre() == 'スポーツ' ?  'selected="selected"' : ''}}>
                                            スポーツ
                                        </option>
                                        <option value="音楽" {{ $productEntity->getGenre() == '音楽' ?  'selected="selected"' : ''}}>
                                            音楽
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">値段</label>
                                <div class="col-md-6">
                                    <input id="price" type="number" class="form-control" name="price" value="{{ $productEntity->getPrice() }}" required>

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">概要</label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" rows="5" name="description">{{ $productEntity->getDescription() }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group" role="group">
                                            <button type="submit" class="btn btn-success">
                                                更新
                                            </button>
                                            <a class="btn btn-primary" href="{{ route('product::index') }}" role="button">戻る</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
