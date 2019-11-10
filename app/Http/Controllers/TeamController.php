<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\ProjectTeam;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    private $model , $projectTeam;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Team $model , ProjectTeam $projectTeam)
    {
        $this->model = $model;
        $this->projectTeam = $projectTeam;
    }


    /**
     * view  index of teams
     */
    public function index()
    {
        $requestData = $this->model->all()->toArray();

        return View('teams.view', compact('requestData'));
    }

    /**
     * view create page to store team
     */
    public function create()
    {

        return View('teams.add');
    }

    /**
     * store team
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:teams|max:255',
            'teamLeaderId' => 'required',
        ]);

        $model =$this->model;
        $model->name = $request->name;
        $model->teamLeaderId = $request->teamLeaderId;
        $model->save();

        if($request->projectId){
            $model->projects()->create($request->projectId);
        }


        return redirect('/teams')->with('success','Stored successfully');
    }

    /**
     * view edit page to update team
     */
    public function edit($id)
    {
        $requestData = $this->model->find($id);

        return View('teams.edit', compact('requestData'));
    }

    /**
     * update team
     */
    public function update($id , Request $request)
    {
        $request->validate([
            'name' => 'required|unique:teams|max:255',
            'teamLeaderId' => 'required',
        ]);

        $model = $this->model->find($id);
        $model->projects()->delete();
        $model->name = $request->name;
        $model->teamLeaderId = $request->teamLeaderId;
        $model->save();

        if($request->projectId){
            $model->projects()->create($request->projectId);
        }

        return redirect('/teams')->with('success','Updated successfully');
    }

    /**
     * delete teams
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return redirect('/teams')->with('success','Deleted successfully');
    }

}
