<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ClientDetail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $action, $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Action $action, UserController $user)
    {
        $this->action = $action;
        $this->user = $user;
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welCome()
    {
        return view('welcome');
    }

    /**
     * store user
     */
    public function landingStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'phone' => 'required',
            'roleId' => 'required',
        ]);

        $created = $this->user->save($request);
        $clientDetailsData = array(
            'userId' => $created->id,
            'jobTitle' => $request->jobTitle,
            'gender' => $request->gender,
            'typeClient' => 0,
            'addedClientFrom' => 'landingPage',
            'addedClientLink' => url('/'),
        );
//
//        //insert record
        $creatClient = ClientDetail::create($clientDetailsData);

        return $creatClient;
    }
}
