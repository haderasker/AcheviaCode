<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ClientDetail;
use App\Models\Method;
use App\Models\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $sales = User::where('roleId', 4)->get()->toArray();

        return View('client_action.all_clients', compact('actionId', 'sales'));
    }

    public function getAllData()
    {
        $userId = Auth::user()->id;

        if ((Auth::user()->role->name == 'admin')) {
            $data = $this->model->with('detail')->whereHas('detail')->get()->toArray();
        } elseif (Auth::user()->role->name == 'sale Man') {
            $data = $this->model->with('detail')->whereHas('detail', function ($q) use ($userId) {
                $q->where('assignToSaleManId', '!=', 0)->where('assignToSaleManId', $userId);
            })->get()->toArray();
        }
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
     * view  index newRequests
     */
    public function newRequests()
    {
        $actionId = 0;
        $sales = User::where('roleId', 4)->get()->toArray();

        return View('client_action.new_requests', compact('actionId', 'sales'));
    }

    /**
     * view  index newClients
     */
    public function getNewRequestsData()
    {
        if ((Auth::user()->role->name == 'admin')) {
            $data = $this->model->with('detail')->whereHas('detail', function ($q) {
                $q->where('actionId', null)->where('assignToSaleManId', '=', 0);
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
    }


    /**
     * view  index newClients
     */
    public function newClients()
    {
        $sales = $this->model->where('roleId', 4)->get(['id', 'name']);
        $actionId = 0;
        $methods = Method::all()->toArray();
        $actions = Action::all()->sortBy('order')->toArray();
        if ((Auth::user()->role->name == 'sale Man')) {
            $sales = $this->model->where('id', Auth::user()->id)->get(['id', 'name']);
        }
        return View('client_action.new_clients', compact('sales', 'actionId', 'actions', 'methods'));
    }


    /**
     * view  index actionClient
     */
    public function actionClient($id)
    {
        $sales = $this->model->where('roleId', 4)->get(['id', 'name']);
        $actionId = $id;
//        $requestData = $this->getData($actionId)['data'];
        $methods = Method::all()->toArray();
        $actions = Action::all()->sortBy('order')->toArray();
        if ((Auth::user()->role->name == 'sale Man')) {
            $sales = $this->model->where('id', Auth::user()->id)->get(['id', 'name']);
        }
        return View('client_action.action_client', compact('sales', 'actionId', 'actions', 'methods'));

    }


    /**
     * view  index get data
     */
    public function getData($id)
    {
        $userId = Auth::user()->id;

        if ($id == 0) {
            $id = null;
        }

        if ((Auth::user()->role->name == 'admin')) {
            $data = $this->model->with('detail')->whereHas('detail', function ($q) use ($id) {
                $q->where('actionId', $id)->where('assignToSaleManId', '!=', 0)->where('transferred', '=', 0);
            })->where('duplicated', '=', 1)->get()->toArray();

        } elseif ((Auth::user()->role->name == 'sale Man')) {
            $data = $this->model->with('detail')->whereHas('detail', function ($q) use ($id, $userId) {
                $q->where('actionId', $id)->where('assignToSaleManId', '!=', 0)->where('assignToSaleManId', $userId)->where('transferred', '=', 0);
            })->where('duplicated', '=', 1)->get()->toArray();
        }

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
     * view  index duplicated
     */
    public function duplicated()
    {
        $actionId = 'duplicated';
        $methods = Method::all()->toArray();
        $actions = Action::all()->sortBy('order')->toArray();
        $sales = $this->model->where('roleId', 4)->get(['id', 'name']);

        return View('client_action.duplicated', compact('actionId', 'sales', 'actions', 'methods'));
    }

    public function getDuplicatedData()
    {
        $userId = Auth::user()->id;

        if ((Auth::user()->role->name == 'admin')) {
            $data = $this->model->where('duplicated', '>', 1)->with('detail')->whereHas('detail')->get()->toArray();
        } elseif ((Auth::user()->role->name == 'sale Man')) {
            $data = $this->model->where('duplicated', '>', 1)->with('detail')->whereHas('detail', function ($q) use ($userId) {
                $q->where('assignToSaleManId', $userId);
            })->get()->toArray();
        }
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
     * view  index transfered
     */
    public function transfered()
    {
        $actionId = 'transfered';
        $methods = Method::all()->toArray();
        $actions = Action::all()->sortBy('order')->toArray();
        $sales = $this->model->where('roleId', 4)->get(['id', 'name']);

        return View('client_action.transfered', compact('actionId', 'sales', 'actions', 'methods'));
    }

    public function getTransferedData()
    {
        $userId = Auth::user()->id;

        if ((Auth::user()->role->name == 'admin')) {
            $data = $this->model->with('detail')->whereHas('detail', function ($q) {
                $q->where('transferred', 1);
            })->get()->toArray();
        } elseif ((Auth::user()->role->name == 'sale Man')) {
            $data = $this->model->with('detail')->whereHas('detail', function ($q) use ($userId) {
                $q->where('transferred', 1)->where('assignToSaleManId', $userId);
            })->get()->toArray();
        }
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

    public function assignUser(Request $request)
    {
        $request->validate([
            'ids' => 'required',
            'sale' => 'required',
        ]);

        $clients = $request->ids;
        $saleId = $request->sale;
        foreach ($clients as $client) {
            ClientDetail::where('userId', $client)->update(['assignToSaleManId' => $saleId]);
        }
        return 'done';
    }

    public function loadHistory(Request $request)
    {
        $id = $request->option;

        $user = $this->model->where('id', $id)->with('history')->whereHas('history')->first()->toArray();
        $data = $user['history'];
        $key = 0;
        foreach ($data as $one) {
            $actionName = Action::where('id', $one['actionId'])->first()['name'];
            $createdBy = User::where('id', $one['createdBy'])->first()['name'];
            $name = $user['name'];
            $data[$key]['actionName'] = $actionName;
            $data[$key]['createdBy'] = $createdBy;
            $data[$key]['name'] = $name;
            $key = $key + 1;
        }
        return $data;
    }

}
