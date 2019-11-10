<?php

namespace App\Http\Controllers;

use App\Models\Method;
use Illuminate\Http\Request;

class MethodController extends Controller
{
    private $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Method $model)
    {
        $this->model = $model;
    }


    /**
     * view  index of methods
     */
    public function index()
    {
        $requestData = $this->model->all()->toArray();

        return View('methods.view', compact('requestData'));
    }

    /**
     * view create page to store method
     */
    public function create()
    {

        return View('methods.add');
    }

    /**
     * store method
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:methods|max:255',
        ]);

        $model =$this->model;
        $model->name = $request->name;
        $model->save();

        return redirect('/methods')->with('success','Stored successfully');
    }

    /**
     * view edit page to update method
     */
    public function edit($id)
    {
        $requestData = $this->model->find($id);

        return View('methods.edit', compact('requestData'));
    }

    /**
     * update method
     */
    public function update($id , Request $request)
    {
        $request->validate([
            'name' => 'required|unique:methods|max:255',
        ]);

        $model = $this->model->find($id);
        $model->name = $request->name;
        $model->save();

        return redirect('/methods')->with('success','Updated successfully');
    }

    /**
     * delete method
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return redirect('/methods')->with('success','Deleted successfully');
    }

}
