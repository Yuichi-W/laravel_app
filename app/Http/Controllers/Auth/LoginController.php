<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;  // 追記

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $maxAttempts = 3;     // ログイン試行回数（回）
    // protected $decayMinutes = 2;   // ログインロックタイム（分）

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/todo'; 
    //redirectToプロパティー作成
    //redirectToプロパティーにLoginした後の遷移先を/todoをいれている

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // dd($this);  //LoginController{}　#redirectTo:"/todo"
        //LoginControllerクラスインスタンス化
        // dd($this->middleware('guest')); //ControllerMiddlewareOptions {} オブジェクト型
        // dd($this->middleware('guest')->except('logout'));  //CMO{#options: & array:1 []}
        // except" => array:1 [ 0 => "logout"]  配列>連想配列
        $this->middleware('guest')->except('logout');
        // $this->middleware('guest');
        //except():特定のメソッド以外の全て 逆に指定したいならonlyを使う
        //exceptで指定したコントローラーメソッドにはミドルウェアが設定されない
    }

    // ---------------------------logout処理--------------------------------
    // ログアウト後の遷移先を変更しなければならないのでここでオーバーライドする　logoutあるのがvenderより
    // classのメソッド  >  useしているtraitのメソッド > 継承しているclassのメソッド（メソッドの優先順位）
    protected function loggedOut(Request $request)
    {
        // dd($request); //Request{}
        return redirect('/login');
        // セッションを引き継いで次の画面につなげたいときなどにredirect()
        // redirect():指定先へリダイレクト
        //    第一引数：リダイレクト先のURL
        //    第二引数：HTTPステータスコードを指定　　デフォルト値は302
        //    第三引数：追加したい「HTTPヘッダー」を指定
        //    第四引数：true/falseリダイレクトURLに「https://」を使うかどうかを指定
    }
    // --------------------------------------------------------------------
}
