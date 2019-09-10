<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // ----------シーダ（初期値設定）クラスを使用し、テストデーターをデーターベースに設定-----------
    public function run()
    {
        //
        DB::table('todos')->truncate(); //全件削除
        DB::table('todos')->insert([    //初期値追加。insert():複数レコードを一気に格納可能
            [
                'title'      => 'Laravel Lesson終わらせる',
                'created_at' => Carbon::create(2018, 1, 1),
                'updated_at' => Carbon::create(2018, 1, 4),
                //CarbonとはPHPで使える日付操作のライブラリ。Laravelには標準装備されています。
                //Carbon::create 日時を作成
                //Carbonは日付関連操作を便利にしてくれるパッケージのこと
            ],
            [
                'title'      => 'レビューに向けて理解を深める',
                'created_at' => Carbon::create(2018, 2, 1),
                'updated_at' => Carbon::create(2018, 2, 5),
            ],
        ]);
    }
}
// 完了したらDatabaseSeeder.phpのrunで実行できるようにする
