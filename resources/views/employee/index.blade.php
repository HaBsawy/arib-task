@extends('master')
@section('title', 'Employees')
@section('style')
    <link rel="stylesheet" href="{{ asset('plugins/dataTables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/dataTables/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-confirm/jquery-confirm.min.css') }}">
@endsection

@section('breadcrumb')
    {{ Breadcrumbs::render('employees') }}
@endsection

@section('content')

    <div class="bg-white-9 pd-20 rounded">
        @include('shared.messages')
        <table id="employees" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <td>ID</td>
                <td>Department Name</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Full Name</td>
                <td>Salary</td>
                <td>Image</td>
                <td>Manager Name</td>
                @canany(['edit-employee', 'delete-employee'])
                <td>Actions</td>
                @endcanany
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
            @can('create', \App\Models\Employee::class) {!! "'create-employee'," !!} @endcan
            @can('edit-employee') {!! "'edit-employee'," !!} @endcan
            @can('delete-employee') {!! "'delete-employee'," !!} @endcan
        ];

    </script>
    <script src="{{ asset('js/employee.js') }}"></script>
@endsection
