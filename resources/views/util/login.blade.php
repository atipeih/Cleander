<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
@include('layouts.header');
  <div class="container-fluid d-flex justify-content-center gap-5">
    <div class="main_container d-flex-row ms-3">
      <h2 class="page_title mt-2 d-inline-block">ログイン</h2>
      <div class="main w-auto">
        <form class="" action="{{ route('loginValidate') }}"method="post">
          <div class="justify-content-center">
            <p class="mt-4 me-4 d-inline-block">メールアドレス</p><br>
            <input class="" type="text" name="email" id="email">
          </div>
          <div class="">
            <p class="mt-4 d-inline-block">パスワード</p><br>
            <input class="" type="text" name="password" id="password">
          </div>
          <div class="">
            <input class="btn btn-outline-primary mt-4 d-inline-block" type="submit" value="ログイン"><br>
          </form>
          <a href="{{ route('util.register') }}" class="register btn btn-outline-success my-4 d-inline-block">新規登録</a><br>
          </div>

        <a href="#">パスワードをお忘れですか？</a>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
