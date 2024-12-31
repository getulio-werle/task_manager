<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
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

    public function login_submit(Request $request)
    {
        // form validation
        $request->validate([
            'text_username' => 'required|min:3',
            'text_password' => 'required|min:3'
        ], [
            'text_username.required' => 'The field is mandatory',
            'text_username.min' => 'The field must have at least 3 characters',
            'text_password.required' => 'The field is mandatory',
            'text_password.min' => 'The field must have at least 3 characters'
        ]);
        // get login data
        $username = $request->input('text_username');
        $password = $request->input('text_password');
        // check if user exists and your password is correct
        $model = new UserModel();
        $user_data = $model->where('username', '=', $username)->whereNull('deleted_at')->first();
        if ($user_data && password_verify($password, $user_data->password)) {
            $session_data = [
                'id' => $user_data->id,
                'username' => $user_data->username
            ];
            session()->put($session_data);
            return redirect()->route('index');
        }
        return redirect()->route('login')->withInput()->with('login_error', 'Invalid login');
    }

    // logout
    public function logout()
    {
        session()->forget('username');
        return redirect()->route('login');
    }
}
