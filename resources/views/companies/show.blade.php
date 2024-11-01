@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Company Details</h1>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $company->name }}</h5>
                
                <p><strong>Email:</strong> {{ $company->email ?? 'N/A' }}</p>
                <p><strong>Website:</strong> 
                    @if($company->website)
                        <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                    @else
                        N/A
                    @endif
                </p>
                
                <p><strong>Logo:</strong></p>
                @if($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" width="100">
                @else
                    <p>No Logo Available</p>
                @endif

                <a href="{{ route('companies.edit', $company) }}" class="btn btn-primary mt-3">Edit Company</a>
                <form action="{{ route('companies.destroy', $company) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure you want to delete this company?')">Delete Company</button>
                </form>
            </div>
        </div>

        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back to Company List</a>
    </div>
@endsection
