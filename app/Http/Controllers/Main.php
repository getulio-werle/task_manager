<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Main extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Task Manager',
            'description' => 'Task Manager'
        ];
        return view('main', $data);
    }
}
