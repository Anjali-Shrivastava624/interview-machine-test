@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Employees</h1>
            <a href="{{ route('employees.create') }}" class="btn btn-primary">Add Employee</a>
        </div>
        <table id="employees-table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Profile Picture</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#employees-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('employees.index') }}",
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'first_name', name: 'first_name' },
                        { data: 'last_name', name: 'last_name' },
                        { data: 'email', name: 'email' },
                        { data: 'profile_picture', name: 'profile_picture', orderable: false, searchable: false },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });
            });
        </script>
    </div>
@endsection
