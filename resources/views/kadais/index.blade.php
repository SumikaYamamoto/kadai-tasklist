@extends('layouts.app')

@section('content')

@if (Auth::check())
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

 @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Kadais</h1>
                {!! link_to_route('signup.get', 'Sign up now!', null, ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection