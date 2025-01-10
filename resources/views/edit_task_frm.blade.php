@extends('templates/main_layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2><i class="bi bi-pencil-square me-2"></i>Edit task</h2>
            <hr>
            <form action="{{ route('edit_task_submit') }}" method="post">
                @csrf
                {{-- task id --}}
                <input type="hidden" name="text_task_id" value="{{ Crypt::encrypt($task->id) }}">
                {{-- task name --}}
                <div class="mb-3">
                    <label for="text_task_name" class="form-label">Task name</label>
                    <input type="text" class="form-control" name="text_task_name" id="text_task_name" placeholder="Task name" value="{{ old('text_task_name', $task->task_name) }}">
                    @error('text_task_name')
                        <div class="text-danger">{{ $errors->get('text_task_name')[0] }}</div>
                    @enderror
                </div>
                {{-- task description --}}
                <div class="mb-3">
                    <label for="text_task_description" class="form-label">Task description</label>
                    <textarea name="text_task_description" class="form-control" id="text_task_description" cols="30" rows="10" placeholder="Task description">{{ old('text_task_description', $task->task_description) }}</textarea>
                    @error('text_task_description')
                        <div class="text-danger">{{ $errors->get('text_task_description')[0] }}</div>
                    @enderror
                </div>
                {{-- task status --}}
                <div class="mb-3">
                    <label for="text_task_status" class="form-label">Task status</label>
                    <select name="text_task_status" id="text_task_status" class="form-select w-25">
                        @foreach(['new' => 'New', 'in_progress' => 'In progress', 'cancelled' => 'Cancelled', 'completed' => 'Completed'] as $key => $value)
                            <option value="{{ $key }}" {{ old('text_task_status', $task->task_status) == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('text_task_status')
                        <div class="text-danger">{{ $errors->get('text_task_status')[0] }}</div>
                    @enderror
                </div>
                {{-- cancel and submit buttons --}}
                <div class="mb-3 text-center">
                    <a href="{{ route('index') }}" class="btn btn-secondary me-3"><i class="bi bi-x-lg me-2"></i>Cancel</a>
                    <button type="submit" class="btn btn-primary ms-3"><i class="bi bi-floppy-fill me-2"></i>Save</button>
                </div>
            </form>
            @if(session()->has('task_error'))
                <div class="alert alert-danger text-center">{{ session()->get('task_error') }}</div>
            @endif
        </div>
    </div>
</div>
@endsection