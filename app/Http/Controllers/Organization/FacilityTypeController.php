<?php

namespace App\Http\Controllers\Organization;

use App\Enum\PageModeEnum;
use App\Http\Controllers\Controller;
use App\Models\FacilityType;
use Illuminate\Http\Request;

class FacilityTypeController extends Controller
{
    public function index()
    {
        $mode = PageModeEnum::INDEX;
        return view('users.organization.facility-type', compact('mode'));
    }

    public function create()
    {
        $mode = PageModeEnum::CREATE;
        return view('users.organization.facility-type', compact('mode'));
    }

    public function edit(FacilityType $facilityType)
    {
        $mode = PageModeEnum::EDIT;
        return view('users.organization.facility-type', compact('mode', 'facilityType'));
    }
}
