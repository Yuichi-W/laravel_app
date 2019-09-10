<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Modelはデータベースとやりとりを行うクラス
class Todo extends Model
{
    protected $fillable = [
        'title',
        'user_id'  // 追記
    ];
    // protectedこのクラスと、サブクラスからしかアクセスできない
    // $fillable:レコードを追加して良いカラムを設定 (ホワイトリスト)
    // セキュリティリスクがあるため複数代入をするときは$fillable使用
    
    // ----------------------ここから-------------------------
    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }
    // --------------------ここまで追記------------------------
    // 保存することが可能になり、またユーザーに紐づいたデータ取得のための記述
}
