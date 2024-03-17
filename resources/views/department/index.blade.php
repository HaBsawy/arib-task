@extends('master')
@section('title', 'Departments')
@section('style')
    <link rel="stylesheet" href="{{ asset('plugins/dataTables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/dataTables/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-confirm/jquery-confirm.min.css') }}">
@endsection

@section('breadcrumb')
    {{ Breadcrumbs::render('departments') }}
@endsection

@section('content')

    <div class="bg-white-9 pd-20 rounded">
        @include('shared.messages')
        <table id="departments" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Employees count</td>
                <td>Salary sum</td>
                <td>Actions</td>
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

        let permissions = [
            @can('create', \App\Models\Department::class) {!! "'create-department'," !!} @endcan
            @can('edit-department') {!! "'edit-department'," !!} @endcan
            @can('delete-department') {!! "'delete-department'," !!} @endcan
        ];

    </script>
    <script src="{{ asset('js/department.js') }}"></script>
@endsection
