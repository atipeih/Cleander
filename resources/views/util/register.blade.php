@include('layouts.header')
<div class="main_container ">
	<h2 class="page_title">アカウント登録</h2>
	<div class="main">
		@if ($errors->any())
		<div style="color:red;">
			<ul class="error_list">
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<form action="{{ route('registerValidate') }}"method="post">
			@csrf
			<p class="mt-4">メールアドレス</p>
			<input type="text" name="email" id="email" class="form_input" value={{ old('email') }}>
			<p class="mt-4">ユーザー名</p>
			<input type="text" name="name" id="name" class="form_input" value={{ old('name') }}>
			<p class="mt-4">パスワード</p>
			<input type="text" name="password" id="password" class="form_input" value={{ old('password') }}><br>
			<input class="mt-2" type="text" name="password_confirmation" id="password_confirmation" placeholder="パスワード確認用" value={{ old('password_confirmation') }}><br>
			<input class="btn btn-outline-primary mt-4" type="submit" value="登録">
		</form>
	</div>
</div>
@include('layouts.footer')
