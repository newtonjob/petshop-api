<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Response::api('Categories retrieved',
            Category::paginate($request->limit)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Response::api('Category created',
            Category::create($request->validate(['title' => 'required|unique:categories']))
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return Response::api('Category retrieved', $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        return Response::api('Category updated',
            $category->update($request->validate([
                'title' => ['required', Rule::unique('categories')->ignore($category)]
            ]))
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return Response::api('Category deleted');
    }
}
