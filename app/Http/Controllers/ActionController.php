<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    private $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Action $model)
    {
        $this->model = $model;
    }

    /**
     * view  index of actions
     */
    public function index()
    {
        $requestData = $this->model->all()->toArray();

        return View('actions.view', compact('requestData'));
    }

    /**
     * view create page to store Action
     */
    public function create()
    {

        return View('actions.add');
    }

    /**
     * store Action
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:actions|max:255',
        ]);

        $model =$this->model;
        $model->name = $request->name;
        $model->order = 0;

        $model->save();

        return redirect('/actions')->with('success','Stored successfully');
    }

    /**
     * view edit page to update Action
     */
    public function edit($id)
    {
        $requestData = $this->model->find($id);

        return View('actions.edit', compact('requestData'));
    }

    /**
     * update Action
     */
    public function update($id , Request $request)
    {
        $request->validate([
            'name' => 'required|unique:actions|max:255',
        ]);

        $model = $this->model->find($id);
        $model->name = $request->name;

        $model->save();

        return redirect('/actions')->with('success','Updated successfully');
    }

    /**
     * delete Action
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return redirect('/actions')->with('success','Deleted successfully');
    }

}
