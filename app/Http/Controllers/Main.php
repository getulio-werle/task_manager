<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function users()
    {
        // get users with raw sql
        // $users = DB::select('SELECT * FROM users');
        // dd($users);
        
        // with query builder
        // $users = DB::table('users')->get();
        // dd($users);
        
        // with query builder - return in array
        // $users = DB::table('users')->get()->toArray();
        // echo '<pre>';
        // print_r($users);
        
        // using Eloquent ORM - Using Model
        $model = new UsersModel();
        $users = $model->all();

        foreach ($users as $user) {
            echo $user->username . '<br>';
        }
    }
    public function view() {
        $data = [
            'title' => 'Title'
        ];
        return view('home', $data);
    }
}
