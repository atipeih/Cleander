@include('layouts.header')
    <div class="main_container flex-column ms-3">
        <h2 class="page_title">タスク作成</h2>
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
            <form action="{{ route('taskValidate') }}"method="post">
                @csrf
                <p class="mt-4">タスク名</p>
                <input class="" type="text" name="name" id="name" value="{{ old('name') }}" required>
                <p class="mt-4">周期</p>
                <input type="number" name="span" id="span" value="{{ old('span') }}" required>
                <select name="cycle" id="cycle" required>
                    <option value="day" {{ old('cycle', 'day') == 'day' ? 'selected' : '' }}>日</option>
                    <option value="week" {{ old('cycle') == 'week' ? 'selected' : '' }}>週</option>
                    <option value="month" {{ old('cycle') == 'month' ? 'selected' : '' }}>ヵ月</option>
                    <option value="year" {{ old('cycle') == 'year' ? 'selected' : '' }}>年</option>
                </select>
                <p class="mt-4">メモ</p>
                <textarea name="memo" id="memo" cols="30" rows="10">{{ old('name') }}</textarea><br>
                <a class="btn btn-light border"href="#"onclick="history.back();">戻る</a>
                <input class="btn btn-success" type="submit" value="作成">
            </form>
    	</div>
    </div>
    @include('layouts.footer')

