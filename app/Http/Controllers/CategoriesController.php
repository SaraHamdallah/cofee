<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Categories";
        $title1 = "Category";
        $categories = Category::get();
        return view('dash/categories', compact('title', 'title1', 'categories'));    #return view('name of view', compact('name of variables')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Categories";
        $title1 = "Category";
        return view('dash/addCategory', compact('title', 'title1')); //name of the form
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = $this->errMsg();
            $data = $request->validate([
                'cat_name' => 'required|string|max:255',
            ],$messages);

            Category::create($data);
            return redirect('categories')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //$category = Category::with('beverages')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Categories";
        $title1 = "Category";
        $category = Category::findOrFail($id);
        return view('dash.editCategory', compact('title', 'title1', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = $this->errMsg();
            $data = $request->validate([
                'cat_name' => 'required|string|max:255',
            ],$messages);

        # Update user  data
        Category::where('id', $id)->update($data);
        return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function errMsg(){
        return [
            'cat_name.required' => 'The name field is required.',
        ];
    }
}
