<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Main extends Controller
{
    public function index()
    {
        echo 'Task Manager';
    }

    public function login() {
        $data = [
            'title' => 'Login'
        ];
        return view('login_frm', $data);
    }
}