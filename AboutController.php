<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    // Show About page
    public function index()
    {
        return view('about');
    }

    // AJAX JSON endpoint
    public function data()
    {
        return response()->json([
            "title" => "About Basilico",
            "message" => "Authentic Italian flavors brought to Mauritius.",
            "speciality" => "Spaghetti & Italian Cuisine"
        ]);
    }
}
