<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Brand::paginate($request->limit);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Response::api('Brand created',
            Brand::create($request->validate(['title' => 'required|unique:brands']))
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return Response::api('Brand retrieved', $brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        return Response::api('Brand updated',
            $brand->update($request->validate([
                'title' => ['required', Rule::unique('brands')->ignore($brand)]
            ]))
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return Response::api('Brand deleted');
    }
}
