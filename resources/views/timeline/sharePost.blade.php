<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>シェアされた投稿</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="header">
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="bi bi-grid menu_button d-md-none"></i></a>
        <h2 class="navbar-brand mb-0">Cleander</h2>
        <h6 class="navbar-text">ユーザー名</h6>
      </div>
    </nav>
  </div>
  <div class="container-fluid d-flex justify-content-center gap-5">
    <div class="menu_container d-md-flex d-none">
      <nav class="menu">
        <h3>Menu</h3>
        <div class="menu_item">
          <ul>
            <li><button class="btn btn-info mt-1">タスク管理</button></li>
            <li><button class="btn btn-info mt-1">タイムライン</button></li>
            <li><button class="btn btn-info mt-1">投稿</button></li>
            <li><button class="btn btn-info mt-1">いいね</button></li>
            <li><button class="btn btn-info mt-1">新規投稿</button></li>
            <li><button class="btn btn-info mt-1">新規タスク</button></li>
            <li><button class="btn btn-info mt-1">ユーザー管理</button></li>
            <li><button class="btn btn-info mt-1">ログアウト</button></li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="main_container flex-row ms-3 justify-content-center">
      <h2 class="page_title mt-2">シェアされた投稿</h2>
      <div class="login">
        <button class="register btn btn-outline-primary my-4 d-inline-block me-3">新規登録</button>
        <button class="register btn btn-outline-success my-4 d-inline-block">ログイン</button><br>
      </div>
      <div class="card w-75 mt-2 mx-auto">
        <div class="card-header d-flex justify-content-between">
          <p class="mt-3 m
          e-3">ユーザー名</p>
          <p class="text-secondary mt-3 me-3">YYYY/MM/dd</p>
        </div>
        <img src="image.png" class="card-img">
        <div class="card-body">
          <div class="container d-flex justify-content-between">
          <p class="card-text mt-1">カテゴリ：お風呂</p>
          <p class="btn btn-outline-primary">共有<i class="bi bi-twitter"></i></p>
          <p class="btn btn-outline-primary">いいね<i class="bi bi-hand-thumbs-up"></i></p>
          </div>
          <p class="card-text"></br></br></br></br></br></br></p>
        </div>
      </div>
      <div class="foot_space"></div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>