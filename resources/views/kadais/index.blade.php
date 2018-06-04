@extends('layouts.app')

@section('content')

<h1>タスク一覧</h1>

    @if (count($kadais) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>ステータス</th>
                    <th>タスク</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kadais as $kadai)
                    <tr>
                        <td>{!! link_to_route('kadais.show', $kadai->id, ['id' => $kadai->id]) !!}</td>
                        <td>{{ $kadai->status }}</td>
                        <td>{{ $kadai->content }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
 {!! link_to_route('kadais.create', '新規タスクの投稿', null, ['class' => 'btn btn-primary']) !!}
@endsection