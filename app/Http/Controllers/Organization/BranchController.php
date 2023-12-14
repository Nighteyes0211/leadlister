<?php

namespace App\Http\Controllers\Organization;

use App\Enum\PageModeEnum;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $mode = PageModeEnum::INDEX;
        return view('users.organization.branch', compact('mode'));
    }

    public function create()
    {
        $mode = PageModeEnum::CREATE;
        return view('users.organization.branch', compact('mode'));
    }

    public function edit(Branch $branch)
    {
        $mode = PageModeEnum::EDIT;
        return view('users.organization.branch', compact('mode', 'branch'));
    }
}
