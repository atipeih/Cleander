<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostController extends Controller
{
    private $postItems = ["image", "cat", "body"];

    private $postValidator = [
        "image" => "mimes:jpg,png,jpeg",
        "cat" => "required",
        "body" => "required|max:1000",
    ];

    private $postMessage = [
        'image.required' => 'タスク名は入力必須項目です',
        'name.max' => 'タスク名は10文字以内で入力してください',
        'span.required' => '期間は入力必須項目です',
        'cycle.required' => '期間単位は入力必須項目です',
        'memo.required' => 'メモは1,000文字以内で入力してください',
    ];

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

    public function newPost() {
        $categories = Category::All();
        return view('timeline.newPost', compact('categories'));
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
            return redirect()->action('PostController@postUplode');
        }
    }

    public function postUplode(Request $request) {
        return view('timeline.postUplode');
    }

    public function postDelete(Request $request) {
        $id = $request->input('postid');
        if($request->input('name') == session('name') || session('id') <= 100000){
            Post::where('id', $id)->delete();
            return $data = 0;
        }
        return $data = 1;
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

    public function sharePost(Request $request) {
        $getid = $request->input('id');
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
        ->where('p.id', $postid)->first();
        $likes = Like::where('postid', $postid);
        return view('timeline.sharePost', compact('post', 'likes'));
    }

}
