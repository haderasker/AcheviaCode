<?php

namespace App\Listeners;

use App\Events\ClientDetailCreatedEvent;
use App\Models\ClientDetail;
use App\Models\Project;
use App\Models\RotationAuto;
use App\Models\Team;
use App\User;

class AssignSaleManToClientAutoListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle(ClientDetailCreatedEvent $event)
    {
        $client = $event->user;
        if ($client['assignToSaleManId'] != 0) {
            return;
        } else {
            $rotationType = RotationAuto::first()['type'];
            if ($rotationType == 1 && $client['projectId']) {
                $project = Project::find($client['projectId']);
                $teams = $project->teams()->get()->toArray();
                $sales = [];
                foreach ($teams as $team) {

                    $team = Team::find($team['id']);

                    $sales[] = $team->sales()->get()->toArray();
                }




                dd($sales);
            }
        }


        $rotationType = RotationAuto::first()['type'];
        if ($rotationType == 1) {
            if ($client['projectId']) {
                $project = Project::find($client['projectId']);
                $teams = $project->teams()->get()->toArray();
                $sales = [];

                foreach ($teams as $team) {

                    $team = Team::find($team['id']);

                    $allSales = $team->sales()->get()->toArray();
                    $key = 0;
                    foreach ($allSales as $sale) {
                        $sales[$sale['id']]['id'] = $sale['id'];
                        $sales[$sale['id']]['name'] = $sale['name'];
                        $sales[$sale['id']]['lastAssigned'] = $sale['lastAssigned'];
                        $sales[$sale['id']]['weight'] = $sale['weight'];
                        $sales[$sale['id']]['assign'] = $sale['assign'];
                    }
                }


                $notAssigned = [];

                foreach ($sales as $sale) {
                    if ($sale['lastAssigned'] == 0) {
                        $notAssigned[] = $sale['id'];
                    }
                }
                $counter = count($notAssigned);

                if ($counter == 0) {

                    foreach ($sales as $sale) {
                        User::where('id', $sale['id'])->update(['lastAssigned' => 0]);
                    }

                }

                foreach ($sales as $sale) {

                    if (($sale['lastAssigned'] == 0 || $sale['weight'] > $sale['lastAssigned']) && $sale['assign'] == 0) {
                        ClientDetail::where('userId', $client['userId'])->update(['assignToSaleManId' => $sale['id']]);
                        User::where('id', $sale['id'])->update(['lastAssigned' => ($sale['lastAssigned'] + 1)]);

                    }
                }


            }

        }


    }
}