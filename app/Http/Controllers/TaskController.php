<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use DateTime;

class TaskController extends Controller
{
    private $taskItems = ["name", "span", "cycle", "memo"];

    private $taskValidator = [
        "name" => "required|max:20",
        "span" => "required",
        "cycle" => "required",
        "memo" => "max:1000",
    ];

    private $taskMessage = [
        'name.required' => 'タスク名は入力必須項目です',
        'name.max' => 'タスク名は10文字以内で入力してください',
        'span.required' => '期間は入力必須項目です',
        'cycle.required' => '期間単位は入力必須項目です',
        'memo.required' => 'メモは1,000文字以内で入力してください',
    ];

    public function task(Request $request) {
        $tasks = Task::where('userid', session('id'))->orderBy('run', 'asc')->get();
        foreach($tasks as $task) {
            $runtime = date("Y-m-d", strtotime($task->cycle));
            $now = now()->format('Y-m-d');
            if($now < $runtime) {
                $task->cycle = (strtotime($runtime) - strtotime($now)) / (60 * 60 * 24) . "日後";
            }else {
                $task->cycle = "実行時期です！";
            }
        }
        return view('task.task', compact('tasks'));
     }
    public function taskRun(Request $request) {
        Task::where('id', $request->id)->where('userid', session('id'))->update([
            'run' => now()->format('Y-m-d'),
        ]);
        return redirect()->action('TaskController@task');
     }

     public function newTask(Request $request) {
         return view('task.newTask');
     }
     public function taskValidate(Request $request) {
        $validator = Validator::make($request->only($this->taskItems), $this->taskValidator, $this->taskMessage);

        if ($validator->fails()) {
            return redirect()->action("TaskController@newTask")
            ->withErrors($validator)
            ->withInput();
        }else {
            Task::create([
                'userid' => session('id'),
                'name' => $request->name,
                'cycle' => $request->span." ".$request->cycle,
                'memo' => $request->memo,
                'run' => now()->format('Y-m-d'),
            ]);
            return redirect()->action("TaskController@task");
        }
    }

    public function taskZoom(Request $request) {
        $id = $request->input('id');
        $task = Task::find($id);
        return view('task.taskZoom', compact('task'));
    }

    public function taskUpValidate(Request $request) {
        $id = $request->id;
        $validator = Validator::make($request->only($this->taskItems), $this->taskValidator, $this->taskMessage);

        if ($validator->fails()) {
            return redirect()->route("zoom", ['id' => $id,])
            ->withErrors($validator)
            ->withInput();
        }else {
            Task::where('id', $id)->where('userid', session('id'))->update([
                'name' => $request->name,
                'cycle' => $request->span." ".$request->cycle,
                'memo' => $request->memo,
            ]);
            return redirect()->action("TaskController@task");
        }

    }

    public function taskDelete(Request $request) {
        $id = $request->input('id');
        Task::where('id', $id)->delete();
        return redirect()->action("TaskController@task");
    }
}
