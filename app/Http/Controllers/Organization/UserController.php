<?php

namespace App\Http\Controllers\Organization;

use App\Enum\PageModeEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $mode = PageModeEnum::INDEX;

        return view('users.organization.user', compact('mode'));
    }

    public function create()
    {
        $mode = PageModeEnum::CREATE;

        return view('users.organization.user', compact('mode'));
    }

    public function edit(User $user)
    {
        $mode = PageModeEnum::EDIT;

        return view('users.organization.user', compact('mode', 'user'));
    }
}
