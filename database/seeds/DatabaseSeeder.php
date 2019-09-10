<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // -----------作成したTodosTableSeeder.phpを実行しデータの投入が可能になる-------------
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(TodosTableSeeder::class); //追記部分
        // call():DatabaseSeederクラスの中で追加のシーダークラスを呼び出す
    }
}
// 変更が完了したら作成したfileをDBに反映させるためのコマンド　php artisan db:seed　を実行