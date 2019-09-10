<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // ----------------------------DB(table)の構成を書いていく----------------------------
    // DBの構成を変更したり、取り消したりすることができる（DBのバージョン管理）

    // -----------------------------upメソッド:行いたい処理-------------------------------
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
        //Schemaファサード:新しいデータベーステーブルを作成する
        //Schema::create([テーブル名], [Blueprintオブジェクトを受け取るクロージャ関数] ) 
        //       第１引数:テーブル名のtodos、
        //       第２引数:テーブル構造を定義するクロージャの指定
        // クロージャ  第１引数:Blueprintオブジェクト
        //   　　　　　第２引数:Blueprintインスタンスを受け取るクロージャを指定
        //Blueprintクラスのインスタンス化を$tableに格納　よって->でメソッド呼び出し 
        // Schemaファサードのtableメソッドを使用
        //  -----------------------テーブル構造を定義--------------------------   
            $table->increments('id');  //「符号なしINT」を使用した自動増分ID（主キー）
            $table->string('title');   //VARCHARカラム
            $table->timestamps();      //created,updateのcolumnの作成。作成更新の日時を自動管理
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // --------------------downメソッド:upメソッドの処理を元に戻すための処理------------------
    public function down()
    {
        Schema::dropIfExists('todos');
        // 存在するテーブルを削除する、dropかdropIfExistsメソッド
    }
}

// 完了後 php artisan migrateでマイグレーションを実行し、テーブル作成されたか確認
