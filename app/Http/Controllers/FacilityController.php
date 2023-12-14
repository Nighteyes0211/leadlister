<?php

namespace App\Http\Controllers;

use App\Enum\PageModeEnum;
use App\Http\Livewire\Users\Org\Facility;
use App\Models\Facilty;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $mode = PageModeEnum::INDEX;
        return view('users.organization.facility', compact('mode'));
    }
    public function create()
    {
        $mode = PageModeEnum::CREATE;
        return view('users.organization.facility', compact('mode'));
    }
    public function edit($id)
    {
        $mode = PageModeEnum::EDIT;
        $facilty = Facilty::find($id);
        return view('users.organization.facility', compact('mode', 'facilty'));
    }
}
