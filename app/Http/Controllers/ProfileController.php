<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function userProfile()
    {
        return view('profile.user-profile');
    }

    public function serviceProfile()
    {
        return view('profile.service-profile');
    }

    public function businessProfile()
    {
        return view('profile.business-profile');
    }

    public function userEdit(string $uuid)
    {
        return view('profile.user-edit', ['uuid' => $uuid]);
    }

    public function businessEdit(string $uuid)
    {
        return view('profile.business-edit', ['uuid' => $uuid]);
    }

    public function viewBusiness(string $uuid)
    {
        return view('profile.view-business', ['uuid' => $uuid]);
    }
}


