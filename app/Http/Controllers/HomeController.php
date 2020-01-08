<?php

namespace App\Http\Controllers;

use App\Guild;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the cup points.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        $guilds = Guild::orderBy('points', 'desc')->get();
        return view('welcome', compact('guilds'));
    }
}
