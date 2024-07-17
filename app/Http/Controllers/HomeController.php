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
    public function index()
    {
        $title = "Users";
        $title1 = "User";
        $users = User::get();
        $nMessages = Contact::where('seen', 0)->get();
        return view('dash/users', compact('title', 'title1', 'users', 'nMessages'));    #return view('name of view', compact('name of variables')); 
    }
    

    public function drinks(){
        $title = "Drink Menu";
        $categories = Category::take(3)->get();          
        $beverages = Beverage::get()->where('published', true);// Fetch only the published courses
        $specialbeverages = Beverage::get()->where('special', true);
        return view('drinks', compact('title', 'categories', 'beverages', 'specialbeverages'));
    }


    

}
