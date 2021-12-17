<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Memo; //追加

class MemosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $memos = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            $query = $user->memos()->orderBy('created_at', 'desc');
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query = $query->where('status', 'like', '%' . $keyword . '%');
            }
            // タスクの一覧を作成日時の降順で取得
            $memos = $query->paginate(10);
            }
        

        // タスク一覧ビューでそれを表示
        return view('memos.index', [
            'memos' => $memos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $memo = new Memo;
        
        
        // タスク作成ビューを表示
        return view('memos.create',[
            'memo' => $memo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'status' => 'required|max:200',  //追加
           'content' => 'required|max:2000', 
        ]);
        
        // タスク作成
        $memo = new Memo;
        $memo->status = $request->status;  //追加
        $memo->content = $request->content;
        $memo->user_id = \Auth::id();  //追加
        $memo->save();
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // idの値でメッセージを検索して取得
        $memo = Memo::findOrFail($id);
        //タスクを保有しているユーザーかチェック
        if ($memo->user_id == \Auth::id()){
            // メッセージ詳細ビューでそれを表示
            return view('memos.show', [
                'memo' => $memo,
            ]);
        }else{
            // トップページへリダイレクトさせる
            return redirect('/');            
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // idの値でタスクを検索して取得
        $memo = Memo::findOrFail($id);
        
        //タスクを保有しているユーザーかチェック
        if ($memo->user_id == \Auth::id()){
            // メッセージ詳細ビューでそれを表示
            return view('memos.edit', [
                'memo' => $memo,
            ]);
        }else{
            // トップページへリダイレクトさせる
            return redirect('/');            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'status' => 'required|max:200',
            'content' => 'required|max:2000',
        ]);
        
        // idの値でタスクを検索して取得
        $memo = Memo::findOrFail($id);
        
        
        //タスクを保有しているユーザーかチェック
        if ($memo->user_id == \Auth::id()){
            // タスクを更新
            $memo->content = $request->content;
            $memo->status = $request->status;
            $memo->save();
        }

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // idの値でメッセージを検索して取得
        $memo = Memo::findOrFail($id);
        //タスクを保有しているユーザーかチェック
        if ($memo->user_id == \Auth::id()){
            // メッセージを削除
            $memo->delete();
        }

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
