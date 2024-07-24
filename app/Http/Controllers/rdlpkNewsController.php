<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;

class rdlpkNewsController extends Controller
{
    public function showNews($alias){
        if(empty($alias)){
            abort(404);
                  }
               $data['files'] = Files::getFiles();
                  $data['pages'] = Pages::getPages();
                  $data['news'] = News::where(['alias'=>$alias,'status'=>1])->first();
                  $data['settings'] = Settings::getSettings();
                  $data['offices'] = Offices::getOffices();
                // echo '<pre>';
                  // print_r($data);
                    //              exit;
                              if(empty($data['news'])){
                               abort(404);
                                }
                    return view('web.single_news',$data);
                   }
}