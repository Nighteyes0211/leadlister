<?php

namespace App\Http\Controllers\Organization;

use App\Enum\PageModeEnum;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $mode = PageModeEnum::INDEX;
        return view('users.organization.product', compact('mode'));
    }

    public function create()
    {
        $mode = PageModeEnum::CREATE;
        return view('users.organization.product', compact('mode'));
    }


    public function edit(Product $product)
    {
        $mode = PageModeEnum::EDIT;
        return view('users.organization.product', compact('mode', 'product'));
    }
}
