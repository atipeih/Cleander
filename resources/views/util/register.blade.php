<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規登録</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="header">
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid"><a class="navbar-brand" href="#"><i class="bi bi-grid menu_button d-md-none"></i></a>
      <h2 class="navbar-brand mb-0">Cleander</h2>
      <h6>ユーザー名</h6>
      </div>
    </nav>
  </div>
  <div class="container-fluid d-flex justify-content-center gap-5">
    <div class="main_container ">
      <h2 class="page_title">アカウント登録</h2>
      <div class="main">
        <form action="registerValidate.html"method="post">
        <p class="mt-4">メールアドレス</p>
        <input type="text" name="email" id="email" class="form_input">
        <p class="mt-4">ユーザー名</p>
        <input type="text" name="name" id="name" class="form_input">
        <p class="mt-4">パスワード</p>
        <input type="text" name="password" id="password" class="form_input"><br>
        <input class="mt-2" type="text" name="re_password" id="re_password" placeholder="パスワード確認用"><br>
        <input class="btn btn-outline-primary mt-4" type="submit" value="登録">
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
