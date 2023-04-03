<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;// ★ Authクラスをインポートする
use App\Http\Requests\CreateFolder; // ★ 追加
use App\Folder; // ★ この行を追記！
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // CreateFolderはクラス型、requestとは違いバリデーションチェックをして値を返すことができる
    public function create(CreateFolder $request)
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する

        // ★ ユーザーに紐づけて保存
        Auth::user()->folders()->save($folder);

        $folder->title = $request->title;
        // インスタンスの状態をデータベースに書き込む
        $folder->save();

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}