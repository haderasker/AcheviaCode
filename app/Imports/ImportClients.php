<?php
/**
 * Created by PhpStorm.
 * User: hadeer
 * Date: 11/14/19
 * Time: 3:56 PM
 */

namespace App\Imports;

use App\Models\ClientDetail;
use App\Models\ClientHistory;
use App\Models\UserNote;
use App\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;


class ImportClients implements ToModel
{
    private $myData;

    public function __construct($data)
    {
        $this->myData = $data;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $cols = $this->myData;
        $phone = $row[$cols['codeCol'] - 1] . $row[$cols['phoneCol'] - 1];
        $userExist = User::where('phone', $phone)->orWhere('email', $row[$cols['emailCol'] - 1])->first();

        if ($userExist) {
            $userExist->duplicated = $userExist->duplicated + 1;

            return $userExist;
        }

        $userData = array(
            'name' => $row[$cols['nameCol'] - 1],
            'phone' => $phone,
            'email' => $row[$cols['emailCol'] - 1],
            'roleId' => 5,
            'createdBy' => Auth::user()->id,

        );
        $job = '';
        $note = '';

        if (@$row[$cols['jobCol']]) {
            $job = $row[$cols['jobCol'] - 1];
        }
        if (@$row[$cols['notesCol']]) {
            $note = $row[$cols['notesCol'] - 1];
        }

        $user = User::create($userData);

        $clientDetailsData = array(
            'userId' => $user->id,
            'typeClient' => 0,
            'jobTitle' => $job,
            'notes' => $note,
            'platform' => $cols['platformCol'],
            'projectId' => $cols['projectCol'],
            'campaignId' => $cols['campaignCol'],
            'marketerId' => $cols['marketerCol'],
            'assignToSaleManId' => $cols['saleCol'],
        );
        $state = '';
        if($cols['saleCol'] !=0){
            $state = 'assigned';
        }
//
//        //insert record
        $user = ClientDetail::create($clientDetailsData);
        $history = ClientHistory::create([
            'userId' => $user->id,
            'actionId' => 0,
            'summery' => $user->summery,
            'viaMethodId' => $user->viaMethodId,
            'createdBy' => Auth::user()->id,
            'state' => $state,
        ]);
        if ($note != '') {
            $note = UserNote::create(['userId' => $user->id, 'note' => $note]);
        }
        return $user;
    }
}

