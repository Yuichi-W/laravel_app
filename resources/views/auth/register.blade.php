@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                <!-- ------------------------------------------フォーム開始------------------------------------------------ -->
                    <form method="POST" action="{{ route('register') }}">　
                        @csrf
                        <!-- ['route' => 'ルーティング名'] -->
                        <!-- POSTでRegisterよりRegisterController@registerの処理が実行 -->
                        <!-- ------------------------------------------------------------------------------------- -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <!-- __()ヘルパ関数: 翻訳テキストを取得　翻訳文字列のファイルとキーを受け付ける-->
                            <!-- 第一引数：[必須]翻訳キーを指定 -->
                            <!-- 第二引数：プレースホルダが含まれている場合、置換する値(配列)を指定 -->
                            <!-- 第三引数：言語を指定 -->

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                        <!-- ------------------------------------------------------------------------------------- -->

                        <!-- ------------------------------------------------------------------------------------- -->
                                @if ($errors->has('name'))
                                <!-- hasメソッド:リクエストに値が存在する場合に、trueを返す。 -->
                                <!-- $errors->has('name'):エラーの存在チェック -->
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                        <!-- $errors->first('name') :特定のエラーの取得 配列形式で結果が返ってくるからfirstで最初を指定-->
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- ------------------------------------------------------------------------------------- -->

                        <!-- ------------------------------------------------------------------------------------- -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        <!-- ------------------------------------------------------------------------------------- -->

                        <!-- ------------------------------------------------------------------------------------- -->
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- ------------------------------------------------------------------------------------- -->

                        <!-- ------------------------------------------------------------------------------------- -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- ------------------------------------------------------------------------------------- -->

                        <!-- ------------------------------------------------------------------------------------- -->
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <!-- ------------------------------------------------------------------------------------- -->

                        <!-- ------------------------------------------------------------------------------------- -->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        <!-- ------------------------------------------------------------------------------------- -->
                    </form>
                <!-- --------------------------------------------------------------------------------------------- -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
