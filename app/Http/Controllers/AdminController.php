<?php

namespace App\Http\Controllers;
use App\Models\Pages;
use App\Models\Settings;
use App\Models\Files;
use App\Models\Offices;
use App\Models\Widgets;
use App\Models\Videos;
use App\Models\Projects;
use App\Models\News;
use App\Models\Events;
use App\Models\Newsletters;
use App\Models\FlashNews;
use App\Models\User; // Make sure this line is present

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     /**
        * Create a new controller instance.
        *
        * @return void
        */
      public function __construct()
      {
          $this->middleware('auth:admin');
      }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
      $data['widgetscount'] = Widgets::getWidgetsCount();
      $data['userscount'] = User::getUsersCount();
      $data['pagescount'] = Pages::getPagesCount();
      $data['filescount'] = Files::getFilesCount();
      $data['projectscount'] = Projects::getProjectsCount();
      $data['videoscount'] = Videos::getVideosCount();
      $data['newscount'] = News::getNewsCount();
      $data['eventscount'] = Events::getEventsCount();
      $data['settingscount'] = Settings::getSettingsCount();
      $data['newsletterscount'] = Newsletters::getNewslettersCount();
      $data['officescount'] = Offices::getOfficesCount();
      $data['flashnewscount'] = FlashNews::getFNewsCount();
      //   echo '<pre>';
        //  print_r($data);
          //            exit;
        return view('admin.home',$data)->with('success','Welcome Admin');
    }
}