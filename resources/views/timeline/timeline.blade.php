@include('layouts.header')
<div class="main_container flex-row mx-3 md-mx-0">
    <h2 class="page_title mt-2">タイムライン</h2>
    @foreach ($posts as $post)
    <div class="card w-75 mt-2 mx-auto">
        <div class="card-header d-flex justify-content-between">
            <p class="mt-3 me-3">{{ $post->name }}</p>
            <p class="text-secondary mt-3 me-3">{{ date('Y/n/d', strtotime($post->created_at)) }}</p>
            @if (session('id') < 100000 || $post->name == session('name'))
            <p class="btn btn-outline-danger postDelete"postid="{{ $post->id }}"name="{{$post->name}}">削除</p>
            @endif
        </div>
        @if (! $post->image == '')
        <img src="{{ asset($post->image) }}" class="card-img">
        @endif
        <div class="card-body">
            <div class="container d-flex justify-content-between">
                <p class="card-text mt-1">カテゴリ：{{ $post->category }}</p>
                <a class="btn btn-outline-primary pt-3"href="https://twitter.com/intent/tweet?url=http://localhost:8888/sharePost?id={{ encrypt($post->id) }}&text={{ $post->name }}さんの投稿%20%23Cleander">共有<i class="bi bi-twitter"></i></a>
                @foreach ($liked as $like)
                @if($like->postid == $post->id && $like->userid == session('id'))
                <p class="btn btn-primary like"postid="{{ $post->id }}"likeflg="1">いいね<i class="bi  bi-check-lg"></i></p>
                @php $check["$post->id"] = 1 @endphp
                @endif
                @endforeach
                @if(! isset($check["$post->id"]))
                <p class="btn btn-outline-primary like"postid="{{ $post->id }}"likeflg="0">いいね<i class="bi bi-hand-thumbs-up"></i></p>
                @endif
            </div>
            <p class="card-text mt-3 pt-3">{{ $post->body }}</p>
        </div>
    </div>
    @endforeach
    <div class="d-flex my-4 pt-3 justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@include('layouts.footer')
