@include('layouts.header')
    <div class="main_container d-flex-row ms-5">
		<h2 class="page_title mt-2 d-inline-block">ログイン</h2>
		<div class="main w-auto">
			@if (isset($login_error))
			<div id="error_explanation" class="text-danger">
			<ul>
				<li>メールアドレスまたはパスワードが一致しません。</li>
			</ul>
			</div>
			@endif
			<form class="" action="{{ route('loginValidate') }}"method="post">
				@csrf
				<div class="justify-content-center">
					<p class="mt-4 me-4 d-inline-block">メールアドレス</p><br>
					<input class="" type="text" name="email" id="email" value={{ old('email') }}>
				</div>
				<div class="">
					<p class="mt-4 d-inline-block">パスワード</p><br>
					<input class="" type="text" name="password" id="password" value={{ old('password') }}>
				</div>
				<div class="">
					<input class="btn btn-outline-primary mt-4 d-inline-block" type="submit" value="ログイン"><br>
			</form>
			<a href="{{ '/register' }}" class="register btn btn-outline-success my-4 d-inline-block">新規登録</a><br>
			</div>

			<a href="/resetForm">パスワードをお忘れですか？</a>
	</div>
@include('layouts.footer')
