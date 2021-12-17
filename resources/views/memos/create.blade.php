@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
        <h1>メモ新規作成ページ</h1>

        <div class="row">
            <div class="col-6">
                {!! Form::model($memo, ['route' => 'memos.store']) !!}
                
                    <div class="form-group">
                        {!! Form::label('status','タイトル:') !!}
                        {!! Form::text('status',null,['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('content', '内容:') !!}
                        {!! Form::text('content', null, ['class' => 'form-control']) !!}
                    </div>
    
                    {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}
    
                {!! Form::close() !!}
            </div>
        </div>

@endsection