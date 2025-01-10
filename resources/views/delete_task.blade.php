@extends('templates/main_layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2><i class="bi bi-trash me-2"></i>Delete task</h2>
            <hr>
            {{-- task info --}}
            <div class="mb-5">
                <h3 class="text-primary">{{ $task->task_name }}</h3>
                <p class="opacity-50">{{ $task->task_description }}</p>
            </div>
            <p class="text-center mb-5">Do you want to delete this task?</p>
            {{-- cancel and submit buttons --}}
            <div class="mb-3 text-center">
                <a href="{{ route('index') }}" class="btn btn-secondary me-3"><i class="bi bi-x-lg me-2"></i>Cancel</a>
                <a href="{{ route('delete_task_confirm', ['id' => Crypt::encrypt($task->id)]) }}" class="btn btn-danger ms-3"><i class="bi bi-trash me-2"></i>Delete</a>
            </div>
        </div>
    </div>
</div>
@endsection