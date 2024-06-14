<?php

namespace App\Http\Controllers;
use App\Pages;
use App\Events;
use App\Settings;
use App\Offices;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;

class eventsController extends Controller
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
    {
      $Events = Events::orderBy('created_at', 'desc')->paginate(10);
      return view('admin.events', compact('Events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      if ($request->isMethod('get')){
               return view('admin.eventsform');
      }else {
         $rules = [
               'title' => 'required',
                  'short_description' => 'required',
                 'alias' => 'required',
                 'description' => 'required',
                  'image' => 'required|image|max:1999',
                  'status' => 'required',
                  'event_date'=> 'required'
           ];
        $this->validate($request, $rules);
        $Event = new Events();
        if ($request->hasFile('image')) {

            $dir = 'uploads/';
            $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
            $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
            $request->file('image')->move($dir, $FileName);
            $Event->image = $FileName;
        }
        $Event->title = $request->title;
      $Event->meta_title = $request->meta_title;
            $Event->meta_description = $request->meta_description;
             $Event->meta_keywords = $request->meta_keywords;
            $Event->short_description = $request->short_description;
            $Event->alias = $request->alias;
            $Event->description = $request->description;
            $Event->status = $request->status;
           $Event->event_date = $request->event_date;
            $Event->ordering = true;
             $Event->save();
        return redirect('/admin/events')->with('success','Event has been Added Successfully');
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   /*  public function search(Request $request)
     {
       if ($request->isMethod('get')){
          $rules = [
           'searchevent' => 'required'
       ];
        $this->validate($request, $rules);
        $search = $request->input('searchevent');
        $Events = Events::where('title', 'LIKE', '%'.$search.'%')->paginate(4);
        return view('admin.events', compact('Events'))->with('success','Searched Successfully');

    }else{
     return redirect('/admin/events')->with('error','Error!!');
     }
     } */


     public function getAllEvents(){
      $data = Events::query();
      //echo '<pre>';
      // print_r($data);
      //exit;
      return Datatables::eloquent($data)
      ->addColumn('action', 'inc.eventsactions')
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

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if ($request->isMethod('get')){
        return view('admin.eventsform', ['EventEdit' => Events::find($id)]);
      }
       else {
               //Here we are putting validatin
                 $rules = [
                   'title' => 'required',
              'short_description' => 'required',
                     'alias' => 'required',
                     'description' => 'required',
                           'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
                      'status' => 'required',
                      'event_date'=> 'required'

                 ];
                 $this->validate($request, $rules);
                 $Event = Events::find($id);
                 if ($request->hasFile('image')) {
                     $dir = 'uploads/';
                     if ($Event->image != '' && File::exists($dir . $Event->image))
                         File::delete($dir . $Event->image);
                     $extension = strtolower($request->file('image')->getClientOriginalExtension());
                     $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
                     $request->file('image')->move($dir, $FileName);
                     $Event->image = $FileName;
                 }elseif ($request->remove == 1 && File::exists('uploads/' . $Event->image)) {
                File::delete('uploads/' . $Event->image);
                $Event->image = null;
                }
               }
               $Event->meta_title = $request->meta_title;
                     $Event->meta_description = $request->meta_description;
                      $Event->meta_keywords = $request->meta_keywords;
               $Event->title = $request->title;
                  $Event->short_description = $request->short_description;
                   $Event->alias = $request->alias;
                   $Event->description = $request->description;
                   $Event->status = $request->status;
                  $Event->event_date = $request->event_date;
                   $Event->ordering = true;
                    $Event->save();
               return redirect('/admin/events')->with('success','Event has been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    
    public function delete($id)
    {
      //  User must be deleted softly i.e 0,1 i.e either it is one or zero
      try{ $event = Events::find($id);
           $dir = 'uploads/';
           if ($event->image != '' && File::exists($dir . $event->image)){
                  File::delete($dir . $event->image);
                  Events::destroy($id);
                  $message = "Event Deleted Successfully";
                  return response()->json([
                  'status' => 200,
                  'message' => $message
             ]);
           }//if ends here
            else{
            Events::destroy($id);
            $message = "Event Deleted Successfully";
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
    
    
     /*public function delete($id)
     {
       $Event = Events::find($id);
              if ($Event!==null) {
                  $dir = 'uploads/';
                  if ($Event->image != '' && File::exists($dir . $Event->image)){
                         File::delete($dir . $Event->image);
                         Events::destroy($id);
                      return redirect('/admin/events')->with('success', 'File Deleted');
                    }else{
                      return redirect('/admin/events')->with('error', 'Error');}
          }
     }*/



}
