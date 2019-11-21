<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::all();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $min_one_category = Categories::all()->count();
        if (!$min_one_category) {
            DB::statement('ALTER TABLE categories AUTO_INCREMENT = 1');
        }
        $category = new Categories();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Category Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        return view('categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $category)
    {
        return view('categories.create')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Categories $category)
    {
        $category->name = $request->name;
        $category->save();

        // $category->update([
        //     'name' => $request->name
        // ]);

        session()->flash('success', 'Category Updated!');
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $category)
    {
        if ($category->posts) {
            if ($category->posts->count() > 0) {
                session()->flash('warning', 'Category have related post. Can\'t be deleted!');
                return redirect()->back();
            }
        }
        $category->delete();
        session()->flash('warning', 'Category deleted successfully!');
        return redirect(route('categories.index'));
    }
}
