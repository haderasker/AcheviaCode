<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\ProjectTeam;
use Illuminate\Http\Request;
use App\User;

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

    public function getAllData(){

        $data = $this->model->all()->toArray();
        $key = 0;
        foreach ($data as $one) {
            $teamLeaderName = User::where('id',$one['teamLeaderId'])->pluck('name','id')->toArray();
            $data[$key]['teamLeaderName'] = $teamLeaderName[$one['teamLeaderId']];
            $key = $key + 1;
        }

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

    /**
     * view create page to store team
     */
    public function create()
    {

        $teamleaders = User::where('roleId', 3)->get()->toArray();
        return View('teams.add',compact('teamleaders'));
    }

    /**
     * store team
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:teams|max:255',
            'teamLeaderId' => 'required|not_in:0',
        ]);

        $teamLeaderId = $request->teamLeaderId;
        if($request->teamLeaderId == 0){
            $teamLeaderId = null;
        }

        $model =$this->model;
        $model->name = $request->name;
        $model->teamLeaderId = $teamLeaderId;
        $model->save();

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
