<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;

class rdlpkIndexController extends Controller
{

    public function index()
    {
        $data['pages'] = Pages::getPages();
        $data['settings'] = Settings::getSettings();
        //$alias='contact-us-email';
        //$data['onesetting'] = Settings::getSetting($alias);
        $data['files'] = Files::getFiles();
        $data['offices'] = Offices::getOffices();
        $data['widgets'] = Widgets::getWidgets();
        $data['videos'] = Videos::getVideos();
        $data['projectss'] = Projects::getAllCurrentProjects();
        $data['officess'] = Offices::getAllActiveOffices();
        $data['projects'] = Projects::getProjects();
        $data['twonews'] = News::getTwoNews();
        $data['twoevents'] = Events::getTwoEvents();
        $data['twovideos'] = Videos::getTwoVideos();
        $data['newsletters'] = Newsletters::getTwoNewsletters();
        $data['flashnews'] = FlashNews::getFlashNews();

        // Get sliders here
        $data['sliders'] = Files::getSliders();
        // dd($data['sliders']);
        // echo '<pre>';
        // print_r($data['offices']);
        // exit;
        return view('web.index', $data);
    }


    public function aboutus()
    {
    $data['officess'] = Offices::getAllActiveOffices();
    $data['files'] = Files::getFiles();
    $data['pages'] = Pages::getPages();
    $data['settings'] = Settings::getSettings();
    $data['offices'] = Offices::getOffices();
    $data['widgets'] = Widgets::getWidgets();
    $data['videos'] = Videos::getVideos();
    //echo '<pre>';
    //print_r($data);
    //exit;
    return view('web.aboutus',$data);
    }


    public function newsdetail()
    {
    $data['widgets'] = Widgets::getWidgets();
    $data['files'] = Files::getFiles();
    $data['pages'] = Pages::getPages();
    $data['settings'] = Settings::getSettings();
    $data['offices'] = Offices::getOffices();
    $data['news'] = News::getNews();
    $data['allnews'] = News::getAllNews();
    $data['officess'] = Offices::getAllActiveOffices();

    // echo '<pre>';
    // print_r($data);
    // exit;
    return view('web.news',$data);
    }

    public function latestevents()
    {
    $data['officess'] = Offices::getAllActiveOffices();
    $data['widgets'] = Widgets::getWidgets();
    $data['files'] = Files::getFiles();
    $data['pages'] = Pages::getPages();
    $data['settings'] = Settings::getSettings();
    $data['offices'] = Offices::getOffices();
    $data['events'] = Events::getEvents();
    $data['allevents'] = Events::getAllEvents();
    //echo '<pre>';
    //print_r($data);
    // exit;
    return view('web.events',$data);
    }

    public function latestvideos()
    {
    $data['officess'] = Offices::getAllActiveOffices();
    $data['widgets'] = Widgets::getWidgets();
    $data['files'] = Files::getFiles();
    $data['pages'] = Pages::getPages();
    $data['settings'] = Settings::getSettings();
    $data['offices'] = Offices::getOffices();
    $data['videos'] = Videos::getVideos();
    $data['allvideos'] = Videos::getAllVideos();
    //echo '<pre>';
    //print_r($data);
    //exit;
    return view('web.videos',$data);
    }

    public function Slider()
    {
    $data['sliders'] = Files::getSliders();


    return view('inc.slider',$data);
    }
    public function currentprojects()
    {
    $data['sliders'] = Files::getSliders();
    $data['officess'] = Offices::getAllActiveOffices();
    $data['widgets'] = Widgets::getWidgets();
    $data['files'] = Files::getFiles();
    $data['pages'] = Pages::getPages();
    $data['settings'] = Settings::getSettings();
    $data['offices'] = Offices::getOffices();
    $data['allcurrentprojects'] = Projects::getAllcureentProjects();
    //  echo '<pre>';
    //  print_r($data);
    //  exit;
    return view('web.currentprojects',$data);
    }

    public function upcomingprojects()
    {
    $data['sliders'] = Files::getSliders();
    $data['officess'] = Offices::getAllActiveOffices();
    $data['widgets'] = Widgets::getWidgets();
    $data['files'] = Files::getFiles();
    $data['pages'] = Pages::getPages();
    $data['settings'] = Settings::getSettings();
    $data['allupcomingprojects'] = Projects::getAllupcomingProjects();
    //  echo '<pre>';
    //  print_r($data);
    //  exit;
    return view('web.upcomingprojects',$data);
    }

    public function showBrochure(){
        $data['widgets'] = Widgets::getWidgets();
        $data['files'] = Files::getFiles();
        $data['settings'] = Settings::getSettings();
        $data['pages'] = Pages::getPages();
        $data['officess'] = Offices::getAllActiveOffices();
        return view('web.broucher-view',$data);
    }

    public function newsletters(){
        $data['widgets'] = Widgets::getWidgets();
        $data['files'] = Files::getFiles();
        $data['pages'] = Pages::getPages();
        $data['settings'] = Settings::getSettings();
        $data['newsletters'] = Newsletters::getNewsletters();
        $data['officess'] = Offices::getAllActiveOffices();
        return view('web.newsletters',$data);
    }

    //Function for iso certificates starts here
    public function isocertificates($alias=''){
        $data['widgets'] = Widgets::getWidgets();
        $data['alias']   = $alias;
        $data['files']   = Files::getFiles();
        $data['pages']   = Pages::getPages();
        $data['settings']= Settings::getSettings();
        $data['officess'] = Offices::getAllActiveOffices();
        return view('certificates.all',$data);
    }
    //Function for iso certificates ends here


    //Function for our group page starts here
    public function ourgroup(){
        $data['widgets'] = Widgets::getWidgets();
        $data['files'] = Files::getFiles();
        $data['pages'] = Pages::getPages();
        $data['settings'] = Settings::getSettings();
        $data['officess'] = Offices::getAllActiveOffices();
        return view('web.ourgroup',$data);
    }
    //Function for our group page ends here
}