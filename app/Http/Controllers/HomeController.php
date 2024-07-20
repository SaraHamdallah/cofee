<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Beverage;
use App\Models\Category;
use App\Models\Contact;



class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    

    public function drinks(){
        $title = "Drink Menu";
        $categories = Category::take(3)->get();          
        $beverages = Beverage::get()->where('published', true);// Fetch only the published courses
        $specialbeverages = Beverage::where('special', true)
                             ->where('published', true)
                             ->get();
        return view('drinks', compact('title', 'categories', 'beverages', 'specialbeverages'));
    }


    

}
