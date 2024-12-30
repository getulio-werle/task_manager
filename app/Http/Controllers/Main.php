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

    // login
    public function login()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('login_frm', $data);
    }

    public function login_submit()
    {
        echo 'Login submit';
    }

    // main page
    public function main() {
        $data = [
            'title' => 'Main'
        ];
        return view('main', $data);
    }
}
