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
use App\Newsletters;

class rdlpknewslettersController extends Controller
{
    public function showNewsletters($alias){
        if(empty($alias)){
            abort(404);
                  }
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