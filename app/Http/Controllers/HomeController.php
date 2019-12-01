<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ClientDetail;
use Illuminate\Http\Request;
use App\User;

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

    public function me()
    {
        $users = User::all()->toArray();
        return view('test',compact('users'));
    }

    /**
     * store user
     */
    public function landingStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:100',
            'phone' => 'required|numeric|regex:/[0-9]/',
            'roleId' => 'required',
            'countryCode' => 'required',
        ]);

        $created = $this->user->save($request);
        $user = $created['user'];
        $exist = $created['exist'];
        if ($exist == 'no') {
            $clientDetailsData = array(
                'userId' => $user->id,
                'jobTitle' => $request->jobTitle,
                'notes' => $request->notes,
                'typeClient' => 0,
                'addedClientFrom' => 'landingPage',
                'addedClientLink' => url('/'),
            );
            $user = ClientDetail::create($clientDetailsData);
        }
//
//        //insert record


        return $user;
    }
}
