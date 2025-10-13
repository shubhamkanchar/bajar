<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function blog()
    {
        return view('home.blog');
    }

    public function blogShow(string $slug)
    {
        return view('home.blog', ['slug' => $slug]);
    }

    public function page(string $slug)
    {
        return view('home.page', ['slug' => $slug]);
    }
}
