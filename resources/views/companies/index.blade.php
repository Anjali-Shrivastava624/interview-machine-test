@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Companies</h1>
            <a href="{{ route('companies.create') }}" class="btn btn-primary">Add Company</a>
        </div>
        <table id="companies-table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>

        <script>
            $(document).ready(function() {
                $('#companies-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('companies.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'logo',
                            name: 'logo',
                            render: function(data) {
                                return `<img src="/storage/${data}" alt="Logo" width="50" height="50">`;
                            }
                        },
                        {
                            data: 'website',
                            name: 'website'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            });
        </script>
    </div>
@endsection
