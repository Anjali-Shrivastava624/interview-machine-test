@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Employee Details</h1>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $employee->first_name }} {{ $employee->last_name }}</h5>

                <p><strong>Company:</strong> {{ $employee->company->name ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $employee->email ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $employee->phone ?? 'N/A' }}</p>

                <p><strong>Profile Picture:</strong></p>
                @if ($employee->profile_picture)
                    <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="Profile Picture" width="100">
                @else
                    <p>No Profile Picture</p>
                @endif

                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary mt-3">Edit Employee</a>
                <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-3"
                        onclick="return confirm('Are you sure you want to delete this employee?')">Delete Employee</button>
                </form>
            </div>
        </div>

        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to Employee List</a>
    </div>
@endsection
