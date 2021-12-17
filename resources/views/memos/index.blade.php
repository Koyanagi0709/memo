@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
    
    @if (Auth::check())
    <div class="row">
    <div class="col-6">
    {{ Form::open(['method' => 'get']) }}
    {{ csrf_field() }}
    <div class='form-group'>
        {{ Form::label('keyword', 'タイトル検索') }}
        {{ Form::text('keyword', null, ['class' => 'form-control']) }}
    </div>
    <div class='form-group'>
        {{ Form::submit('検索', ['class' => 'btn btn-outline-primary'])}}
        <a href="/" class="btn btn-outline-primary">クリア</a>
    </div>
    </div>
    </div>
    {{ Form::close() }}
    
        <h1>メモ一覧</h1>
        

   @if (count($memos) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>タイトル</th>
                        <th>内容</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($memos as $memo)
                    <tr>
                        {{-- メモ詳細ページへのリンク --}}
                        <td>{!! link_to_route('memos.show', $memo->id, ['memo' => $memo->id]) !!}</td>
                        //@if (strlen($memo->status)>30)
                        <td>{{ mb_strimwidth($memo->status, 0, 30, '…') }}</td>
                        //@endif
                        //@if (strlen($memo->status)<30)
                        //<td>{{ $memo->status }}</td>
                        //@endif
                        //@if (strlen($memo->content)>40)
                        <td>{{mb_strimwidth($memo->content, 0, 40, '…')}}</td>
                        //@endif
                        //@if (strlen($memo->content)<40)
                        //<td>{{ $memo->content }}</td>
                        //@endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
       
       

        {{-- メモ作成ページへのリンク --}}
        {!! link_to_route('memos.create', '新規メモの投稿', [], ['class' => 'btn btn-primary']) !!}

    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>メモ帳へようこそ！</h1>
                {{-- ユーザ登録ページへのリンク --}}
                    {!! link_to_route('signup.get', 'ユーザー登録', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection