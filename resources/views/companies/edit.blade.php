@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Company</h1>
        <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name<span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $company->name }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email<span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $company->email }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" name="logo" id="logo" class="form-control">
                @if ($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" width="50">
                @endif
            </div>

            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" name="website" id="website" class="form-control" value="{{ $company->website }}">
                @error('website')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
