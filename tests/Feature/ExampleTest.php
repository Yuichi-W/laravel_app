<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     * @test  // 追記
     * @return void
     */
    public function basicTest()
    {
        $response = $this->get('/');
        // $this->get('/'):getリクエストで引数のURIにアクセス。その結果の返り値を $response に格納

        $response->assertStatus(200);
        // リクエスト結果のステータスを確認
        // assertStatus:responceのstatusには()内の値を期待する 
        // ()内の指定の数値以外は、全てが異常系という扱い
        // つまり、問題なくhttp通信でのGETリクエストが問題なく行われているかどうかのテストを行なっている
    }
}
