@extends('layouts.app')

@section('content')

 <h1>id = {{ $kadai->id }} のタスク詳細ページ</h1>

     <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $kadai->id }}</td>
        </tr>
        <tr>
            <th>ステータス</th>
            <td>{{ $kadai->status}}</td>
        </tr>
        <tr>
            <th>タスク</th>
            <td>{{ $kadai->content }}</td>
        </tr>
    </table>
    
  {!! link_to_route('kadais.edit', 'このタスクを編集', ['id' => $kadai->id], ['class' => 'btn btn-default']) !!}
    
    {!! Form::model($kadai, ['route' => ['kadais.destroy', $kadai->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection