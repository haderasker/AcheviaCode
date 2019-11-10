<?php

namespace App\Http\Controllers;

use App\Models\ClientDetail;
use App\User;

class ReportController extends Controller
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

    public function teamReport($id)
    {

        $salesWithClinets = $this->model->where('teamId', $id)->with('clients')->whereHas('clients')->get()->toArray();
        $requestData = array();
        foreach ($salesWithClinets as $sales) {
            foreach ($sales['clients'] as $clients) {
                $requestData[$sales['id']][$clients['detail']['actionId']]['users'][] = $clients['detail']['userId'];
                $requestData[$sales['id']][$clients['detail']['actionId']]['count'] = count($requestData[$sales['id']][$clients['detail']['actionId']]['users']);
            }
        }

        return View('reports.team_report', compact('requestData'));
    }

    public function saleManReport($id)
    {

        $salesWithClinets = $this->model->where('id', $id)->with('clients')->whereHas('clients')->get()->toArray();

        $requestData = array();
        foreach ($salesWithClinets as $sales) {
            foreach ($sales['clients'] as $clients) {
                $requestData[$sales['id']][$clients['detail']['actionId']]['users'][] = $clients['detail']['userId'];
                $requestData[$sales['id']][$clients['detail']['actionId']]['count'] = count($requestData[$sales['id']][$clients['detail']['actionId']]['users']);
            }
        }

        return View('reports.sale_man_report', compact('requestData'));
    }

    public function ViewAllReports($id)
    {
        //check this user is root or admin

        $teamLeaders = $this->model->where('roleId', 3)->get()->toArray();
        $salesMen = $this->model->where('roleId', 4)->get()->toArray();
        return View('reports.view_all_reports', compact('teamLeaders','salesMen'));
    }

    public function AllReports($id)
    {

        //check this user is root or admin

        $salesWithClinets = $this->model->where('id', $id)->with('clients')->whereHas('clients')->get()->toArray();

        $requestData = array();
        foreach ($salesWithClinets as $sales) {
            foreach ($sales['clients'] as $clients) {
                $requestData[$sales['id']][$clients['detail']['actionId']]['users'][] = $clients['detail']['userId'];
                $requestData[$sales['id']][$clients['detail']['actionId']]['count'] = count($requestData[$sales['id']][$clients['detail']['actionId']]['users']);
            }
        }

        return View('reports.all_reports', compact('requestData'));
    }
}
