<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = Activity::join('users', 'activity_log.causer_id', '=', 'users.id')
        ->select('activity_log.*', 'users.name as username')->get();
        $allModels = $this->getAllModels();
        $users = \App\Models\User::get();
        return view('pages.activity-log.index',compact('logs','allModels','users'));
    }

    public function getAllModels()
    {
        $modelList = [];
        $path = app_path() . "/Models";
        $results = scandir($path);
 
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;
            $filename = $result;
  
            if (is_dir($filename)) {
                $modelList = array_merge($modelList, getModels($filename));
            } else {
                $modelList[] = substr($filename,0,-4);
            }
        }
  
        return $modelList;
    }
}
