<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>タスク管理</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <div class="header container-fluid">
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                @if(! session('id') == '')
                <i class="bi bi-grid menu_button d-md-none"></i>
                @endif
            </a>
            <h2 class="navbar-brand mb-0">Cleander</h2>
            <p>{{ session('name') }}</p>
        </div>
    </nav>
  </div>
  <div class="container-fluid d-flex justify-content-center gap-5">
    @if (session()->has('name'))
    <div class="menu_container d-md-flex d-none">
      <nav class="menu">
        <h3>Menu</h3>
        <div class="menu_item">
          <ul>
            <li><a href="/task"><button class="btn btn-info mt-1">タスク管理</button></a></li>
            <li><a href="/timeline"><button class="btn btn-info mt-1">タイムライン</button></a></li>
            <li><a href="/userPost"><button class="btn btn-info mt-1">自分の投稿</button></a></li>
            <li><a href="/likedPost"><button class="btn btn-info mt-1">いいねした投稿</button></a></li>
            <li><a href="/newPost"><button class="btn btn-info mt-1">新規投稿</button></a></li>
            <li><a href="/newTask"><button class="btn btn-info mt-1">新規タスク</button></a></li>
            @if(session()->get('id') <= 100000)
            <li><a href="/users"><button class="btn btn-info mt-1">ユーザー管理</button></a></li>
            @endif
            <li><a href="/logout"><button class="btn btn-info mt-1">ログアウト</button></a></li>
          </ul>
        </div>
      </nav>
    </div>
    <nav class="g-nav ">
      <div class="g-nav-list menu_item">
        <ul>
          <li><a href="/task"><button class="btn-lg btn-info mt-2 px-5">タスク管理</button></a></li>
          <li><a href="/timeline"><button class="btn-lg btn-info mt-2 px-5">タイムライン</button></a></li>
          <li><a href="/userPost"><button class="btn-lg btn-info mt-2 px-5">自分の投稿</button></a></li>
          <li><a href="/likedPost"><button class="btn-lg btn-info mt-2 px-5">いいねした投稿</button></a></li>
          <li><a href="/newPost"><button class="btn-lg btn-info mt-2 px-5">新規投稿</button></a></li>
          <li><a href="/newTask"><button class="btn-lg btn-info mt-2 px-5">新規タスク</button></a></li>
          @if(session()->get('id') <= 100000)
          <li><a href="/users"><button class="btn-lg btn-info mt-2 px-5">ユーザー管理</button></a></li>
          @endif
          <li><a href="/logout"><button class="btn-lg btn-info mt-2 px-5">ログアウト</button></a></li>
        </ul>
      </div>
    </nav>
    @endif
