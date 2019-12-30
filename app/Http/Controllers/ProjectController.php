<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCity;
use App\Models\ProjectTeam;
use App\Models\Team;
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
        $requestData = $this->model::where('idParent', null)->get()->toArray();

        return View('projects.view', compact('requestData'));
    }

    public function getAllData(Request $request)
    {
        $paginationOptions = $request->input('pagination');
        if($paginationOptions['perpage'] == -1){
            $paginationOptions['perpage'] = 0;
        }

        $data = $this->model::where('idParent', null)
            ->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);

        $meta = [
            "page" => $data->currentPage(),
            "pages" => intval($data->total() / $data->perPage()),
            "perpage" => $data->perPage(),
            "total" => $data->total(),
            "sort" => "asc",
            "field" => "id",
        ];

        $requestData = [
            'meta' => $meta,
            'data' => $data->items(),
        ];

        return $requestData;

    }

    /**
     * view create page to store project
     */
    public function create()
    {
        $teams = Team::all()->toArray();
        return View('projects.add', compact('teams'));
    }


    public function dropDownCity(Request $request)
    {
        $country = $request->option;

        $cities = ProjectCity::where('country', $country)->get();

        return $cities;

    }

    /**
     * store project
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'teams' => 'required',
        ]);
        $imageName = null;
        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);
        }

        $cityId = $request->cityId;
        if($request->cityId == 0){
            $cityId = null;
        }

        $data = array(
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
            'country' => $request->country,
            'cityId' => $cityId,
            'location' => $request->location,

        );
//
//        //insert record
        $project = $this->model->create($data);

//        foreach ($request->links as $link){
//            $linkData = [
//                'link' => $link,
//                'projectId' =>$project->id,
//            ];
//
//            ProjectLink::create($linkData);
//        }

        foreach ($request->teams as $team) {

            $teamData = [
                'teamId' => $team,
                'projectId' => $project->id,
            ];

            ProjectTeam::create($teamData);
        }

        return redirect('/projects')->with('success', 'Stored successfully');
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
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|unique:projects|max:255',
        ]);

        $model = $this->model->find($id);
        $model->name = $request->name;
        $model->description = $request->description;
        $model->save();

        return redirect('/projects')->with('success', 'Updated successfully');
    }

    /**
     * delete project
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return redirect('/projects')->with('success', 'Deleted successfully');
    }

    /**
     * view create page to store project
     */
    public function createCustom()
    {
        $projects = Project::where('idParent' , null)->get()->toArray();
        return View('projects.custom', compact('projects'));
    }


    public function dropDownTeams(Request $request)
    {
        $project = Project::find($request->option);
        $teams = $project->teams()->get();
        return $teams;

    }

    /**
     * store project
     */
    public function storeCustom(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'projectId' => 'required|integer',
            'teams' => 'required',
        ]);


        $data = array(
            'name' => $request->name,
            'idParent' => $request->projectId,
        );
//
//        //insert record
        $project = $this->model->create($data);

        foreach ($request->teams as $team) {

            $teamData = [
                'teamId' => $team,
                'projectId' => $project->id,
            ];

            ProjectTeam::create($teamData);
        }

        return redirect('/projects')->with('success', 'Stored successfully');
    }

}
