<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $action;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Action $action)
    {
        $this->action = $action;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
