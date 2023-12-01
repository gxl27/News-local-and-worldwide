<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;

class CountryController extends Controller
{
    // resorces
    public function index()
    {
        $countries = Country::all();

        return response()->json([
            'countries' => $countries,
        ]);
    }
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'link' => 'required',
        ]);
        $country = Country::create($data);

        return response()->json([
            'message' => 'Country created successfully.',
            'country' => $country,
        ]);
    }
    public function edit(Country $country)
    {
        return response()->json([
            'country' => $country,
        ]);
    }
    public function update(Country $country)
    {
        $data = request()->validate([
            'name' => 'required',
            'link' => 'required',
        ]);
        $country->update($data);

        return response()->json([
            'message' => 'Country updated successfully.',
            'country' => $country,
        ]);
    }
    public function destroy(Country $country)
    {
        $country->delete();

        return response()->json([
            'message' => 'Country deleted successfully.',
        ]);
    }
    
}
