@extends ('layouts.app') <!-- layoutsフォルダ内のappファイル継承してるという意味 -->
@section ('content') <!-- 継承したappファイルの@yield('content')の部分に下記を入れる -->

<h2 class="mb-3">ToDo編集</h2>
{!! Form::open(['route' => ['todo.update', $todo->id], 'method' => 'PUT']) !!} 
<!-- todo.updateに対して、$todoのidを指定し、PUT(データの更新)で送る -->
  <div class="form-group">
    {!! Form::input('text', 'title', $todo->title, ['required', 'class' => 'form-control']) !!} 
  </div>
  {!! Form::submit('更新', ['class' => 'btn btn-success float-right']) !!} 
{!! Form::close() !!} 

@endsection
