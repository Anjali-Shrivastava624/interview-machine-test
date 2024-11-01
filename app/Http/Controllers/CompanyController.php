<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    // Show all companies
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $companies = Company::all();

            return DataTables::of($companies)
                ->addIndexColumn()
                ->addColumn('action', function ($company) {
                    return '
                    <a href="' . route('companies.show', $company->id) . '" class="btn btn-xs btn-info">View</a>
                    <a href="' . route('companies.edit', $company->id) . '" class="btn btn-xs btn-primary">Edit</a>
                            <form action="' . route('companies.destroy', $company->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                            </form>';
                })
                ->make(true);
        }

        return view('companies.index');
    }

    public function create()
    {
        return view('companies.create');
    }

    // Store a new company
    public function store(StoreCompanyRequest $request)
    {
        $this->authorize('create', Company::class);

        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        } else {
            $data['logo'] = null;
        }

        Company::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'logo' => $data['logo'],
            'website' => $data['website'],
        ]);
        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }
    public function update(StoreCompanyRequest $request, Company $company)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {

            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company->update($data);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    // Delete a specific company
    public function destroy(Company $company)
    {
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
