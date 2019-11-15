<?php
/**
 * Created by PhpStorm.
 * User: hadeer
 * Date: 11/14/19
 * Time: 3:56 PM
 */

namespace App\Imports;

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
        return new User([
            'name' => $row[$cols['nameCol'] - 1],
            'phone' => $row[$cols['phoneCol'] - 1],
            'email' => $row[$cols['emailCol'] - 1],
            'roleId' => 5,
            'createdBy' => Auth::user()->id,
        ]);
    }
}

