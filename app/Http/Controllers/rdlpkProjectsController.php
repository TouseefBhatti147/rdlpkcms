<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;

class rdlpkProjectsController extends Controller
{
  public function showCurrentProjects($alias)
  {
      if (empty($alias)) {
          abort(404);
      }

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