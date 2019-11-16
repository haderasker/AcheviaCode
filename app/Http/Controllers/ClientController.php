<?php

namespace App\Http\Controllers;

use App\Imports\ImportClients;
use App\Models\Action;
use App\Models\ClientDetail;
use App\Models\ClientHistory;
use App\Models\Method;
use App\Models\Project;
use App\Models\ProjectCity;
use App\Models\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;


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
            'email' => 'required|max:100',
            'userName' => 'required',
            'phone' => 'required|numeric|regex:/[0-9]/',
            'roleId' => 'required',
            'createdBy' => 'required',
            'projectId' => 'integer',
            'countryCode' => 'required',
        ]);

        $created = $this->user->save($request);
        $user = $created['user'];
        $exist = $created['exist'];
        if ($exist == 'no') {
            $lastAssign = 0;
            if ($request->assignToSaleManId != 0) {
                $lastAssign = 1;
            }
            $clientDetailsData = array(
                'userId' => $user->id,
                'projectId' => $request->projectId,
                'projectCity' => $request->projectCity,
                'space' => $request->space,
                'jobTitle' => $request->jobTitle,
                'address' => $request->address,
                'notes' => $request->notes,
                'gender' => $request->gender,
                'interestsUserProjects' => $request->projectId,
                'typeClient' => 0,
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
            $user = $this->clientModel->create($clientDetailsData);
        }

        return $user;
    }

    /**
     * view create page to store user
     */
    public function quickCreate()
    {

        return View('clients.quick_create');
    }

    /**
     * store user
     */
    public function quickStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:100',
            'roleId' => 'required',
            'createdBy' => 'required',
            'phone' => 'required|numeric|regex:/[0-9]/',
            'countryCode' => 'required',
        ]);

        $created = $this->user->save($request);
        $user = $created['user'];
        $exist = $created['exist'];
        if ($exist == 'no') {
            $clientDetailsData = array(
                'userId' => $user->id,
                'jobTitle' => $request->jobTitle,
                'gender' => $request->gender,
                'typeClient' => 0,
            );
//
//        //insert record
            $user = $this->clientModel->create($clientDetailsData);
        }

        return $user;
    }

    /**
     * view edit page to update user
     */
    public function edit($id)
    {
        $requestData = $this->model->where('id', $id)->with('detail')->whereHas('detail')->first()->toArray();
        $methods = Method::all()->toArray();
        $actions = Action::all()->toArray();
        if ($requestData['detail']['projectId']) {
            $cities = [];
            $project = $this->project::find($requestData['detail']['projectId']);
            $projectName = $project->name;
            $cityName = ProjectCity::where('id', $project->cityId)->first()['name'];

            $teams = $project->teams()->get()->toArray();

            foreach ($teams as $team) {

                $team = Team::find($team['id']);

                $allSales = $team->sales()->get(['id', 'name'])->toArray();

                foreach ($allSales as $sale) {
                    $sales[$sale['id']]['id'] = $sale['id'];
                    $sales[$sale['id']]['name'] = $sale['name'];
                }
            }
        } else {
            $projectName = '';
            $cityName = '';
            $cities = $this->city->all()->toArray();
            $sales = $this->model->where('roleId', 4)->get(['id', 'name']);
        }

        return View('clients.edit', compact('requestData', 'cityName', 'projectName', 'sales', 'actions', 'methods', 'cities'));

    }

    /**
     * update user
     */
    public function update(Request $request)
    {
//        $updated = $this->user->updateUser($id, $request);

        $client = $this->clientModel->where('userId', $request->id)->first()->toArray();

        $notificationDate = $client['newActionDate'];
        $notificationTime = $client['notificationTime'];
        if ($request->notificationDate != null) {
            $notificationDate = date("Y-m-d", strtotime($request->notificationDate));
        }
        if ($request->notificationTime != null) {
            $notificationTime = $request->notificationTime;
        }

        $transferred = 0;
        if ($client['assignToSaleManId'] != $request->assignToSaleManId) {
            $transferred = 1;
        }
        $newActionDate = $client['newActionDate'];
        $newActionTime = $client['newActionTime'];
        if ($client['actionId'] == null && $client['newActionDate'] == null && $client['newActionTime'] == null && $request->actionId != '0') {
            $newActionDate = now()->format('Y-m-d');
            $newActionTime = now()->format('H:i:s');
        }
        $lastAssign = 0;
        if ($request->assignToSaleManId != 0) {
            $lastAssign = 1;
        }
        $assignedDate = $client['assignedDate'];
        $assignedTime = $client['assignedTime'];
        if ($client['assignToSaleManId'] == 0 && $client['assignedDate'] == null && $client['assignedTime'] == null && $request->assignToSaleManId != 0) {
            $assignedDate = now()->format('Y-m-d');
            $assignedTime = now()->format('H:i:s');
        }

        $via_method = $client['viaMethodId'];
        if ($request->via_method) {
            $via_method = $request->via_method;
        }

        $actionId = $client['actionId'];
        if ($request->actionId != 0) {
            $actionId = $request->actionId;
        }

        $summery = $client['summery'];
        if ($request->summery) {
            $summery = $request->summery;
        }
        $jobTitle = $client['jobTitle'];
        if ($request->jobTitle) {

            $jobTitle = $request->jobTitle;
        }

        $projectId = $client['projectId'];
        if ($request->projectId) {

            $projectId = $request->projectId;
        }

        $projectCity = $client['projectCity'];
        if ($request->projectCity) {

            $projectCity = $request->projectCity;
        }

        $address = $client['address'];
        if ($request->address) {

            $address = $request->address;
        }

        $ZipCode = $client['ZipCode'];
        if ($request->ZipCode) {

            $ZipCode = $request->ZipCode;
        }

        $region = $client['region'];
        if ($request->region) {

            $region = $request->region;
        }

        $country = $client['country'];
        if ($request->country) {

            $country = $request->country;
        }
        $city = $client['city'];
        if ($request->city) {

            $city = $request->city;
        }

        $clientDetailsData = array(
            'assignToSaleManId' => $request->assignToSaleManId,
            'notes' => $request->notes,
            'space' => $request->space,
            'viaMethodId' => $via_method,
            'actionId' => $actionId,
            'summery' => $summery,
            'newActionDate' => $newActionDate,
            'newActionTime' => $newActionTime,
            'notificationDate' => $notificationDate,
            'notificationTime' => $notificationTime,
            'transferred' => $transferred,
            'projectId' => $projectId,
            'interestsUserProjects' => $projectId,
            'projectCity' => $projectCity,
            'address' => $address,
            'ZipCode' => $ZipCode,
            'region' => $region,
            'country' => $country,
            'city' => $city,
            'typeClient' => 0,
            'jobTitle' => $jobTitle,
            'lastAssigned' => $lastAssign,
            'assignedDate' => $assignedDate,
            'assignedTime' => $assignedTime,
        );

        //update record
        $this->clientModel->where('userId', $request->id)->update($clientDetailsData);

        $history = ClientHistory::create(['userId' => $request->id, 'actionId' => $request->actionId]);

        return redirect('/home')->withMessage('Updated successfully');
    }

    /**
     * delete user
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        $model->detail()->delete();

        $model->delete();

        return redirect('/home')->withMessage('Deleted successfully');
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
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();

        if ($ext != 'csv') {
            return back()->with('failed', 'Please Upload File With CSV Extension.');
        }

        $data = Excel::import(new ImportClients($request->all()), request()->file('file'));

        return redirect('/home')->withMessage('Insert Records successfully');
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
