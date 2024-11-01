<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $employees = Employee::all();

            return DataTables::of($employees)
                ->addIndexColumn()
                ->addColumn('profile_picture', function ($employee) {
                    $imageUrl = $employee->profile_picture ? asset('storage/' . $employee->profile_picture) : 'default-image.jpg';
                    return '<img src="' . $imageUrl . '" alt="profile picture" width="50" height="50">';
                })
                ->addColumn('action', function ($employee) {
                    return '
                        <a href="' . route('employees.show', $employee->id) . '" class="btn btn-xs btn-info">View</a>
                        <a href="' . route('employees.edit', $employee->id) . '" class="btn btn-xs btn-primary">Edit</a>
                        <form action="' . route('employees.destroy', $employee->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                        </form>';
                })
                ->rawColumns(['profile_picture', 'action'])
                ->make(true);
        }

        return view('employees.index');
    }


    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    // Store a new employee
    public function store(StoreEmployeeRequest $request)
    {
        $this->authorize('create', Employee::class);

        $data = $request->validated();

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        } else {
            $data['profile_picture'] = null;
        }

        Employee::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'company_id' => $data['company_id'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'profile_picture' => $data['profile_picture'],
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }


    // employee details
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    // Update
    public function update(StoreEmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_picture')) {

            if ($employee->profile_picture) {
                Storage::disk('public')->delete($employee->profile_picture);
            }
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    // Delete  employee
    public function destroy(Employee $employee)
    {
        if ($employee->profile_picture) {
            Storage::disk('public')->delete($employee->profile_picture);
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
