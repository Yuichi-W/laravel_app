<?php
// Controller作成コマンドに　--resourceつけたことによりresourceメソッドがTodoControllerにまとまった
// -------------------------modelの使用-------------------------------

namespace App\Http\Controllers;

// useはrequire()メソッドにような感じ。
use Illuminate\Http\Request;
use App\Todo;  
// ------------------------------------------------------------------
use Auth;  //ログインしているユーザーを Auth::id() という形で取得を可能にするために追記
// ------------------------------------------------------------------



class TodoController extends Controller
{
    private $todo;
    // privateはClass内でしか使用しない変数
    // private $todo;でTodoControllerクラスのインスタンスにtodoプロパティーをセット
    
    // Classのインスタンス化が行われた際に設定しておきたい値などを設定(初期値設定)する関数
    // どの処理でも毎回Modelをインスタンス化するので（共通すること）変数に代入してまとめている
    // 一番最初に実行される。
    
    public function __construct(Todo $instanceClass)
    {
        // ----------------------------------------------------------
        $this->middleware('auth');  // ログイン機能の追加項目 authは「認証」という意味
        // middlewareがauthだけ取得　つまり認証されてないのは取得されない// 認証済みのユーザのみが入れる
        // ----------------------------------------------------------
        // dd($this->middleware('auth')); //ControllerMiddlewareOptions {}
        // __construct(1,2):1でクラス受け取り
        //                  2でクラスのインスタンス化を代入 
        // dd($instanceClass);
        $this->todo = $instanceClass;
        // dd($this);　　$thisはprivate $todo;を指している
        // $this->todoつまりTodoControllerのtodoにインスタンス化したTodoクラス（インスタンス化したModel）を格納している
        // $this->todoに格納する理由：ファイル内の他のメソッドで使用するため。その為この関数の外でprivate $todo;でtodoプロパティーをセットしている
    }
    // --------------------------------------------------------------
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ----------------------------------------------------------
        $todos = $this->todo->getByUserId(Auth::id());  // 追記
        // ----------------------------------------------------------
        $user = Auth::user();
        // dd($user);
        // dd($this->todo->getByUserId(Auth::id()));  //Collection {#items:array}idに紐づいたtodoリスト
        // dd($this); //TodoContoroller{}インスタンス
        // dd($this->todo);  //Todo{} Controllerインスタンス内のtodo(model)インスタンスのこと
        // ----------------------------------------------------------
        // $todos = $this->todo->all();  //削除部分　全件取得より全部表示されてしまっていた
        // ----------------------------------------------------------
        // all():DBのから全件取得。つまりSELECT * FROM todos;のこと。
        // 返り値：Collectionインスタンスで返す　collection{#items:array[]}
        // dd($todos); //Collection{} item: array
        // dd(compact('todos'));
        // dd(view('todo.index', compact('todos'))); //View{}
        return view('todo.index', compact('todos','user'));  
        // return view('todo.index', ['neko' => $todos]);  
        // view():Controllerで特定のViewを表示させたいときに使用
        //   第一引数:resources/viewsディレクトリ内のviewファイル名
        //   第二引数:view側で使用するデータの配列
        // compact():ContorollerからViewへの変数の受け渡し
        // view側で変数を使用することが可能になる
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ----------------------Viewの表示が行えるように編集を行う-------------------------
    public function create()
    {
        //
        return view('todo.create'); 
        // viewディレクトリ内のviewファイル。todo.createにリダイレクト
        // create.blade.phpファイルを表示　返り値はView{}インスタンス
        // 特定のViewを表示させたいときに使用
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  ---------------------DBにデータを格納するための処理を行う------------------------
    public function store(Request $request)
    {
        $input = $request->all();
        // ------------------------------------------------------------------------
        $input['user_id'] = Auth::id();  // 追記
        // ------------------------------------------------------------------------
        // $requestから（postで渡された値（文字列））全て「配列」として受け取る。
        // dd($request);  //Requestクラスインスタンス　Request{}
        // dd($input);                        //[token => 40文字の文字列 title => 入力した文字列]
        // dd($this->todo);  　　　　　　　　//Todo{} Controllerインスタンス内のtodo(model)インスタンスのこと
        // dd($this->todo->fill($input)); //fillの引数の[title => 入力した文字列]をthis->todoに追加fillableがtitleなのでtokenはなし
        $this->todo->fill($input)->save();
        // fill():引数を設定できるかどうかを確認してくれる$fiillableを参照している
        // save():レコード新規作成, 更新ができる保存
        return redirect()->route('todo.index');
        // 処理が終わったらtodoページにリダイレクト（転送）。
        // ->toは可読性高めている。なくてもいい

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //  -------------------メソッドを通してTodoの更新を行います。----------------------
    public function edit($id)
    {
        // edit($id)はURLのパラメータの取得のための記述
        $todo = $this->todo->find($id);  
        // SELECT * FROM todos WHERE　id= $id; 
        // find():主キー値で指定した行を取得します。id=指定id のレコードを抽出 返り値はModelインスタンスTodo{}
        // これにより指定のデータのみ取得することが可能になり、編集画面に一覧で選択したtitleを表示し更新を可能にします。
        // dd(compact('todo')); //[todos => Todo{}]
        // dd(view('todo.edit', compact('todo'))); //View{}
        return view('todo.edit', compact('todo'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // ------------------------メソッドが更新のメイン処理----------------------------
    public function update(Request $request, $id)
    {
        // dd($request); //Requestインスタンス。 Request{}
        // dd($id);  //更新を選択したid番号 1
        $input = $request->all();
        // dd($request->all());  //array3[method=>PUT,token=>40文字,title=>記入文字]
        // dd($this->todo);      //Todo{} Controllerインスタンス内のtodo(model)インスタンスのこと
        // dd($this->todo->find($id));  //id=指定id のレコードを抽出しtodo{}内に格納
        // $requestから（putで渡された値(method,token,title)（文字列））全て「配列」として受け取る。
        // dd($this->todo->find($id)->fill($input));　title抜き出す
        $this->todo->find($id)->fill($input)->save();
        // UPDATE todos SET title = :title WHERE id = :id';
        // find():主キー値で指定した行を取得します。id=指定id のレコードを抽出 返り値はModelインスタンスTodo{}
        // save():テーブルに新しいレコードを挿入
        return redirect()->route('todo.index');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //  ----------------------物理削除。よってメソッドの処理が行われたら、DBから完全に削除-------------------------
    public function destroy($id)
    {
        // dd($this->todo);         //Todo{}
        // dd($this->todo->find($id)); //id=指定id のレコードを抽出しtodo{}内に格納
        $this->todo->find($id)->delete();
        // find():主キー値で指定した行を取得します。id=指定id のレコードを抽出 返り値はModelインスタンスTodo{}
        // delete():モデル削除
        // return redirect()->route('todo');
        return redirect()->route('todo.index');
        // 処理として、find で検索し、delete で削除という流れになります。
        // どっちもやってることは同じ、だがURIが長くなった時は毎回描くの大変、そしてroute nameは自分で決めることできるから楽。今回はresourceで７個いっぺんに生成したけども
    }
}
