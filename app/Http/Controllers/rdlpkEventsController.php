<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events;
use App\Files;
use App\News;
use App\Offices;
use App\Pages;
use App\Projects;
use App\Settings;
use App\Videos;
use App\Widgets;

class fdhEventsController extends Controller
{
    public function showEvents($alias){
        if(empty($alias)){
            abort(404);
                  }
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
