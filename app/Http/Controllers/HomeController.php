<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ClientDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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


    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !(Hash::check($request->password, $user->password))) {

            return  ['message' => 'Invalid Credentials'];
        }

        if ($user && Hash::check($request->password, $user->password)) {
            //generate api token
            $this->reGenerateApiToken($user);
            return $user;
        }

    }

    public function reGenerateApiToken($user)
    {
        $api_token = md5(bcrypt($user->email));
       $user->update(['api_token' => $api_token]);
    }

    public function facebookForm(Request $request)
    {
        $phone =  ltrim($request->phone, '+');
        $userExist = User::where('phone', $phone)->orWhere('email', $request->email)->first();
        if ($userExist) {
            $model = User::find($userExist['id']);
            $countDuplicated = $userExist['duplicated'];
            $model->duplicated = $countDuplicated + 1;
            $user = $model->save();
            return $model;

        } else {

            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $phone,
                'roleId' => 5,
                'userStatus' => 1,
                'active' => 1,
                'createdBy' => 0,
            ];

            $user = User::create($userData);

            $clientDetailsData = [
                'userId' => $user->id,
            ];

            //insert record
            $userClient = ClientDetail::create($clientDetailsData);

            return $user;
        }
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
