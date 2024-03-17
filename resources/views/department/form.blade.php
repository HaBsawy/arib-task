@extends('master')
@section('title', isset($department->id) ? 'Edit Department' : 'Create Department')

@section('breadcrumb')
    {{ $department->id ? Breadcrumbs::render('departments.edit', $department) : Breadcrumbs::render('departments.create') }}
@endsection

@section('content')

    <div class="bg-white-9 pd-20 rounded">
        <form id="departments_form" class="" method="POST" action="{{ isset($department->id) ? route('departments.update', $department->id) : route('departments.store') }}">
            @if(isset($department->id)) @method('PUT') @endif
            @csrf
            <div class="form-group mg-b-15">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name"
                       class="form-control @error('name') is-invalid @endError" value="{{ old('name', $department->name) }}"
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
