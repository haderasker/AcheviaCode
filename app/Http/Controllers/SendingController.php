<?php

namespace App\Http\Controllers;

use App\Models\Sending;
use App\Models\SendingTypes;
use Illuminate\Http\Request;

class SendingController extends Controller
{
    private $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Sending $model)
    {
        $this->model = $model;
    }

    /**
     * view  index of actions
     */
    public function index()
    {
        $requestData = $this->model->all()->toArray();

        return View('sending.view', compact('requestData'));
    }

    /**
     * view create page to store Action
     */
    public function create()
    {
        $sendingTypes = SendingTypes::all();
        return View('sending.add',compact('sendingTypes'));
    }

    /**
     * store Action
     */
    public function store(Request $request)
    {

        $request->validate([
            'senderId' => 'required',
            'sendingTypeId' =>'required',
            'body' =>'required',
            'type' =>'required',
        ]);

        $model =$this->model;
        $model->senderId = $request->senderId;
        $model->sendingTypeId = $request->sendingTypeId;
        $model->body = $request->body;
        $model->type = $request->type;
        $model->active = 1;
        $model->save();

        return redirect('/sending')->with('success','Stored successfully');
    }

    /**
     * view edit page to update Action
     */
    public function edit($id)
    {
        $requestData = $this->model->find($id);
        $sendingTypes = SendingTypes::all();

        return View('sending.edit', compact('requestData', 'sendingTypes'));
    }

    /**
     * update Action
     */
    public function update(Request $request)
    {
        $request->validate([
            'senderId' => 'required',
            'sendingTypeId' =>'required',
            'body' =>'required',
            'type' =>'required',
        ]);

        $model = $this->model->find($request->id);
        $model->senderId = $request->senderId;
        $model->sendingTypeId = $request->sendingTypeId;
        $model->body = $request->body;
        $model->type = $request->type;
        $model->active = 1;
        $model->save();

        return redirect('/sending')->with('success','Updated successfully');
    }

    public function getAllData(){

        $data = $this->model->all()->toArray();

        $meta = [
            "page" => 1,
            "pages" => 1,
            "perpage" => -1,
            "total" => 40,
            "sort" => "asc",
            "field" => "RecordID",
        ];

        $requestData = [
            'meta' => $meta,
            'data' => $data,
        ];

        return $requestData;

    }
}
