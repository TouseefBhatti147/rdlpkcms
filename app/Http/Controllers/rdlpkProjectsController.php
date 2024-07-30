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

class rdlpkProjectsController extends Controller
{
  public function showCurrentProjects($alias)
  {
      if (empty($alias)) {
          abort(404);
      }
      $data['officess'] = Offices::getAllActiveOffices();

      $data['files'] = Files::getFiles();
      $data['pages'] = Pages::getPages();
      $data['projects'] = Projects::where(['alias' => $alias, 'status' => 1, 'project_status' => 'current'])->first();
      $data['settings'] = Settings::getSettings();
      $data['offices'] = Offices::getOffices();

      if (empty($data['projects'])) {
          abort(404);
      }

      // Add widgets data
      $data['widgets'] = [
          'current-projects' => [
              'status' => 1, // Assuming status 1 means active
              'meta_title' => 'Current Projects Title',
              'meta_description' => 'Description of current projects.',
              'meta_keywords' => 'keywords, current, projects',
          ],
          // Include other widgets if necessary
      ];

      return view('web.single_currentproject', $data);
  }


                   public function showUpcomingProjects($alias){
                             if(empty($alias)){
                                 abort(404);
                                       }
                                       $data['sliders'] = Files::getSliders();

                                       $data['officess'] = Offices::getAllActiveOffices();
                                       $data['files'] = Files::getFiles();
                                       $data['pages'] = Pages::getPages();
                                       $data['projects'] = Projects::where(['alias'=>$alias,'status'=>1,'project_status'=>'upcoming'])->first();
                                       $data['settings'] = Settings::getSettings();
                                       $data['offices'] = Offices::getOffices();
                                     // echo '<pre>';
                                       // print_r($data);
                                         //              exit;
                                                   if(empty($data['projects'])){
                                                    abort(404);
                                                     }
                                         return view('web.single_upcomingproject',$data);
                                        }
}