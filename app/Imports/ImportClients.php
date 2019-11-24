<?php
/**
 * Created by PhpStorm.
 * User: hadeer
 * Date: 11/14/19
 * Time: 3:56 PM
 */

namespace App\Imports;

use App\Models\ClientDetail;
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
        $userExist = User::where('phone', $row[$cols['phoneCol'] - 1])->orWhere('email', $row[$cols['emailCol'] - 1])->first();

        if ($userExist) {
            $userExist->duplicated = $userExist->duplicated + 1;

            return $userExist;
        }

        $phone =  $row[$cols['codeCol'] - 1] .  $row[$cols['phoneCol'] - 1];

        $userData = array(
            'name' => $row[$cols['nameCol'] - 1],
            'phone' => $phone,
            'email' => $row[$cols['emailCol'] - 1],
            'roleId' => 5,
            'createdBy' => Auth::user()->id,

        );

        $user = User::create($userData);

        $clientDetailsData = array(
            'userId' => $user->id,
            'typeClient' => 0,
            'jobTitle' => $row[$cols['jobCol'] - 1],
            'notes' => $row[$cols['notesCol'] - 1],
            'platform'=> $cols['platformCol'],
            'projectId'=> $cols['projectCol'],
            'campaignId'=> $cols['campaignCol'] ,
            'marketerId'=> $cols['marketerCol'] ,
            'assignToSaleManId' => $cols['saleCol'],
        );
//
//        //insert record
        $user = ClientDetail::create($clientDetailsData);

        return $user;
    }
}

