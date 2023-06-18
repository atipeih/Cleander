<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>パスワードリセット</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="header">
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid"><a class="navbar-brand" href="#"><i class="bi bi-grid menu_button d-md-none"></i></a>
      <h2 class="navbar-brand mb-0">Cleander</h2>
      <p></p>
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
    <div class="main_container flex-column ms-3">
      <h2 class="page_title mt-2">パスワードリセット</h2>
      <div class="main flex-column w-auto">
        <form action="register_validate.html"method="post">
          <p class="mt-4">新パスワード</p>
          <input type="text" name="password" id="password" class="form_input"><br>
          <input class="mt-2" type="text" name="re_password" id="re_password" placeholder="パスワード確認用"><br>
          <input class="mt-4 btn btn-outline-success" type="button" value="登録">
        </form>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>