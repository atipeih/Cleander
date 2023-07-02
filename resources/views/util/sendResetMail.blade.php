@include('layouts.header')
<div class="main_container flex-column ms-3">
	<h2 class="page_title mt-2">メール送信完了</h2>
	<div class="main flex-column w-auto mt-4">
		<p>入力いただいたメールアドレスにメールを送信しました</p>
		<p>メール内のURLからパスワードの再設定をお願いします</p>
        <a class="mt-4"href="/login">ログインはこちら</a>
	</div>
</div>
@include('layouts.footer')
