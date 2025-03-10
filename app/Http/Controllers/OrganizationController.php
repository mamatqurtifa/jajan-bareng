<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Product;
use Carbon\Carbon;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view('organizations.index', compact('organizations'));
    }

    public function show($name, Request $request)
    {
        $organization = Organization::where('name', $name)->firstOrFail();
        $currentDate = $request->input('date', Carbon::today()->toDateString());
        $products = Product::where('organization_id', $organization->id)
                            ->where('available_date', $currentDate)
                            ->get();

        return view('organization.products', compact('organization', 'products', 'currentDate'));
    }
}
