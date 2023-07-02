<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use App\Models\Like;
use App\Models\Post;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;

class CleanderController extends Controller
{
    private $registerFormItems = ["email", "name", "password", "password_confirmation"];
    private $taskItems = ["name", "span", "cycle", "memo"];
    private $postItems = ["image", "cat", "body"];

    private $registerValidator = [
        "email" => "required|email|max:100|unique:users",
        "name" => "required|max:10",
        "password" => "required|confirmed|max:30",
        "password_confirmation" => "required",
    ];

    private $resetValidator = [
        "password" => "required|confirmed|max:30",
        "password_confirmation" => "required",
    ];
    private $taskValidator = [
        "name" => "required|max:20",
        "span" => "required",
        "cycle" => "required",
        "memo" => "max:1000",
    ];
    private $postValidator = [
        "image" => "mimes:jpg,png,jpeg",
        "cat" => "required",
        "body" => "required|max:1000",
    ];

    private $message = [
        'name.required' => '名前は入力必須項目です',
        'name.max' => '名前は10文字以内で入力してください',
        'email.required' => 'メールアドレスは入力必須項目です',
        'email.max' => 'メールアドレスは10文字以内で入力してください',
        'email.email' => 'メールアドレス形式が正しくありません',
        'email.unique' => '入力されたメールアドレスは既に登録されています',
        'password.required' => 'パスワードは入力必須項目です',
        'password.confirmation' => '入力されたパスワードが一致しません',
        'password_confirmation.required' => 'パスワードは入力必須項目です',
    ];
    private $taskMessage = [
        'name.required' => 'タスク名は入力必須項目です',
        'name.max' => 'タスク名は10文字以内で入力してください',
        'span.required' => '期間は入力必須項目です',
        'cycle.required' => '期間単位は入力必須項目です',
        'memo.required' => 'メモは1,000文字以内で入力してください',
    ];
    private $postMessage = [
        'image.required' => 'タスク名は入力必須項目です',
        'name.max' => 'タスク名は10文字以内で入力してください',
        'span.required' => '期間は入力必須項目です',
        'cycle.required' => '期間単位は入力必須項目です',
        'memo.required' => 'メモは1,000文字以内で入力してください',
    ];

    public function register(Request $request) {

        return view('util.register');
    }

    public function login(Request $request) {
        return view('util.login');
    }

    public function loginValidate(Request $request) {
        $user = User::where('email', $request->email)->get();
        if (count($user) === 0){
            return view('util.login', ['login_error' => '1']);
        }
        // 一致
        if (Hash::check($request->password, $user[0]->password)) {

            // セッション追加
            session(['name'  => $user[0]->name]);
            session(['id' => $user[0]->id]);

            return redirect(url('/task'));
        // 不一致
        }else{
            return view('util.login', ['login_error' => '1']);
        }
    }

    public function logout(Request $request) {
        session()->forget('name');
        session()->forget('id');
        return redirect(url('/login'));
    }

