@include('layouts.header')
<div class="main_container flex-column ms-3">
	<h2 class="page_title mt-2">パスワードリセット</h2>
	<div class="main flex-column w-auto">
		@if ($errors->any())
		<div style="color:red;">
			<ul class="error_list">
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
			</ul>
		</div>
		@endif
		<form action="{{ route('resetValidate') }}"method="post">
            @csrf
			<input type="hidden" name="email" $id="email" value="{{ $email }}">
			<p class="mt-4">新パスワード</p>
			<input type="text" name="password" id="password" class="form_input"><br>
			<input class="mt-2" type="text" name="password_confirmation" id="password_confirmation" placeholder="パスワード確認用"><br>
			<input class="mt-4 btn btn-outline-success" type="submit" value="登録">
		</form>
	</div>
</div>
@include('layouts.footer')
