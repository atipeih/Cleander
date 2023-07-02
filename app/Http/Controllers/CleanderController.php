<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetMail;
use DateTime;
use Illuminate\Database\Eloquent\Collection;

class CleanderController extends Controller
{
    private $registerFormItems = ["email", "name", "password", "password_confirmation"];
    private $resetFormItems = ["password", "password_confirmation"];

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

    private $message = [
        'name.required' => '名前は入力必須項目です',
        'name.max' => '名前は10文字以内で入力してください',
        'email.required' => 'メールアドレスは入力必須項目です',
        'email.max' => 'メールアドレスは10文字以内で入力してください',
        'email.email' => 'メールアドレス形式が正しくありません',
        'email.unique' => '入力されたメールアドレスは既に登録されています',
        'password.required' => 'パスワードは入力必須項目です',
        'password.confirmed' => '入力されたパスワードが一致しません',
        'password_confirmation.required' => 'パスワード確認は入力必須項目です',
    ];

    public function register(Request $request) {

        return view('util.register');
    }

    public function login(Request $request) {
        if(session()->has('id')){
            return redirect()->action('TaskController@task');
        }
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
        return view('util.resetForm', ['token' => $token]);
    }

    public function resetPost(Request $request) {
        $exists = User::where("email", $request->email)->exists();
        if($exists) {
			PasswordReset::create([
				"email" => $request->email,
				"token" => $request->token,
			]);
			$url = "http://localhost:8888/reset?token={$request->token}";
			$email = $request->email;

            Mail::to($email)->send(new ResetMail($url));
            return view('util.sendResetMail');
        }else {
			return view('util.sendResetMail');
        }

    }

    public function reset(Request $request) {
        $result = PasswordReset::Where("token", $request->token)->first();
        $now = now();
        // "Y-m-d H:i:s"
        $diff = $now->diff($result->created_at);
        if($diff->d < 1 ) {
            return view('util.reset', ['email' => $result->email]);
        }
            return redirect()->action('/login');

    }
    public function resetValidate(Request $request) {
        $validator = Validator::make($request->only($this->resetFormItems), $this->resetValidator, $this->message);
        $email = $request->email;

        if ($validator->fails()) {
            return redirect()->action("CleanderController@reset")
            ->withErrors($validator)
            ->withInput()->with($request->result);
        } else {
            $user = User::where('email', $email)->first();
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            session(['name' => $user->name]);
            session(['id' => $user->id]);
            return redirect()->action('TaskController@task');
        }
    }
    public function resetSend(Request $request) {
        return view('util.sendResetMail');
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
}
