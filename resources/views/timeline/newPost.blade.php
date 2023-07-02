@include('layouts.header')
    <div class="main_container flex-column ms-3">
		<h2 class="page_title mt-2">投稿作成</h2>
		<div class="main flex-column w-auto">
			<form action="{{ route('postValidate') }}"method="post" enctype="multipart/form-data">
			@csrf
			<p class="mt-4 me-3 d-inline-block">投稿画像</p>
			<input type="file" name="image" id="image" class="d-inline-block"><br>
			<p class="mt-4 me-3 d-inline-block">カテゴリー</p>
			<select class="form-select-sm" name="cat" id="cat"required>
				@foreach ($categories as $category)
				<option value="{{ $category->id }}">{{ $category->category }}</option>
				@endforeach
			</select>
			<p class="mt-4">本文</p>
			<textarea name="body" id="body" cols="40" rows="10" required>{{ old('body') }}</textarea><br>
			<input class="mt-4 btn btn-outline-success" type="submit" value="投稿">
			</form>
		</div>
    </div>
    @include('layouts.footer')
