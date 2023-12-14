<?php

namespace App\Http\Controllers\Organization;

use App\Enum\PageModeEnum;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $mode = PageModeEnum::INDEX;
        return view('users.organization.contact', compact('mode'));
    }

    public function create()
    {
        $mode = PageModeEnum::CREATE;
        return view('users.organization.contact', compact('mode'));
    }

    public function edit(Contact $contact)
    {
        $mode = PageModeEnum::EDIT;
        return view('users.organization.contact', compact('mode', 'contact'));
    }
}
