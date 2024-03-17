@extends('master')
@section('title', isset($employee->id) ? 'Edit Employee' : 'Create Employee')

@section('breadcrumb')
    {{ $employee->id ? Breadcrumbs::render('employees.edit', $employee) : Breadcrumbs::render('employees.create') }}
@endsection

@section('content')

    <div class="bg-white-9 pd-20 rounded">
        <form id="employees_form" class="" method="POST" action="{{ isset($employee->id) ? route('employees.update', $employee->id) : route('employees.store') }}" enctype="multipart/form-data">
            @if(isset($employee->id)) @method('PUT') @endif
            @csrf
            <div class="form-group mg-b-15">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" id="first_name" name="first_name"
                       class="form-control @error('first_name') is-invalid @endError" value="{{ old('first_name', $employee->first_name) }}"
                       placeholder="Enter first name">
                @error('first_name')
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mg-b-15">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" id="last_name" name="last_name"
                       class="form-control @error('last_name') is-invalid @endError" value="{{ old('last_name', $employee->last_name) }}"
                       placeholder="Enter last name">
                @error('last_name')
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mg-b-15">
                <label for="salary" class="form-label">Salary</label>
                <input type="text" id="salary" name="salary"
                       class="form-control @error('salary') is-invalid @endError" value="{{ old('salary', $employee->salary) }}"
                       placeholder="Enter salary">
                @error('salary')
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mg-b-15">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email"
                       class="form-control @error('email') is-invalid @endError" value="{{ old('email', $employee->email) }}"
                       placeholder="Enter email">
                @error('email')
                <span class="invalid-feedback text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mg-b-15">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" id="phone" name="phone"
                       class="form-control @error('phone') is-invalid @endError" value="{{ old('phone', $employee->phone) }}"
                       placeholder="Enter phone">
                @error('phone')
                <span class="invalid-feedback text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mg-b-15">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password"
                       class="form-control @error('password') is-invalid @endError"
                       placeholder="Enter password">
                @error('password')
                <span class="invalid-feedback text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mg-b-15">
                <label for="manager_id" class="form-label">Manager</label>
                <select id="manager_id" name="manager_id"
                       class="form-control @error('manager_id') is-invalid @endError">
                    @if(!$employee->id)
                        <option value="">Select Manager</option>
                    @endif
                    @foreach($managers as $manager)
                        <option value="{{ $manager->id }}"
                                @if($manager->id == old('manager_id', $employee->manager_id)) selected @endif>
                            {{ $manager->full_name }}
                        </option>
                    @endforeach
                </select>
                @error('manager_id')
                <span class="invalid-feedback text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mg-b-15">
                <label for="department_id" class="form-label">Department</label>
                <select id="department_id" name="department_id"
                       class="form-control @error('department_id') is-invalid @endError">
                    @if(!$employee->id)
                        <option value="">Select Department</option>
                    @endif
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}"
                                @if($department->id == old('department_id', $employee->department_id)) selected @endif>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')
                <span class="invalid-feedback text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mg-b-15">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" name="image"
                       class="form-control @error('image') is-invalid @endError">
                @error('image')
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
