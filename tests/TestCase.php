<?php
// どこかで問題が起きても取り消せる状態を定義
// CreateApplication.php以外の DB に対しての挿入・更新の一連の処理をテストが終わった際になかったことにしテスト用のDB を綺麗な状態に保つため

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setup()
    {
        parent::setup();
        $this->prepareForTests();
        // parent::setup(); 必須理由は、このclassが継承している BaseTestCase に記載があるメソッドを使用しますよという宣言
        // setup という名称になっている理由も継承元のメソッドを使う際は、同じ名称にしなければならないというルールだから
        // このメソッドはなんのためのメソッドかというとテストを実行する前に行いたい処理をまとめるメソッド
        // 仮に parent::setup(); を書いていなかったら動かない。

        // $this->prepareForTests();: tests/CreateApplication.phpのprepareForTests というメソッドを指している
    }
}
