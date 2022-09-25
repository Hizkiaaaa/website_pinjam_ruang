<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        return view('about_us.index', [
            'title' => 'About Us',
            'active' => 'about_us'
        ]);
    }
}