@include('layouts.header')
    <div class="main_container flex-row ms-3 justify-content-center">
		<h2 class="page_title mt-2 pb-4 px-4 border-bottom">シェアされた投稿</h2>
		@if (! session()->has('id'))
		<div class="login">
			<button class="register btn btn-outline-primary my-4 d-inline-block me-3">新規登録</button>
			<button class="register btn btn-outline-success my-4 d-inline-block">ログイン</button><br>
		</div>
		@endif
		<div class="card w-75 mt-2 mx-auto">
			<div class="card-header d-flex justify-content-between">
				<p class="mt-3 me-3">{{ $post->name }}</p>
				<p class="text-secondary mt-3 me-3">{{ date('Y/n/d', strtotime($post->created_at)) }}</p>
				@if (session()->has('id') && session('id') < 100000 || $post->userid == session('id'))
				<p class="btn btn-outline-danger postDelete"postid="{{ $post->id }}"name="{{$post->name}}">削除</p>
				@endif
			</div>
			<img src="{{ asset($post->image) }}" class="card-img">
			<div class="card-body">
				<div class="container d-flex justify-content-between">
				<p class="card-text mt-1">カテゴリ：{{ $post->category }}</p>
                <a class="btn btn-outline-primary pt-3"href="https://twitter.com/intent/tweet?url=http://localhost:8888/sharePost?id={{ encrypt($post->id) }}&text={{ $post->name }}さんの投稿%20%23Cleander">共有<i class="bi bi-twitter"></i></a>
				@foreach ($likes as $like)
					@if($like->id == $post->id && $like->userid == $like)
					<p class="btn btn-outline-primary like">いいね<i class="likeIcon bi  bi-check-lg"></i></p>
					@endif
				@endforeach
				<p class="btn btn-outline-primary like">いいね<i class="likeIcon bi  bi-hand-thumbs-up"></i></p>
				</div>
				<p class="card-text mt-3">{{ $post->body }}</p>
			</div>
		</div>
    </div>
    @include('layouts.footer')
