<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ClientDetail;
use App\Models\Project;
use App\User;
use App\Models\Method;
use App\Models\ProjectCity;
use App\Models\Team;

class ClientActionController extends Controller
{
    private $model, $clientModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $model, ClientDetail $clientModel)
    {
        $this->model = $model;
        $this->clientModel = $clientModel;
    }

    /**
     * view  index allClients
     */
    public function allClients()
    {
        $actionId = 'all';

        return View('client_action.all_clients', compact('actionId'));
    }

    public function getAllData()
    {
        $data = $this->model->with('detail')->whereHas('detail')->get()->toArray();

        $key = 0;
        foreach ($data as $one) {
            $projectName = Project::where('id', $one['detail']['projectId'])->first()['name'];
            $saleName = User::where('id', $one['detail']['assignToSaleManId'])->first()['name'];
            $data[$key]['detail']['projectName'] = $projectName;
            $data[$key]['detail']['saleName'] = $saleName;
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
     * view  index allClients
     */
    public function newRequests()
    {
        $actionId = 0;

        return View('client_action.new_requests', compact('actionId'));
    }

    /**
     * view  index newClients
     */
    public function getNewRequestsData()
    {
        $data = $this->model->with('detail')->whereHas('detail', function ($q) {
            $q->where('actionId', null)->where('assignToSaleManId', '=' , 0);
        })->get()->toArray();

        $key = 0;
        foreach ($data as $one) {
            $projectName = Project::where('id', $one['detail']['projectId'])->first()['name'];
            $saleName = User::where('id', $one['detail']['assignToSaleManId'])->first()['name'];
            $data[$key]['detail']['projectName'] = $projectName;
            $data[$key]['detail']['saleName'] = $saleName;
            $key = $key + 1;
        }

        $meta = [
            "page" => 1,
            "pages" => 1,
            "perpage" => -1,
            "total" => 40,
            "sort" => "asc",
            "field" => "id",
        ];

        $requestData = [
            'meta' => $meta,
            'data' => $data,
        ];

        return $requestData;
    }



    /**
     * view  index actionClient
     */
    public function actionClient($id)
    {
        $actionId = $id;
//        $requestData = $this->getData($actionId)['data'];
        $methods = Method::all()->toArray();
        $actions = Action::all()->toArray();
        $sales = $this->model->where('roleId', 4)->get(['id', 'name']);
        return View('client_action.action_client', compact('sales','actionId',  'actions', 'methods'));

    }

    /**
     * view  index newClients
     */
    public function newClients()
    {
        $actionId = 0;
        $methods = Method::all()->toArray();
        $actions = Action::all()->toArray();
        $sales = $this->model->where('roleId', 4)->get(['id', 'name']);
        return View('client_action.new_clients',  compact('sales','actionId',  'actions', 'methods'));
    }

    /**
     * view  index newClients
     */
    public function getData($id)
    {
        if ($id == 0) {
            $id = null;
        }
        $data = $this->model->with('detail')->whereHas('detail', function ($q) use ($id) {
            $q->where('actionId', $id)->where('assignToSaleManId', '!=' , 0);
        })->get()->toArray();

        $key = 0;
        foreach ($data as $one) {
            $projectName = Project::where('id', $one['detail']['projectId'])->first()['name'];
            $saleName = User::where('id', $one['detail']['assignToSaleManId'])->first()['name'];
            $data[$key]['detail']['projectName'] = $projectName;
            $data[$key]['detail']['saleName'] = $saleName;
            $key = $key + 1;
        }

        $meta = [
            "page" => 1,
            "pages" => 1,
            "perpage" => -1,
            "total" => 40,
            "sort" => "asc",
            "field" => "id",
        ];

        $requestData = [
            'meta' => $meta,
            'data' => $data,
        ];

        return $requestData;
    }


    /**
     * view  index history
     */
    public function history($id)
    {
        $userId = $id;
        return View('client_action.history_client', compact('userId'));
    }

    public function getHistory($id)
    {
        $user = $this->model->where('id', $id)->with('history')->whereHas('history')->first()->toArray();
        $data = $user['history'];
        $key = 0;
        foreach ($data as $one) {
            $actionName = Action::where('id', $one['actionId'])->first()['name'];
            $name = $user['name'];
            $data[$key]['actionName'] = $actionName;
            $data[$key]['name'] = $name;
            $key = $key + 1;
        }


        $meta = [
            "page" => 1,
            "pages" => 1,
            "perpage" => -1,
            "total" => 40,
            "sort" => "asc",
            "field" => "id",
        ];

        $requestData = [
            'meta' => $meta,
            'data' => $data,
        ];


        return $requestData;
    }

    /**
     * view  index duplicated
     */
    public function duplicated()
    {
        $actionId = 'duplicated';

        return View('client_action.duplicated', compact('actionId'));
    }

    public function getDuplicatedData()
    {
        $data = $this->model->where('duplicated', '>', 1)->with('detail')->whereHas('detail')->get()->toArray();

        $key = 0;
        foreach ($data as $one) {
            $projectName = Project::where('id', $one['detail']['projectId'])->first()['name'];
            $saleName = User::where('id', $one['detail']['assignToSaleManId'])->first()['name'];
            $data[$key]['detail']['projectName'] = $projectName;
            $data[$key]['detail']['saleName'] = $saleName;
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
     * view  index duplicated
     */
    public function transfered()
    {
        $actionId = 'transfered';

        return View('client_action.transfered', compact('actionId'));
    }

    public function getTransferedData()
    {
        $data = $this->model->with('detail')->whereHas('detail', function ($q) {
            $q->where('transferred', 1);
        })->get()->toArray();

        $key = 0;
        foreach ($data as $one) {
            $projectName = Project::where('id', $one['detail']['projectId'])->first()['name'];
            $saleName = User::where('id', $one['detail']['assignToSaleManId'])->first()['name'];
            $data[$key]['detail']['projectName'] = $projectName;
            $data[$key]['detail']['saleName'] = $saleName;
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

//    /**
//     * view  index following
//     */
//    public function following()
//    {
//        $requestData = $this->model->with('detail')->whereHas('detail')->get()->toArray();
//
//        return View('client_action.all_clients', compact('requestData'));
//    }
//
//    /**
//     * view  index cancellation
//     */
//    public function cancellation()
//    {
//        $requestData = $this->model->with('detail')->whereHas('detail')->get()->toArray();
//
//        return View('client_action.all_clients', compact('requestData'));
//    }
//
//    /**
//     * view  index comingVisit
//     */
//    public function comingVisit()
//    {
//        $requestData = $this->model->with('detail')->whereHas('detail')->get()->toArray();
//
//        return View('client_action.all_clients', compact('requestData'));
//    }
//
//    /**
//     * view  index doneDeal
//     */
//    public function doneDeal()
//    {
//        $requestData = $this->model->with('detail')->whereHas('detail')->get()->toArray();
//
//        return View('client_action.all_clients', compact('requestData'));
//    }
//
//    /**
//     * view  index meeting
//     */
//    public function meeting()
//    {
//        $requestData = $this->model->with('detail')->whereHas('detail')->get()->toArray();
//
//        return View('client_action.all_clients', compact('requestData'));
//    }
//
//
//
//    /**
//     * view  index notInterested
//     */
//    public function notInterested()
//    {
//        $requestData = $this->model->with('detail')->whereHas('detail')->get()->toArray();
//
//        return View('client_action.all_clients', compact('requestData'));
//    }


}
