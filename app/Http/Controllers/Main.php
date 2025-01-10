<?php

namespace App\Http\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class Main extends Controller
{
    // ===============================
    // main page
    // ===============================
    public function index()
    {
        $data = [
            'title' => 'Main',
            'datatables' => true,
            'tasks' => $this->_get_tasks()
        ];
        return view('main', $data);
    }
    // ===============================
    // login
    // ===============================
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
            'text_username.min' => 'The field must have at least :min characters',
            'text_password.required' => 'The field is mandatory',
            'text_password.min' => 'The field must have at least :min characters'
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
    // ===============================
    // logout
    // ===============================
    public function logout()
    {
        session()->forget('username');
        return redirect()->route('login');
    }
    // ===============================
    // new task
    // ===============================
    public function new_task()
    {
        $data = [
            'title' => 'New task'
        ];
        return view('new_task_frm', $data);
    }
    public function new_task_submit(Request $request)
    {
        // form validation
        $request->validate([
            'text_task_name' => 'required|min:3|max:200',
            'text_task_description' => 'required|min:3|max:1000'
        ], [
            'text_task_name.required' => 'The field is mandatory',
            'text_task_name.min' => 'The field must have at least :min characters',
            'text_task_name.max' => 'The field must have a maximum of :max characters',
            'text_task_description.required' => 'The field is mandatory',
            'text_task_description.min' => 'The field must have at least :min characters',
            'text_task_description.max' => 'The field must have a maximum of :max characters'
        ]);
        // get form data
        $task_name = $request->input('text_task_name');
        $task_description = $request->input('text_task_description');
        // check if there is already another task with the same name for the same user
        $model = new TaskModel();
        $task = $model->where('id_user', '=', session('id'))->where('task_name', '=', $task_name)->whereNull('deleted_at')->first();
        if ($task) {
            return redirect()->route('new_task')->withInput()->with('task_error', 'Already exists another task with the same name');
        }
        // insert new task
        $model->id_user = session('id');
        $model->task_name = $task_name;
        $model->task_description = $task_description;
        $model->task_status = 'new';
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
        // success, redirect to index
        return redirect()->route('index');
    }
    // ===============================
    // edit task
    // ===============================
    public function edit_task($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            return redirect()->route('index');
        }
        // get task
        $model = new TaskModel();
        $task = $model->where('id', '=', $id)->first();
        // check if task exists
        if (empty($task)) {
            return redirect()->route('index');
        }
        $data = [
            'title' => 'Edit task',
            'task' => $task
        ];
        return view('edit_task_frm', $data);
    }
    public function edit_task_submit(Request $request)
    {
        // form validation
        $request->validate([
            'text_task_name' => 'required|min:3|max:200',
            'text_task_description' => 'required|min:3|max:1000',
            'text_task_status' => 'required'
        ], [
            'text_task_name.required' => 'The field is mandatory',
            'text_task_name.min' => 'The field must have at least :min characters',
            'text_task_name.max' => 'The field must have a maximum of :max characters',
            'text_task_description.required' => 'The field is mandatory',
            'text_task_description.min' => 'The field must have at least :min characters',
            'text_task_description.max' => 'The field must have a maximum of :max characters',
            'text_task_status.required' => 'The field is mandatory'
        ]);
        $task_id = null;
        try {
            $task_id = Crypt::decrypt($request->input('text_task_id'));
        } catch (\Exception $e) {
            return redirect()->route('index');
        }
        // get form data
        $task_name = $request->input('text_task_name');
        $task_description = $request->input('text_task_description');
        $task_status = $request->input('text_task_status');
        // check if there is already another task with the same name for the same user
        $model = new TaskModel();
        $task = $model->where('id', '!=', $task_id)
            ->where('id_user', '=', session()->get('id'))
            ->where('task_name', '=', $task_name)
            ->whereNull('deleted_at')
            ->first();
        if ($task) {
            return redirect()->route('edit_task', ['id' => Crypt::encrypt($task_id)])->withInput()->with('task_error', 'Already exists another task with the same name');
        }
        // update task
        $model->where('id', '=', $task_id)
            ->update([
                'task_name' => $task_name,
                'task_description' => $task_description,
                'task_status' => $task_status,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        return redirect()->route('index');
    }
    // ===============================
    // delete task
    // ===============================
    public function delete_task($id)
    {
        try {
            $task_id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            return redirect()->route('index');
        }
        $model = new TaskModel();
        $task = $model->where('id', '=', $task_id)->first();
        if (!$task) {
            return redirect()->route('index');
        }
        $data = [
            'title' => 'Delete task',
            'task' => $task
        ];
        return view('delete_task', $data);
    }
    public function delete_task_confirm($id)
    {
        try {
            $task_id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            return redirect()->route('index');
        }
        // delete task (soft delete)
        $model = new TaskModel();
        $model->where('id', '=', $task_id)
            ->update([
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
        return redirect()->route('index');
    }
    // ===============================
    // private methods
    // ===============================
    private function _get_tasks()
    {
        $model = new TaskModel();
        $tasks = $model->where('id_user', '=', session()->get('id'))->whereNull('deleted_at')->get();
        $collection = [];
        foreach ($tasks as $task) {
            $link_edit = '<a href="' . route('edit_task', ['id' => Crypt::encrypt($task->id)]) . '" class="btn btn-warning m-1"><i class="bi bi-pencil-square"></i></a>';
            $link_delete = '<a href="' . route('delete_task', ['id' => Crypt::encrypt($task->id)]) . '" class="btn btn-danger m-1"><i class="bi bi-trash"></i></a>';
            $collection[] = [
                'task_name' => $task->task_name,
                'task_status' => $this->_get_status_name($task->task_status),
                'task_actions' => $link_edit . $link_delete
            ];
        }
        return $collection;
    }
    private function _get_status_name($status)
    {
        $status_collection = [
            'new' => 'New',
            'in_progress' => 'In progress',
            'cancelled' => 'Cancelled',
            'completed' => 'Completed'
        ];
        if (key_exists($status, $status_collection)) {
            return $status_collection[$status];
        } else {
            return 'Unknown';
        }
    }
}
