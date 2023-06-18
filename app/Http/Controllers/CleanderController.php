<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CleanderController extends Controller
{
    private $loginFormItems = ["email", "password"];

    private $loginValidator = [
        "email" => "required|email|max:100",
        "password" => "required",
    ];

    public function register() {
        return view('util.register');
    }

    public function login() {
        return view('util.login');
    }

    public function loginValidate($e = "") {
        return redirect()->action('task.task');
        if($e) {
            return redirect()->action('util.login');
        }else {
            return redirect()->action('task.task');
        }
    }

    public function resetForm() {
        return view('util.resetForm');
    }

    public function reset() {
        return view('util.reset');
    }

    public function showUsers() {
        return view('util.users');
     }

    public function timeline() {
        return view('timeline.timeline');
     }

    public function likedPost() {
        return view('timeline.likedPost');
     }

    public function newPost() {
        return view('timeline.newPost');
     }

    public function postUplode() {
        return view('timeline.postUplode');
     }

    public function sharePost() {
        return view('timeline.sharePost');
     }

    public function task() {
        return view('task.task');
     }

     public function newtask() {
         return view('task.newTask');
     }

     public function taskZoom() {
         return view('task.taskZoom');
     }
}
