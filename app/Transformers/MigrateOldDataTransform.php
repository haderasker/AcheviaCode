<?php
/**
 * Created by PhpStorm.
 * User: hadeer
 * Date: 12/23/19
 * Time: 1:54 PM
 */

namespace App\Transformers;

use Illuminate\Support\Facades\DB;

class MigrateOldDataTransform
{
    public function userTransform($user)
    {
        $link = DB::connection('old_data')->table('Links');
        $project = $link->where('l_id', $user->r_link)->first();
        $logs = DB::connection('old_data')->table('request_log');
        $history = $logs->where('rl_r_id', $user->r_id)->get()->toArray();
        $newUsers = [];
        $code = $user->in_code;
        $countryCode = str_replace('+', '', strstr($code, '+'));
        $phone = $countryCode . ltrim($user->r_mobile, '0');
        $newUsers['user']['name'] = $user->r_name;
        $newUsers['user']['email'] = $user->in_email;
        $newUsers['user']['phone'] = $phone;
        $newUsers['user']['roleId'] = 5;
        $newUsers['user']['createdBy'] = 0;
        $newUsers['detail']['notes'] = $user->in_notes;
        $newUsers['detail']['assignToSaleManId'] = $user->r_assigned;
        $newUsers['detail']['addClientLinkId'] = $user->r_link;
        $newUsers['detail']['projectId'] = $project->l_project;

        foreach ($history as $key => $one) {
            $newUsers['history'][$key]['actionId'] = $this->replaceAction($one->rl_type);
            $newUsers['history'][$key]['date'] = $one->rl_date;
            $newUsers['history'][$key]['viaMethodId'] = $one->rl_method;
            $newUsers['history'][$key]['notes'] = $one->rl_info;
            $newUsers['history'][$key]['createdBy'] = 0;
            if ($one->rl_action == 4) {
                $state = 'Reassigned';
            } elseif ($one->rl_action == 3) {
                $state = 'Change State';
            }

            $newUsers['history'][$key]['state'] = $state;
        }

        $newUsers['detail']['actionId'] = $this->replaceAction($user->r_state);
        return $newUsers;
    }

    public function replaceAction($state)
    {
        $actionId = 0;
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
        $newUsers['roleId'] = $user->role;
        $newUsers['createdBy'] = 0;

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
                $idParent = 0;
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