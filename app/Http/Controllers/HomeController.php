<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    //「__construct()」はクラスが呼ばれたら自動で最初に実行される。
    //「$this->middleware('auth');」 は「認証していたら表示」という処理。ログイン認証してなければ非表示になります。
    // また、この1行をコメントアウトすると「ログイン認証」してなくても表示されます。 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home'); 
    }
}
