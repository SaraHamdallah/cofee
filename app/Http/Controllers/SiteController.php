<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beverage;
use App\Models\Category;

class SiteController extends Controller
{
    public function drinks(){
        $title = "Drink Menu";
        $categories = Category::get();          
        $beverages = Beverage::get()->where('published', true);// Fetch only the published courses
        return view('drinks', compact('title', 'categories', 'beverages'));
    }
}
