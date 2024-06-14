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
use App\Newsletters;
use App\Widgets;

class fdhPagesController extends Controller
{
    public function showPages($alias){
        if(empty($alias)){
            abort(404);
                  }
                $data['files'] = Files::getFiles();
                $data['specific_pages'] = Pages::where(['alias'=>$alias])->first();
                $data['currentProjects'] = Projects::getAllcureentProjects();
                $data['upcomingProjects'] = Projects::getAllupcomingProjects();
                $data['allnews'] = News::getAllNews();
                $data['allevents'] = Events::getAllEvents();
                $data['pages'] = Pages::getPages();
                $data['settings'] = Settings::getSettings();
                $data['newsletters'] = Newsletters::getNewsletters();
                $data['offices'] = Offices::getOffices();
                //   echo '<pre>';
                  // print_r($data);
                    //     exit;
              if(empty($data['pages'])){
                 abort(404);
                }
      return view('web.single_page',$data);
    }

        public function showsitemap(){
        $data['settings'] = Settings::getSettings();
        $data['currentProjects'] = Projects::getAllcureentProjects();
        $data['upcomingProjects'] = Projects::getAllupcomingProjects();
        $data['allnews'] = News::getAllNews();
        $data['allevents'] = Events::getAllEvents();
        $data['newsletters'] = Newsletters::getNewsletters();
        $data['pages'] = Pages::getPages();
         //   echo '<pre>';
         // print_r($data);
         //     exit;
         return response()->view('web.sitemap',$data)->header('Content-Type', 'text/xml');

   }
}
