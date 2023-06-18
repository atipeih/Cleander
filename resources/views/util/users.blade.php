<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー管理</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    @include('layouts.header')
  <div class="container-fluid d-flex justify-content-center gap-5">
    @include('layouts.menu')
    <div class="main_container flex-column ms-3">
      <h2 class="page_title mt-2">ユーザー管理</h2>
      <div class="main flex-column w-auto">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">名前</th>
              <th scope="col">メールアドレス</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>おちゃ</td>
              <td>Otto.asda@wadasda.com</td>
              <td class="btn btn-outline-danger">削除</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>明日から頑張る</td>
              <td>Thornton@skfa.awda</td>
              <td class="btn btn-outline-danger">削除</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>やる気があればきれいになる</td>
              <td>sjdoawa.sadw@sda.asda</td>
              <td class="btn btn-outline-danger">削除</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script
  src="https://code.jquery.com/jquery-3.7.0.slim.js"
  integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c="
  crossorigin="anonymous"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
