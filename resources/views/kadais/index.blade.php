@extends('layouts.app')

@section('content')

<h1>課題一覧</h1>

    @if (count($kadais) > 0)
        <ul>
            @foreach ($kadais as $kadai)
                <li>{!! link_to_route('messages.show', $message->id, ['id' => $message->id]) !!} : {{ $message->content }}</li>
            @endforeach
        </ul>
    @endif
    {!! link_to_route('messages.create', '新規メッセージの投稿') !!}
@endsection