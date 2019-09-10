<?php
// アプリケーションで新しいユーザーのバリデーションと作成に責任を持っている

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //----------------------------トレイトしたのを呼び出し------------------------------
    use RegistersUsers;   //コードを再利用  extendsと同様にトレイトのメンバを引き継ぐことができる
    //------------------------------------------------------------------------------

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // -------------------------------------------------------------------------
    // -------------------------バリデーションのルール------------------------------
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            ]);
            // email: メールアドレスの形式であるかどうか
            // unique: フィールドは指定されたデータベーステーブルで一意であることをバリデート
            // confiremed: 確認用として入力した値が一致しているかを検証

            // Validator::make()
            // 第一引数は、バリデート対象のフィールドを配列で記述、
            // 第二引数は、ルールを配列で記述、
            // 第三引数は、それぞれルールに対応したメッセージを任意で指定、指定がなければlang/{言語}/validate.php内のものが代入されます。
            // 第四引数は、バリデートメッセージ内の属性を任意に変更できます
    }
    // バリデータ：フォームに入力されたデータなどの「あるデータ」が、「指定されたルール」に適合しているかをチェックする仕組み
    // 送信結果画面には進まずに（元のページのURLのまま）,適切な場所にエラーが表示され,入力した値が入った状態で元のフォームが表示
    // -------------------------------------------------------------------------
        
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    // -----------------------DBに登録している-----------------------------
    protected function create(array $data)
    {
    //dd($data);   array:5 ["_token" => "" "name" => "" "email" => "" "password" => "" "password_confirmation" => ""]
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    // -----------------------------------------------------------------
}
