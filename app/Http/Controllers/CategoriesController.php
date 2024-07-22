<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Contact;

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
        $nMessages = Contact::where('seen', 0)->get();
        return view('dash/categories', compact('title', 'title1', 'categories', 'nMessages'));    #return view('name of view', compact('name of variables')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Categories";
        $title1 = "Category";
        $nMessages = Contact::where('seen', 0)->get();

        return view('dash/addCategory', compact('title', 'title1', 'nMessages')); #name of the form
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
        return redirect('admin/categories')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Categories";
        $title1 = "Category";
        $nMessages = Contact::where('seen', 0)->get();
        $category = Category::findOrFail($id);
        
        return view('dash.editCategory', compact('title', 'title1', 'nMessages', 'category'));
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

        # Update Category  data
        Category::where('id', $id)->update($data);
        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        if ($category->beverages()->count() > 0) {
            return redirect('admin/categories')->withErrors(['error' => 'Category cannot be deleted because it has associated beverages.']);
        }

        $category->delete();
        return redirect('admin/categories')->with('success', 'Category deleted successfully.');
    }

    
    public function errMsg(){
        return [
            'cat_name.required' => 'The name field is required.',
        ];
    }
}
