@extends ('layouts.app') <!-- layoutsフォルダ内のappファイル継承してるという意味 -->
@section ('content') <!-- 継承したappファイルの@yield('content')の部分に下記を入れる -->

<h2 class="mb-3">ToDo作成</h2>
{!! Form::open(['route' => 'todo.store']) !!} <!-- ['route' => 'ルーティング名'] action属性の部分-->
<!-- open:フォームにCSRFトークンを隠しフィールドとして追加
          ルートにCSRFフィルターを適用するように指示します。 -->
  <div class="form-group">
    {!! Form::input('text', 'title', null, ['required', 'class' => 'form-control', 'placeholder' => 'ToDo内容']) !!} 
    <!-- Form::input() 入力フィールドを作成
              第一引数：$type - (必須) 入力タイプ "text", "password", "file"など
              第二引数：$name - (必須) フィールド名
              第三引数：$value - (オプション) 入力フィールドの値（初期値）を指定
              第四引数：$options - (オプション) 追加したいフィールド属性を配列で指定。 "id", "size", "class"など
    -->
  </div>
  {!! Form::submit('追加', ['class' => 'btn btn-success float-right']) !!} 
  <!-- Form::submit() Bladeテンプレートでボタンを作成
            第一引数：Value
            第二引数：属性　配列で指定する必要あり
  -->
{!! Form::close() !!} <!-- 作成したフォームを閉じ -->

@endsection