    public function registerValidate(Request $request) {
        $validator = Validator::make($request->only($this->registerFormItems), $this->registerValidator, $this->message);

          if ($validator->fails()) {
            return redirect()->action("CleanderController@register")
            ->withErrors($validator)
            ->withInput();
          } else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user = User::where('email', $request->email)->get();
            session(['name' => $user[0]->name]);
            session(['id' => $user[0]->id]);
            return redirect()->action('TaskController@task');
          }
    }

     public function resetForm() {
        $token = Str::random(12);
        return view('util.resetForm', 'token');
    }

    public function resetPost(Request $request) {
        $exists = User::where("email", $request->email)->exists();
        if($exists) {
			PasswordReset::create([
				"email" => $request->email,
				"token" => $request->token,
			]);
			$url = "http://localhost/reset?token={$request->token}";
			$email = 'test@example.com';

			Mail::send('util.resetMail', [
                'url' => $url,
			], function ($message) use ($email) {
				$message->to($email)
					->subject('パスワードリセットのご案内');
			});
            return view('util.sendResetForm');
        }else {
			return view('util.sendResetForm');
        }

    }


    public function reset(Request $request) {
        $result = PasswordReset::Where("token", $request->token)->get();
        $now = new DateTime();
        // "Y-m-d H:i:s"
        $diff = $now->diff($result);
        if($diff->d < 1 ) {
            return view('util.reset', compact('result'));
        }
            return redirect()->action('/login');

    }
    public function resetValidate(Request $request) {
        $validator = Validator::make($request, $this->resetValidator, $this->message);

        if ($validator->fails()) {
            return redirect()->action("CleanderController@reset")
            ->withErrors($validator)
            ->withInput()->with($request->result);
        } else {
            $user = User::where("email", $request->result->email)->get();
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            session(['name' => $user[0]->name]);
            session(['id' => $user[0]->id]);
            return redirect()->action('TaskController@task');
        }
    }

    public function showUsers(Request $request) {
        $user = $request->id;
        if($user < 100000) {
            $users = User::All();
            return view('util.users', compact('users'));
        }else {
            return redirect()->action("PostController@timeline");
        }

    }

    public function userDelete(Request $request) {
        $userid = session('id');
        $id = $request->input('targetid');
        if($userid < 100000) {
            User::where('id', $id)->delete();
            return $id;
        }

    }

    public function timeline(Request $request) {
        $posts = Post::select([
            'p.id',
            'p.image',
            'p.body',
            'p.created_at',
            'u.name',
            'c.category',
        ])
        ->from('posts AS p')
        ->JOIN('users AS u', 'p.userid', '=', 'u.id')
        ->JOIN('categories AS c', 'p.category', '=', 'c.id')
        ->orderBy('p.id', 'desc')
        ->paginate(10);
        $sort = $request->sort;
        $liked = Like::All();
        return view('timeline.timeline', compact('posts','sort', 'liked'));
    }
    public function like(Request $request) {
        if ( $request->input('likeflg') == 0) {
            //ステータスが0のときはデータベースに情報を保存
            Like::create([
                'postid' => $request->input('postid'),
                 'userid' => session('id'),
            ]);
           //ステータスが1のときはデータベースに情報を削除
        } elseif ( $request->input('likeflg')  == 1 ) {
            Like::where('postid', $request->input('postid'))
               ->where('userid', session('id'))
               ->delete();
        }
        return  $request->input('likeflg');
    }

    public function likedPost(Request $request) {
        $userid = session('id');
        $posts = Post::select([
            'p.id',
            'p.image',
            'p.body',
            'p.created_at',
            'u.name',
            'c.category',
            'p.userid',
        ])
        ->from('posts AS p')
        ->JOIN('users AS u', 'p.userid', '=', 'u.id')
        ->JOIN('categories AS c', 'p.category', '=', 'c.id')
        ->JOIN('likes AS l', 'p.id', '=', 'l.postid')
        ->where('l.userid', $userid)
        ->orderBy('l.id', 'desc')->paginate(10);
        $sort = $request->sort;
        return view('timeline.likedPost', compact('posts', 'sort'));
    }

    public function newPost() {
        $categories = Category::All();
        return view('timeline.newPost', compact('categories'));
    }

    public function userPost(Request $request) {
        $userid = session('id');
        $posts = Post::select([
            'p.id',
            'p.image',
            'p.body',
            'p.created_at',
            'u.name',
            'c.category',
            'p.userid',
        ])
        ->from('posts AS p')
        ->JOIN('users AS u', 'p.userid', '=', 'u.id')
        ->JOIN('categories AS c', 'p.category', '=', 'c.id')
        ->where('u.id', $userid)
        ->orderBy('p.id', 'desc')->paginate(10);
        $sort = $request->sort;
        $liked = Like::where('userid', $userid)->get();
        return view('timeline.userPost', compact('posts', 'sort', 'liked'));
    }

    public function postValidate(Request $request) {
        $validator = Validator::make($request->only($this->postItems), $this->postValidator, $this->postMessage);

        if ($validator->fails()) {
          return redirect()->action("PostController@newPost")
          ->withErrors($validator)
          ->withInput();
        } elseif($request->image == "") {

          Post::create([
              'image' => '',
              'userid' => session('id'),
              'category' => $request->cat,
              'body' => $request->body,
          ]);
          return redirect()->action('PostController@postUplode');
        }else {
            $dir = 'postImage';

            // アップロードされたファイル名を取得
            $fileName = $request->image->getClientOriginalName();
            $date = now()->format('Ymdhis');
            $userid = session('id');
            $saveName = $date. $userid. $fileName;

            // 取得したファイル名で保存
            $request->file('image')->storeAs('public/' . $dir, $saveName);

            Post::create([
                'image' => 'storage/' . $dir . '/' . $saveName,
                'userid' => session('id'),
                'category' => $request->cat,
                'body' => $request->body,
            ]);
            return redirect()->action('CleanderController@postUplode');
        }
    }

    public function postUplode(Request $request) {
            return view('timeline.postUplode');
    }

    public function postDelete(Request $request) {
        $id = $request->input('postid');
        if($request->input('name') == session('name') ){
            Post::where('id', $id)->delete();
            return $data = 0;
        }
        return $data = 1;
    }

    public function sharePost(Request $request) {
        $getid = $$request->input('id');
        $postid = decrypt($getid);
        $post = Post::select([
            'p.id',
            'p.image',
            'p.body',
            'p.created_at',
            'u.name',
            'c.category',
            'p.userid',
        ])
        ->from('posts AS p')
        ->JOIN('users AS u', 'p.userid', '=', 'u.id')
        ->JOIN('categories AS c', 'p.category', '=', 'c.id')
        ->where('p.id', $postid);
        $likes = Like::all();
        return view('timeline.sharePost', compact('post', 'likes'));
    }

    public function task(Request $request) {
        $tasks = Task::where('userid', session('id'))->orderBy('run', 'asc')->get();
        foreach($tasks as $task) {
            $runtime = date("Y-m-d", strtotime($task->cycle));
            $now = now()->format('Y-m-d');
            if($now < $runtime) {
                $task->cycle = (strtotime($runtime) - strtotime($now)) / (60 * 60 * 24) . "日後";
            }else {
                $task->cycle = "実行時期です！";
            }
        }
        return view('task.task', compact('tasks'));
     }
    public function taskRun(Request $request) {
        Task::where('id', $request->id)->update([
            'run' => now()->format('Y-m-d'),
        ]);
        return redirect()->action('CleanderController@task');
     }

     public function newTask(Request $request) {
         return view('task.newTask');
     }
     public function taskValidate(Request $request) {
        $validator = Validator::make($request->only($this->taskItems), $this->taskValidator, $this->taskMessage);

        if ($validator->fails()) {
          return redirect()->action("CleanderController@newTask")
          ->withErrors($validator)
          ->withInput();
        }else {
            Task::create([
                'userid' => session('id'),
                'name' => $request->name,
                'cycle' => $request->span." ".$request->cycle,
                'memo' => $request->memo,
                'run' => now()->format('Y-m-d'),
            ]);
            return redirect()->action("CleanderController@task");
        }
    }

    public function taskZoom(Request $request) {
        $id = $request->input('id');
        $task = Task::where('id', $id)
        ->where('userid', session('id'))->get();
        return view('task.taskZoom', compact('task'));
    }

    public function taskValidateU(Request $request) {
        $validator = Validator::make($request->only($this->taskItems), $this->taskValidator, $this->taskMessage);

        if ($validator->fails()) {
          return redirect()->action("CleanderController@newTask")
          ->withErrors($validator)
          ->withInput();
        }else {
            Task::where('id', $request->id)->update([
                'name' => $request->name,
                'cycle' => $request->span." ".$request->cycle,
                'memo' => $request->memo,
            ]);
            return redirect()->action("CleanderController@task");
        }

    }

    public function taskDelete(Request $request) {
        $id = $request->input('id', '0');
        Task::where('id', $id)->delete();
        return redirect()->action("CleanderController@task");
    }
}
