@extends('templates/main_layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Tasks</h1>
            <hr>
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
                    <tr>
                        <td>A</td>
                        <td>B</td>
                        <td>C</td>
                    </tr>
                </tbody>
            </table>
            <!-- message if not exists registered tasks -->
            <p class="text-center opacity-50 my-5">There are no tasks registered</p>
        </div>
    </div>
</div>
@endsection