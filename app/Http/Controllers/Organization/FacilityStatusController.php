<?php

namespace App\Http\Controllers\Organization;

use App\Enum\PageModeEnum;
use App\Http\Controllers\Controller;
use App\Models\FacilityStatus;
use Illuminate\Http\Request;

class FacilityStatusController extends Controller
{
    public function index()
    {
        $mode = PageModeEnum::INDEX;
        return view('users.organization.facility-status', compact('mode'));
    }

    public function create()
    {
        $mode = PageModeEnum::CREATE;
        return view('users.organization.facility-status', compact('mode'));
    }

    public function edit(FacilityStatus $facility_status)
    {
        $mode = PageModeEnum::EDIT;
        return view('users.organization.facility-status', compact('mode', 'facility_status'));
    }
}
