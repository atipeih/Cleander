@include('layouts.header')
    <div class="main_container flex-row justify-content-center">
      	<h2 class="page_title mt-2 mb-3">タスク管理</h2>
        <a href="/newTask"><button class="task_create btn-lg btn-success d-block ms-auto mb-4">新規</button></a>
        @if(isset($tasks))
            @foreach ($tasks as $task)
            <div class="task row border border-dark mt-2">
                <div class="left col btn btn-outline-dark" onclick="location.href='/taskZoom?id={{ $task->id }}'">
                    <p class="d-inline-block h5 task_name mt-3">{{ $task->name }}</p>
                    <p class="d-inline-block timer ms-5">{{ $task->cycle }}</p>
                </div>
                <div class="col-2 btn btn-success taskRun" taskid="{{ $task->id }}">
                    <p  class="h6 pt-3">実行</p>
                </div>
            </div>
            @endforeach
        @else
        <h4 class="mt-4">タスクを作成しましょう！</h4>
        @endif
    </div>
@include('layouts.footer')
