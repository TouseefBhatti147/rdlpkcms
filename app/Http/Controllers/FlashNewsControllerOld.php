<?php

namespace App\Http\Controllers;

use App\Models\FlashNews;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Yajra\DataTables\DataTablesServiceProvider;

use ZipArchive;

class FlashNewsController extends Controller
{

    public function __construct()
    {
     $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  return view('admin.flashnews'); }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->isMethod('get')){
           //echo '<pre>';
            //print_r($data);
            //exit;
            return view('admin.flashnewsform');
           }else {
           // echo '<pre>';
           // print_r($request);
            //exit;
           // This is a function to create a common
           // Validation of role creation starts here
           $v = Validator::make($request->all(), [
            'title' => 'required',
            'alert_status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
             ],[
            'alert_status.required'=>'Please Select Alert Status',
            'start_date.required' => 'News Flash start date is required',
            'end_date.required' => 'News Flash end date is required',
            'title.required' => 'Title is Required',
           ]); // Validation for role creation ends here

          if ($v->fails())
          { $errors = $v->getMessageBag()->toArray();
          return back()->withErrors($errors)->withInput();}
          try{

            $alert = new FlashNews();

            $alert->title = $request->title;
              /* Logic for uploading image starts here */
              if ($request->hasFile('image')) {
                $dir = 'uploads/';
                $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
                $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
                $request->file('image')->move($dir, $FileName);
                $alert->image = $FileName;
                }elseif($request->image==null){
                 $alert->image =null;
                }
               /*Logic for uploading image ends here*/
            $alert->description =$request->alert_description;
            $alert->status = $request->alert_status;
            $alert->link = $request->link;
            $alert->start_date = $request->start_date;
            $alert->end_date = $request->end_date;
            $ordering = FlashNews::getLastFlashNews();
            $alert->ordering = $ordering;
            $alert->save();

           return redirect('admin/flashnews')->with('success','Flash News has been Added Successfully');
          }catch(\Exception $e)  {
            $message =  $e->getMessage();
            return back()->withErrors($message)->withInput();
        }
      }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FlashNews  $flashNews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      if ($request->isMethod('get')){
        $data['AlertEdit'] = FlashNews::where('id','=',$request->id)->first();
        //  echo '<pre>';
          // print_r($data);
          // exit;
        return view('admin.flashnewsform',$data);
      }else{

        // echo '<pre>';
           // print_r($request);
            //exit;
           // This is a function to create a common
           // Validation of role creation starts here
           $v = Validator::make($request->all(), [
            'title' => 'required',
            'alert_status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
             ],[
            'title.required' => 'Title is Required',
            'alert_status.required'=>'Please Select Alert Status',
            'start_date.required' => 'News Flash start date is required',
            'end_date.required' => 'News Flash end date is required',
            ]); // Validation for role creation ends here

            if ($v->fails())
            { $errors = $v->getMessageBag()->toArray();
            return back()->withErrors($errors)->withInput();}

        //Try catch starts here
        try{
              $alert =  FlashNews::find($request->id);
             /* Logic for uploading image starts here */
             if ($request->hasFile('image')) {
              $dir = 'uploads/';
              if ($alert->image != '' && File::exists($dir . $alert->image))
                  File::delete($dir . $alert->image);
              $extension = strtolower($request->file('image')->getClientOriginalExtension());
              $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
              $request->file('image')->move($dir, $FileName);
              $alert->image = $FileName;
              }elseif ($request->remove == 1 && File::exists('uploads/' . $alert->image)) {
              File::delete('uploads/' . $alert->image);
             $alert->image = null;
             }
             $alert->title = $request->title;
             $alert->description =$request->alert_description;
             $alert->status = $request->alert_status;
             $alert->link = $request->link;
             $alert->start_date = $request->start_date;
             $alert->end_date = $request->end_date;
             $alert->ordering = $request->ordering;
             $alert->update();
             return redirect('admin/flashnews')->with('success','Flash News has been Updated Successfully');
            /*Logic for uploading image ends here*/
         }catch(\Exception $e)  {
          $message =  $e->getMessage();
          return back()->withErrors($message)->withInput();
       }//Try catch ends here
      }
    }



      //This is the function which we are using to view All common
  public function getFlashNews(){
    //Usign Try catch to do exception handling here
    $data = FlashNews::query()->orderBy('ordering','desc');;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FlashNews  $flashNews
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
      //  User must be deleted softly i.e 0,1 i.e either it is one or zero
      try{

           $alert = FlashNews::find($id);
           $dir = 'uploads/';
           if ($alert->image != '' && File::exists($dir . $alert->image)){
                  File::delete($dir . $alert->image);
                  FlashNews::destroy($id);

                  $message = "Flash News Deleted Successfully";
                  return response()->json([
                  'status' => 200,
                  'message' => $message
                   ]);

           }//if ends here
           elseif($alert!==null){
            FlashNews::destroy($id);
            $message = "Flash News Deleted Successfully";
            return response()->json([
            'status' => 200,
            'message' => $message
             ]);
           }
           }catch(\Exception $e)  {
            $message =  $e->getMessage();
           return response()->json(['status' => 400,
            'message' => $message]);
          }
    }
}