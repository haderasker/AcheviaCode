<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectCity;

class ProjectCityController extends Controller
{
    private $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProjectCity $model)
    {
        $this->model = $model;
    }

    /**
     * view  index of projects
     */
    public function index()
    {
        $requestData = $this->model->all()->toArray();

        return View('project_cities.view', compact('requestData'));
    }

    /**
     * view create page to store project
     */
    public function create()
    {

        return View('project_cities.add');
    }

    /**
     * store project
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:projects|max:255',
        ]);

        $model =$this->model;
        $model->name = $request->name;
        $model->description = $request->description;
        $model->save();

        return redirect('/project_cities')->with('success','Stored successfully');
    }

    /**
     * view edit page to update project
     */
    public function edit($id)
    {
        $requestData = $this->model->find($id);

        return View('project_cities.edit', compact('requestData'));
    }

    /**
     * update project
     */
    public function update($id , Request $request)
    {
        $request->validate([
            'name' => 'required|unique:projects|max:255',
        ]);

        $model = $this->model->find($id);
        $model->name = $request->name;
        $model->description = $request->description;
        $model->save();

        return redirect('/project_cities')->with('success','Updated successfully');
    }

    /**
     * delete project
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return redirect('/project_cities')->with('success','Deleted successfully');
    }

}
