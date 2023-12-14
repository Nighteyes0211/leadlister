<?php

namespace App\Http\Controllers\Organization;

use App\Enum\PageModeEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $mode = PageModeEnum::INDEX;
        return view('users.organization.role', compact('mode'));
    }

    public function create()
    {
        $mode = PageModeEnum::CREATE;
        return view('users.organization.role', compact('mode'));
    }

    public function edit(Role $role)
    {
        $mode = PageModeEnum::EDIT;
        return view('users.organization.role', compact('role', 'mode'));
    }
}

