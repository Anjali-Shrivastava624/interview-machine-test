<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Company $company)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Company $company)
    {
        return true;
    }

    public function delete(User $user, Company $company)
    {
        return true;
    }
}

