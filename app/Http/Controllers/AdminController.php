<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function dashboard(?string $tab = null)
    {
        return view('admin.dashboard', ['tab' => $tab]);
    }
}


