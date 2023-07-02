@include('layouts.header')
<div class="main_container flex-column ms-3">
	<h2 class="page_title mt-2">パスワードリセットメール送信</h2>
	<div class="main flex-column w-auto">
		<form action="{{route('resetPost')}}"method="post">
            @csrf
            <input class="mt-2" type="hidden" name="token" id="token" value="{{ $token }}"><br>
            <p class="mt-4">メールアドレス</p>
            <input class="mt-2" type="email" name="email" id="email" required><br>
            <input class="btn btn-outline-primary mt-4" type="submit" value="メール送信">
		</form>
	</div>
</div>
@include('layouts.footer')
