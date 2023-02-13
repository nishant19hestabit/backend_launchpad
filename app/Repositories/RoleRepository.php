<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function all()
    {
        $roles = Role::all();
        if (count($roles) > 0) {
            return Response::json(['status' => true, 'message' => 'Roles founded successfully', 'data' => $roles], 200);
        } else {
            return Response::json(['status' => false, 'message' => 'No role found'], 200);
        }
    }
}
