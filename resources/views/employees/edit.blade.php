@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Employee</h1>

        <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="first_name">First Name<span class="text-danger">*</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $employee->first_name }}">
                @error('first_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-group">
                <label for="last_name">Last Name<span class="text-danger">*</span></label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $employee->last_name }}">
                @error('last_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-group">
                <label for="company_id">Company<span class="text-danger">*</span></label>
                <select name="company_id" id="company_id" class="form-control" required>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ $employee->company_id == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
                @error('company_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $employee->email }}">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ $employee->phone }}">
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                @if($employee->profile_picture)
                    <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="Profile Picture" width="50">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
