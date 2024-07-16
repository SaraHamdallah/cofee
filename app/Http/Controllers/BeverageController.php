<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Beverage;


class BeverageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Redirect to the login page if not authenticated
            return redirect('admin/login')->with('error', 'You must be logged in to access this page.');
        }

        $title = "Beverages";
        $title1 = "Beverage";
        $beverages = Beverage::get();
        return view('dash/beverages', compact('title', 'title1', 'beverages'));    #return view('name of view', compact('name of variables')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Redirect to the login page if not authenticated
            return redirect('admin/login')->with('error', 'You must be logged in to access this page.');
        }

        $title = "Beverages";
        $title1 = "Beverage";
        return view('dash/addBeverage', compact('title', 'title1')); //name of the form

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Log incoming request data
        // \Log::info('Request data:', $request->all());
        $messages = $this->errMsg();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|file|mimes:jpeg,jpg,png',
            'category_id' => 'required|exists:categories,id',
        ], $messages);

        # Set the boolean values for published and special
        $data['published'] = isset($request->published); #laravel wiil transfer if is set check boxx =1 and non = 0
        $data['special'] = isset($request->special); #laravel wiil transfer if is set check boxx =1 and non = 0

        #method is used to check if a file upload exists in the request
        if ($request->hasFile('image')) {
            $imgExt = $request->image->getClientOriginalExtension();
            $fileName = time() . '.' . $imgExt;
            $path = 'assets/images';
            $request->image->move($path, $fileName);
            $data['image'] = $fileName;

            // \Log::info('Image uploaded:', ['path' => $path, 'fileName' => $fileName]);

        }else {
        # Handle the case where no file was uploaded (set a default image or return an error response)
        return redirect()->back()->with('error', 'No file uploaded.');
        }
    
        Beverage::create($data);
        // \Log::info('Beverage created successfully:', $data);
        return redirect('admin/beverages')->with('success', 'Beverage created successfully.');
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
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Redirect to the login page if not authenticated
            return redirect('admin/login')->with('error', 'You must be logged in to access this page.');
        }
        
        $title = "Beverages";
        $title1 = "Beverage";
        $beverage = Beverage::findOrFail($id);
        return view('dash.editBeverage', compact('title', 'title1', 'beverage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //\Log::info('Request data:', $request->all());
        $messages = $this->errMsg();
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'price' => 'required|numeric',
            'published'=>'nullable|boolean',// Validate the 'active' field as boolean
            'special'=>'nullable|boolean',// Validate the 'active' field as boolean
            'image' => 'nullable|file|mimes:jpeg,jpg,png',
            'category_id' => 'required|exists:categories,id',
        ],$messages);

        $data['published'] = (bool)$data['published'];
        $data['special'] = (bool)$data['special'];
        //$data['special'] = isset($request->special) ? (bool)$request->special : false;

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $path = 'assets/images';
            $image->move($path, $fileName);
            $data['image'] = $fileName; // Store the image path in the database
        }
        # Update user  data
        Beverage::where('id', $id)->update($data);
        // \Log::info('Beverage updated successfully:', $data);
        return redirect('admin/beverages');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Beverage::destroy($id);
        return redirect('admin/beverages')->with('success', 'Beverage deleted successfully.');
    }
        
        



    public function errMsg(){
        return [
            'title.required' => 'The title field is required.',
            'content.required' => 'The content field is required.',
            'price.required' => 'The price field is required.',
            'image.required' => 'The image field is required.',
            'category_id.required' => 'The category field is required.',
        ];
    }
}
