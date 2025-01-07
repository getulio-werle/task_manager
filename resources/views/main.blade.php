@extends('templates/main_layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h1><i class="bi bi-list-task me-3"></i>Tasks</h1>
                </div>
                <div class="col text-end">
                    <a href="{{ route('new_task') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>New task</a>
                </div>
            </div>
            <hr>
            @if($tasks->count() != 0)
                <!-- table -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="w-50">Task name</th>
                            <th class="w-25">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->task_name }}</td>
                                <td>{{ $task->task_status }}</td>
                                <td>[actions]</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <!-- message if not exists registered tasks -->
                <p class="text-center opacity-50 my-5">There are no tasks registered</p>
            @endif
        </div>
    </div>
</div>
@endsection