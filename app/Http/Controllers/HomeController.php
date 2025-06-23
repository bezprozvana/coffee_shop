<?php

namespace App\Http\Controllers;

use App\Models\Category; 

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with(['products' => function($query) {
            $query->limit(6); 
        }])->get();

        return view('home.index', compact('categories'));
    }
}