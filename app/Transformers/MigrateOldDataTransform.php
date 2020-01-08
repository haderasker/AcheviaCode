<?php
/**
 * Created by PhpStorm.
 * User: hadeer
 * Date: 12/23/19
 * Time: 1:54 PM
 */

namespace App\Transformers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MigrateOldDataTransform
{
    public function userTransform($user)
    {
        $model = DB::connection('mysql')->table('users');
//        $modelOld = DB::connection('old_data')->table('requests');
        $code = $user->in_code;
        $phoney = $user->r_mobile;

        $countryCode = '20';
        if ($code) {
            $countryCode = str_replace('+', '', strstr($code, '+'));
        }
        $convertMob = strtr($phoney, array('i' => '1', 'o' => '0', ' ' => '', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'));
        preg_match_all('!\d+!', $convertMob, $matches);
        $convertMob = implode('', $matches[0]);
        $firstChar = substr($convertMob, 0, 1);
        $firstTwoChar = substr($convertMob, 0, 2);
        $firstThirdChar = substr($convertMob, 0, 3);
        $firstFourChar = substr($convertMob, 0, 4);
        $phone = $countryCode . $convertMob;


        if ($firstTwoChar == '10') {
            $phone = $countryCode . str_replace('10', '', $convertMob);
        }
        if ($firstThirdChar == '200') {
            $phone = $countryCode . str_replace('200', '', $convertMob);
        }
        if ($firstTwoChar != '20' || $firstTwoChar != '96' || $firstTwoChar != '97') {
            $phone = $countryCode . $convertMob;
        }
        if ($firstTwoChar == '20' || $firstTwoChar == '96' || $firstTwoChar == '97') {
            $phone = $convertMob;
        }
        if ($firstFourChar == '2020') {
            $phone = $countryCode . str_replace('2020', '', $convertMob);
        }


        if ($firstChar == '1') {
            $phone = $countryCode . $convertMob;
        }
        if ($firstChar == '0') {
            $phone = $countryCode . ltrim($convertMob, '0');
        }
        if ($firstTwoChar == '00') {
            $phone = str_replace('00', '', $convertMob);
        }

        $userExist = $model->where('phone', $phone)->orWhere('email', $user->in_email)->first();

        if ($userExist) {
            return ['user' => $userExist, 'status' => 'existed'];

        } else {
            $link = DB::connection('old_data')->table('Links');
            $project = $link->where('l_id', $user->r_link)->first();
            $logs = DB::connection('old_data')->table('request_log');
            $history = $logs->where('rl_r_id', $user->r_id)->get()->toArray();
            $lastHistory = $logs->where('rl_r_id', $user->r_id)->orderBy('created_at', 'desc')->first();

            $newUsers = [];
            $email = time() . Str::random(10) . '@gmail.com';
            if ($user->in_email) {
                $email = $user->in_email;
            }
            $name = 'empty';
            if ($user->r_name) {
                $name = $user->r_name;
            }
            $newUsers['user']['name'] = $name;
            $newUsers['user']['email'] = $email;
            $newUsers['user']['phone'] = $phone;
            $newUsers['user']['roleId'] = 5;
            $newUsers['user']['createdBy'] = null;
            $newUsers['user']['created_at'] = $user->created_at;
            $newUsers['user']['updated_at'] = $user->updated_at;
//            $newUsers['detail']['notes'] = $user->in_notes;
            $newUsers['detail']['assignToSaleManId'] = $user->r_assigned;
            $newUsers['detail']['addClientLinkId'] = $user->r_link;
            $newUsers['detail']['projectId'] = $project->l_project;
            $newUsers['detail']['actionId'] = $this->replaceAction($user->r_state);
            if ($lastHistory) {
                if (is_null($lastHistory->rl_date)) {
                    $date = date($lastHistory->created_at);
                    $time = date("H:i:s", strtotime($lastHistory->created_at));
                } else {
                    $date = date($lastHistory->rl_date);
                    $time = date("H:i:s", strtotime($lastHistory->rl_date));
                }
                $note = $lastHistory->rl_info;
                $method = $lastHistory->rl_method;
                $newUsers['detail']['notificationDate'] = $date;
                $newUsers['detail']['notificationTime'] = $time;
                $newUsers['detail']['notes'] = $note;
                $newUsers['detail']['viaMethodId'] = $method;
                $newUsers['detail']['assignedDate'] = date($user->created_at);
                $newUsers['detail']['assignedTime'] = date("H:i:s", strtotime($user->created_at));
                $newUsers['detail']['created_at'] = $user->created_at;
                $newUsers['detail']['updated_at'] = $user->updated_at;
            }

            foreach ($history as $key => $one) {
                $newUsers['history'][$key]['actionId'] = $this->replaceAction($one->rl_type);
                $newUsers['history'][$key]['date'] = $one->rl_date;
                $newUsers['history'][$key]['created_at'] = $one->rl_date;
                $newUsers['history'][$key]['viaMethodId'] = $one->rl_method;
                $newUsers['history'][$key]['notes'] = $one->rl_info;
                $newUsers['history'][$key]['createdBy'] = null;
                if ($one->rl_action == 4) {
                    $state = 'Reassigned';
                } elseif ($one->rl_action == 3) {
                    $state = 'Change State';
                }

                $newUsers['history'][$key]['state'] = $state;
            }


//            $modelOld->where('r_id',$user->r_id)->get();
//            $modelOld->delete();

            return $newUsers;
        }
    }

    public function replaceAction($state)
    {
        $actionId = null;
        switch ($state) {
            case 1:
            case 2:
            case 17:
                $actionId = 2;
                break;
            case 3:
            case 18:
                $actionId = 4;
                break;
            case 6:
            case 19:
            case 26:
                $actionId = 7;
                break;
            case 7:
            case 20:
                $actionId = 1;
                break;
            case 8:
            case 21:
                $actionId = 9;
                break;

            case 4:
            case 5:
            case 25:
                $actionId = 11;
                break;
            case 24:
                $actionId = 8;
                break;
            case 23:
            case 9:
            case 22:
                $actionId = 10;
                break;
        }

        return $actionId;
    }

    public function allUserTransform($user)
    {
        $newUsers['id'] = $user->id;
        $newUsers['name'] = $user->name;
        $newUsers['email'] = $user->email;
        $newUsers['password'] = $user->password;
        $role = $user->role;
        if ($user->role == 3) {
            $role = 4;
        }
        $newUsers['roleId'] = $role;

        $newUsers['createdBy'] = null;

        return $newUsers;
    }

    public function linkTransform($link)
    {
        $newUsers['id'] = $link->l_id;
        $newUsers['link'] = $link->l_link;
        $newUsers['projectId'] = $link->l_project;
        $newUsers['alias'] = $link->l_alias;
        $newUsers['platform'] = $link->l_platform;
        $newUsers['clientsNo'] = $link->l_r_no;

        return $newUsers;
    }

    public function projectTransform($project)
    {
        $newProject['id'] = $project->p_id;
        $newProject['name'] = $project->p_name;
        $newProject['description'] = $project->p_desc;
        $newProject['image'] = $project->p_icon;

        switch ($project->p_id) {
            case 11:
            case 12:
            case 13:
            case 14:
            case 17:
                $idParent = null;
                break;
            case 15:
            case 16:
                $idParent = 14;
                break;
            case 18:
            case 19:
                $idParent = 17;
                break;
        }

        $newProject['idParent'] = $idParent;

        return $newProject;
    }

}
