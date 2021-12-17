@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
    <h1>id = {{ $memo->id }} のメモ詳細ページ</h1>
    
        <table class="table table-bordered">
            <tr>
                <th>id</th>
                <td>{{ $memo->id }}</td>
            </tr>
            <tr>
                <th>タイトル</th>
                <td>{{ $memo->status }}</td>
            </tr>
            <tr>
                <th>内容</th>
                <td>{{ $memo->content }}</td>
            </tr>
    </table>
    
    {{-- メッセージ編集ページへのリンク --}}
    {!! link_to_route('memos.edit', 'このメッセージを編集', ['memo' => $memo->id], ['class' => 'btn btn-light']) !!}

    {{-- メッセージ削除フォーム --}}
    {!! Form::model($memo, ['route' => ['memos.destroy', $memo->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection