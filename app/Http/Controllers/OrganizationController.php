<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Product;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view('organizations.index', compact('organizations'));
    }

    public function show($organization_name)
    {
        $organization = Organization::where('name', $organization_name)->firstOrFail();
        $products = Product::where('organization_id', $organization->id)->get();

        return view('organization.products', compact('organization', 'products'));
    }
}
