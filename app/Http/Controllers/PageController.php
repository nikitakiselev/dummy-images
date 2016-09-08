<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Front page
     *
     * @return \Illuminate\View\View
     */
    public function front()
    {
        return view('pages.front');
    }
}
