@include('layouts.header')
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
				@foreach ($users as $user)
				<tr>
					<th scope="row">{{ $user->id }}</th>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td class="btn btn-outline-danger userDelete" targetid={{$user->id}}>削除</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@include('layouts.footer')
