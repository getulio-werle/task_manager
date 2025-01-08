@extends('templates/main_layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="row align-items-center">
                <div class="col">
                    <h1><i class="bi bi-list-task me-3"></i>Tasks</h1>
                </div>
                <div class="col text-end">
                    <a href="{{ route('new_task') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>New task</a>
                </div>
            </div>
            <hr>
            @if(count($tasks) != 0)
                <!-- table -->
                <table class="table table-striped" id="table_tasks">
                    <thead>
                        <tr>
                            <th class="w-75">Task name</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            @else
                <!-- message if not exists registered tasks -->
                <p class="text-center opacity-50 my-5">There are no tasks registered</p>
            @endif
        </div>
    </div>
</div>
<script>
    // DataTables
    $(document).ready(function() {
        $('#table_tasks').DataTable({
            data: @json($tasks),
            columns: [
                { data: 'task_name' },
                { data: 'task_status', className: 'text-center' },
                { data: 'task_actions', className: 'text-center' }
            ]
        });
    });
</script>

@endsection