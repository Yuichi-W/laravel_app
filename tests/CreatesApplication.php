<?php
// migration、seed を記述
namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Artisan; // Artisan コマンドを使えるようにする
use App\Todo; // modelに当たる App/Todo.php を使用できるようにし table への操作を行う為

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

     // ---------------------------ここから追記-----------------------------
     //  prepareForTests()は　DBへのmigrateとseed を行なっている
     //  つまりテスト用のdefaultのデータとtableの作成を行なっている
     public function prepareForTests()
     {
         Artisan::call('migrate');
         if(!Todo::all()->count()){
             Artisan::call('db:seed');
            }
        }
    // Todotableに対してテストを実行する毎に seedを行う必要がないので
    // Todotableにデータが存在しているかの記述を加えてる。もし存在してなければ seed が走る
    // ---------------------------ここまで追記-----------------------------
}
