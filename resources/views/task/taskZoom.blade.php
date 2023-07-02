
@include('layouts.header')
<div class="main_container flex-column ms-3">
	<h2 class="page_title">タスク詳細</h2>
	<a class="btn btn-danger task_delete position-absolute" href="/taskDelete?id={{ $task->id }}"onclick="confirm('{{ $task->name }}を削除しますか？')">削除</a>
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
		<form action="/taskZoomUp" method="post">
			@csrf
            <input type="hidden" name="id" value="{{ $task->id }}">
			<p class="mt-4">タスク名</p>
			<input class="" type="text" name="name" id="name" value="{{ old('name', $task->name) }}" required>
			<p class="mt-4">周期</p>
            @php $spanCycle = explode(' ', $task->cycle); @endphp
			<input type="number" name="span" id="span" value="{{ $spanCycle[0] }}" required>
			<select name="cycle" id="cycle" required>
				<option value="day" {{ old('cycle', $spanCycle[1]) == 'day' ? 'selected' : '' }}>日</option>
				<option value="week" {{ old('cycle', $spanCycle[1]) == 'week' ? 'selected' : '' }}>週</option>
				<option value="month" {{ old('cycle', $spanCycle[1]) == 'month' ? 'selected' : '' }}>ヵ月</option>
				<option value="year" {{ old('cycle', $spanCycle[1]) == 'year' ? 'selected' : '' }}>年</option>
			</select>
			<p class="mt-4">メモ</p>
			<textarea name="memo" id="memo" cols="30" rows="10">{{ old('memo', $task->memo) }}</textarea><br>
			<button class="btn btn-light border"onclick="history.back">戻る</button>
			<input class="btn btn-success" type="submit" value="保存">
		</form>
	</div>
</div>
@include('layouts.footer')
