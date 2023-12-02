<?php

namespace App\Http\Controllers\Properties;

use Illuminate\Http\Request;
use App\Models\Categories\Category;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate();
        return view('backend.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        try {
            $category->save();
        Session::flash('success', 'Category successfully created');
        return back();
        } catch (QueryException $exception) {
            Session::flash('error', 'Failed to create category');
        return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('backend.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            Session::flash('error', 'Category not found');
            return back();
        }
        $category->name = $request->name;
        $category->save();
        Session::flash('success', 'Category successfully updated');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            Session::flash('error', 'Category not found');
            return back();
        }

        if ($category->properties->isEmpty()) {
            try {
                $category->delete();
                Session::flash('success', 'Category deleted successfully');
                return redirect()->route('category.index');
            } catch (QueryException $exception) {
                Session::flash('error', 'Failed to be deleted');
                return back();
            }
            // Perform any additional actions or redirection as needed
        } else {
            Session::flash('error', 'Cant delete category has property');
            return back();
        }
    }
}
