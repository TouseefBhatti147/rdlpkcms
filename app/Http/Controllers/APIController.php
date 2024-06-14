<?php
namespace App\Http\Controllers;
use App\FlashNews;
use App\Widgets;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;


class APIController extends Controller
{
  //This is the function which we are using to view All common
  public function getFlashNews(){ 
  //Usign Try catch to do exception handling here
  $data = FlashNews::query();
  // echo '<pre>';
  // print_r($data);
  // exit;
  return DataTables::eloquent($data)
  ->addColumn('action', 'inc.flashnewsactions')
     /*Striping html tags from the description*/
     ->addColumn('description', function($data) {
        if ($data->description !== null) {
            $description = strip_tags($data->description);
              return $description;
           }
           })
  ->addColumn('status', function($data) {
  $val = 1;
  if ($data->status !== $val) {
        return '<label class="badge badge-danger">Disabled</label>';  } else {
               return '<label class="badge badge-success">Enabaled</label>';    }
  })->rawColumns(['action','status','description'])
  ->addIndexColumn()
  ->make(true);       
  }//getAllCommon ends here

  //Get all widgets start here 
  public function getAllWidgets(){
  
 
    $data = Widgets::query();
    //echo '<pre>';
    // print_r($data);
    //exit;
    return DataTables::eloquent($data)
    ->addColumn('action', 'inc.widgetactions')
    ->addColumn('status', function($data) {
      $val = 1;
      if ($data->status !== $val) {
            return '<label class="badge badge-danger">Disabled</label>';  } else {
                   return '<label class="badge badge-success">Enabaled</label>';    }
      })
      ->addColumn('image', function ($data) { 
        if($data->image!==''){
        $url= asset('uploads/'.$data->image);
        return '<img src="'.$url.'" class="img-rounded" align="center" style="object-fit: cover;" height="70px" width="70px"  />';}else{
          $url= asset('images/noimage.jpg');
          return '<img src="'.$url.'" class="img-rounded" align="center" style="object-fit: cover;" height="70px" width="70px"  />';
        }
      })
    ->rawColumns(['action','status','image'])
    ->addIndexColumn() 
    ->make(true);

  }
  //Get all widgetss ends here

  //Get all users start here 
  public function getAllUsers(){
  
  }
  //Get all users ends here

  //Get all pages start here 
  public function getAllPages(){
  
  }
   //Get all pages ends here
  
  //Get all Files start here 
  public function getAllFiles(){
   
  }
  //Get all Files ends here
   
  //Get all Files start here 
  public function getAllProjeects(){
 
  }
  //Get all Files ends here
   
  //Get all News start here 
  public function getAllNews(){
 
  }
  //Get all News ends here

  //Get all Events start here 
  public function getAllEvents(){
 
  }
  //Get all Events ends here

  //Get all Newsletters start here 
  public function getAllNewsletters(){
 
  }
  //Get all Newsletters ends here
   
  //Get all Offices start here 
  public function getAllOffices(){
 
  }
  //Get all Offices ends here
  
  //Get all Offices start here 
  public function getAllVideos(){
 
  }
  //Get all Offices ends here
  
  //Get all Offices start here 
  public function getAllSettings(){  
 
  }
  //Get all Offices ends here
}
