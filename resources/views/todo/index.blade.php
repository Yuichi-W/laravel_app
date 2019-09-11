@extends ('layouts.app') <!-- layoutsフォルダ内のappファイル継承してるという意味 -->
@section ('content') <!-- 継承したappファイルの@yield('content')の部分に下記を入れる -->

<h1 class="page-header">ToDo一覧</h1>
<p class="text-right">
  <a class="btn btn-success" href="/todo/create">新規作成</a>
</p>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th>やること</th>
      <th>作成日時</th>
      <th>更新日時</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <!-- dd($todos)  Collection{items:array[]} -->
    @foreach ($todos as $todo)
      <tr>
        <td class="align-middle">{{ $todo->id }}</td>
        <td class="align-middle">{{ $todo->title }}</td>
        <td class="align-middle">{{ $todo->created_at }}</td>
        <td class="align-middle">{{ $todo->updated_at }}</td>
        <td><a class="btn btn-primary" href="{{ route('todo.edit', $todo->id) }}">編集</a></td>
        <!-- route():第一引数＝nameURI指定で生成/ 第二引数＝組み込みたい値 -->
        <td>
          {!! Form::open(['route' => ['todo.destroy', $todo->id], 'method' => 'DELETE']) !!}
          <!-- todo.destroyに対して$todoのidを指定し、DELETEで送る -->
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}
          <!--  -->
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection <!-- section ('content')の終わり -->