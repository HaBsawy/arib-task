@extends('master')
@section('title', 'Tasks')
@section('style')
    <link rel="stylesheet" href="{{ asset('plugins/dataTables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/dataTables/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-confirm/jquery-confirm.min.css') }}">
@endsection

@section('breadcrumb')
    {{ Breadcrumbs::render('tasks') }}
@endsection

@section('content')

    <div class="bg-white-9 pd-20 rounded">
        @include('shared.messages')
        <table id="tasks" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <td>ID</td>
                <td>Employee</td>
                <td>Name</td>
                <td>Status</td>
                @can('edit-task')
                <td>Actions</td>
                @endcan
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

@endsection

@section('script')
    <script src="{{ asset('plugins/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/dataTables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('plugins/dataTables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/dataTables/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>
    <script type="text/javascript">
        const APP_URL = '{{ url('/') }}';
        const permissions = [
            @can('create', \App\Models\Task::class) {!! "'create-task'," !!} @endcan
            @can('edit-task') {!! "'edit-task'," !!} @endcan
        ];

    </script>
    <script src="{{ asset('js/task.js') }}"></script>
@endsection
