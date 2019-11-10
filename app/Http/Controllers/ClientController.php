<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ClientDetail;
use App\Models\Method;
use App\Models\Project;
use App\Models\ProjectCity;
use App\Models\Team;
use App\User;
use App\Models\ClientHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class ClientController extends Controller
{
    private $model, $clientModel, $user, $project, $city;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $model, ClientDetail $clientModel, UserController $user, Project $project, ProjectCity $city)
    {
        $this->model = $model;
        $this->user = $user;
        $this->clientModel = $clientModel;
        $this->project = $project;
        $this->city = $city;
    }

    /**
     * view  index of users
     */
    public function index()
    {
        $requestData = $this->model->with('detail')->whereHas('detail')->get()->toArray();

        return View('clients.view', compact('requestData'));
    }

    /**
     * view create page to store user
     */
    public function create()
    {
        $projects = $this->project->all()->toArray();
        $cities = $this->city->all()->toArray();

        return View('clients.add', compact('projects', 'cities'));

    }

    /**
     * store user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'userName' => 'required',
            'phone' => 'required',
            'roleId' => 'required',
            'createdBy' => 'required',
            'projectId' => 'integer',
        ]);

        $created = $this->user->save($request);
        $lastAssign = 0;
        if ($request->assignToSaleManId != 0) {
            $lastAssign = 1;
        }
        $clientDetailsData = array(
            'userId' => $created->id,
            'projectId' => $request->projectId,
            'projectCity' => $request->projectCity,
            'space' => $request->space,
            'jobTitle' => $request->jobTitle,
            'address' => $request->address,
            'notes' => $request->notes,
            'gender' => $request->gender,
            'interestsUserProjects' => $request->interestsUserProjects,
            'typeClient' => $request->typeClient,
            'addedClientFrom' => $request->addedClientFrom,
            'addedClientPlatform' => $request->addedClientPlatform,
            'addedClientLink' => $request->addedClientLink,
            'ZipCode' => $request->ZipCode,
            'ip' => $request->ip,
            'region' => $request->region,
            'country' => $request->country,
            'city' => $request->city,
            'assignToSaleManId' => $request->assignToSaleManId,
            'lastAssigned' => $lastAssign,
            'assignedDate' => now()->format('Y-m-d'),
            'assignedTime' => now()->format('H:i:s'),
        );
//
//        //insert record
        $creatClient = $this->clientModel->create($clientDetailsData);

        return $creatClient;
    }

    /**
     * view edit page to update user
     */
    public function edit($id)
    {
        $requestData = $this->model->where('id', $id)->with('detail')->whereHas('detail')->first()->toArray();
        $methods = Method::all()->toArray();
        $actions = Action::all()->toArray();

        $project = $this->project::find($requestData['detail']['projectId']);

        $teams = $project->teams()->get()->toArray();

        foreach ($teams as $team) {

            $team = Team::find($team['id']);

            $allSales = $team->sales()->get(['id', 'name'])->toArray();

            foreach ($allSales as $sale) {
                $sales[$sale['id']]['id'] = $sale['id'];
                $sales[$sale['id']]['name'] = $sale['name'];
            }
        }
        return View('clients.edit', compact('requestData', 'sales', 'actions', 'methods'));
    }

    /**
     * update user
     */
    public function update(Request $request)
    {

//        $updated = $this->user->updateUser($id, $request);

        $client = $this->clientModel->where('userId', $request->id)->first()->toArray();

        $notificationDate = date("Y-m-d", strtotime($request->notificationDate));
        $transferred = 0;
        if ($client['assignToSaleManId'] != $request->assignToSaleManId) {
            $transferred = 1;
        }
        $newActionDate = null;
        $newActionTime = null;
        if ($client['actionId'] == null && $client['newActionDate'] == null  && $client['newActionTime'] == null && $request->actionId != '0' ) {
            $newActionDate = now()->format('Y-m-d');
            $newActionTime = now()->format('H:i:s') ;
        }
        $clientDetailsData = array(
            'viaMethodId' => $request->via_method,
            'actionId' => $request->actionId,
            'newActionDate' => $newActionDate,
            'newActionTime' => $newActionTime,
            'summery' => $request->summery,
            'notificationDate' => $notificationDate,
            'notificationTime' => $request->notificationTime,
            'assignToSaleManId' => $request->assignToSaleManId,
            'transferred' => $transferred,
        );

        //update record
        $this->clientModel->where('userId', $request->id)->update($clientDetailsData);

        $history =  ClientHistory::create(['userId' => $request->id , 'actionId' =>$request->actionId ]);

        return redirect('/')->with('success', 'Updated successfully');
    }

    /**
     * delete user
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        $model->detail()->delete();

        $model->delete();

        return redirect('/clients')->with('success', 'Deleted successfully');
    }

    /**
     * uploadView user
     */
    public function uploadView()
    {

        return View('clients.upload');
    }

    /**
     * upload user
     */
    public function upload()
    {

        return redirect('/clients')->with('success', 'Deleted successfully');
    }

    public function dropDown(Request $request)
    {
        $cityId = $request->option;

        $city = $this->city::find($cityId);
        $projects = $city->project();

        return Response::make($projects->get(['id', 'name']));

    }

    public function dropDownSale(Request $request)
    {
        $sales = [];
        $projectId = $request->option;

        $project = $this->project::find($projectId);

        $teams = $project->teams()->get()->toArray();

        foreach ($teams as $team) {

            $team = Team::find($team['id']);

            $allSales = $team->sales()->get(['id', 'name'])->toArray();

            foreach ($allSales as $sale) {
                $sales[$sale['id']]['id'] = $sale['id'];
                $sales[$sale['id']]['name'] = $sale['name'];
            }
        }


        return $sales;

    }

}
