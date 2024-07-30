<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Files;
use App\Models\News;
use App\Models\Offices;
use App\Models\Pages;
use App\Models\Projects;
use App\Models\Settings;
use App\Models\Videos;
use App\Models\Widgets;

class rdlpkEventsController extends Controller
{
    public function showEvents($alias){
        if(empty($alias)){
            abort(404);
                  }   $data['officess'] = Offices::getAllActiveOffices();
                      $data['files'] = Files::getFiles();
                      $data['pages'] = Pages::getPages();
                      $data['events'] = Events::where(['alias'=>$alias,'status'=>1])->first();
                      $data['settings'] = Settings::getSettings();
                      $data['offices'] = Offices::getOffices();
                      // echo '<pre>';
                      // print_r($data);
                      // exit;
                              if(empty($data['events'])){
                               abort(404);
                                }
                    return view('web.single_event',$data);
                   }
}