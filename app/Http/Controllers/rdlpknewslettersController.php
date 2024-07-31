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
use App\Models\Newsletters;

class rdlpknewslettersController extends Controller
{
    public function showNewsletters($alias){
        if(empty($alias)){
            abort(404);
                  }
                  $data['officess'] = Offices::getAllActiveOffices();

                $data['files'] = Files::getFiles();
                $data['newsletters'] = Newsletters::where(['alias'=>$alias])->first();
                $data['pages'] = Pages::getPages();
                $data['settings'] = Settings::getSettings();
                $data['offices'] = Offices::getOffices();
                //echo '<pre>';
                  // print_r($data);
                    //   exit;
              if(empty($data['newsletters'])){
                 abort(404);
                }
      return view('web.single_newsletter',$data);
  }
}