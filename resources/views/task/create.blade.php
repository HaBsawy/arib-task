@extends('master')
@section('title', 'Create Task')

@section('breadcrumb')
    {{ Breadcrumbs::render('tasks.create') }}
@endsection

@section('content')

    <div class="bg-white-9 pd-20 rounded">
        <form id="tasks_form" class="" method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div class="form-group mg-b-15">
                <label for="employee_id" class="form-label">Employee</label>
                <select id="employee_id" name="employee_id"
                        class="form-control @error('employee_id') is-invalid @endError">
                    <option value="">Select Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}"
                                @if($employee->id == old('employee_id')) selected @endif>
                            {{ $employee->full_name }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mg-b-15">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name"
                       class="form-control @error('name') is-invalid @endError" value="{{ old('name') }}"
                       placeholder="Enter name">
                @error('name')
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>

@endsection
