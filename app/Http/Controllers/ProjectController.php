<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Project $model)
    {
        $this->model = $model;
    }

    /**
     * view  index of projects
     */
    public function index()
    {
        $requestData = $this->model->all()->toArray();

        return View('projects.view', compact('requestData'));
    }

    /**
     * view create page to store project
     */
    public function create()
    {

        return View('projects.add');
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

        return redirect('/projects')->with('success','Stored successfully');
    }

    /**
     * view edit page to update project
     */
    public function edit($id)
    {
        $requestData = $this->model->find($id);

        return View('projects.edit', compact('requestData'));
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

        return redirect('/projects')->with('success','Updated successfully');
    }

    /**
     * delete project
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return redirect('/projects')->with('success','Deleted successfully');
    }

}
