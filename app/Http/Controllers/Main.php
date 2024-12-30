<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Main extends Controller
{
    // main page
    public function index()
    {
        $data = [
            'title' => 'Main'
        ];
        return view('main', $data);
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
        // fake login
        session()->put('username', 'admin');
        echo 'logado';
    }

    // logout
    public function logout()
    {
        session()->forget('username');
        return redirect()->route('login');
    }
}
