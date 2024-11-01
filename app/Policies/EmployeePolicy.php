<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Employee;

class EmployeePolicy
{
    public function create(User $user)
    {
        return true; // or your logic to authorize users
    }

    public function update(User $user, Employee $employee)
    {
        return true; // or your logic to authorize users
    }

    public function delete(User $user, Employee $employee)
    {
        return true; // or your logic to authorize users
    }
}
