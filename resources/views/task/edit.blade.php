@extends('master')
@section('title', 'Edit Task')

@section('breadcrumb')
    {{ Breadcrumbs::render('tasks.edit', $task) }}
@endsection

@section('content')

    <div class="bg-white-9 pd-20 rounded">
        <form id="tasks_form" class="" method="POST" action="{{ route('tasks.update', $task->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group mg-b-15">
                <label for="status" class="form-label">Manager</label>
                <select id="status" name="status"
                       class="form-control @error('status') is-invalid @endError">
                    <option value="open" @if(old('status', $task->status) == 'open') selected @endif>Open</option>
                    <option value="in progress" @if(old('status', $task->status) == 'in progress') selected @endif>In Progress</option>
                    <option value="resolved" @if(old('status', $task->status) == 'resolved') selected @endif>Resolved</option>
                </select>
                @error('status')
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
