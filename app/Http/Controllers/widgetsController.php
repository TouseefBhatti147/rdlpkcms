<?php

namespace App\Http\Controllers;

use App\Widgets;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;

class widgetsController extends Controller
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
    public function index(Request $request)
    {
       return view('admin.widgets');
      /*$Widgets = Widgets::orderBy('created_at', 'desc')->paginate(10);
            return view('admin.widgets', compact('Widgets')); */


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      if ($request->isMethod('get')){
               return view('admin.widgetsform');
      }else {
         $rules = [
               'title' => 'required',
                'link' => 'required',
                 'alias' => 'required',
                   'description' => 'required',
                    'status' => 'required'


           ];
        $this->validate($request, $rules);


        $Widget = new Widgets();
        if ($request->hasFile('image')) {

            $dir = 'uploads/';
            $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
            $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
            $request->file('image')->move($dir, $FileName);
            $Widget->image = $FileName;
        }elseif($request->image==null){
              $Widget->image ='';
        }

        $Widget->meta_title = $request->meta_title;
            $Widget->meta_description = $request->meta_description;
            $Widget->meta_keywords = $request->meta_keywords;

           $Widget->title = $request->title;
              $Widget->link = $request->link;
                 $Widget->alias = $request->alias;
                     $Widget->description = $request->description;
                           $Widget->status = $request->status;
                                $Widget->save();
        return redirect('/admin/widgets')->with('success','Widget has been Added Successfully');
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /* public function search(Request $request)
    {
      if ($request->isMethod('get')){
         $rules = [
          'searchwidget' => 'required'
      ];
       $this->validate($request, $rules);
       $search = $request->input('searchwidget');
       $Widgets = Widgets::where('title', 'LIKE', '%'.$search.'%')->paginate(4);
       return view('admin.widgets', compact('Widgets'))->with('success','Searched Successfully');

     }else{
      return redirect('/admin/widgets')->with('error','Error!!');
      }
    } */

     public function getAllWidgets(){

      $data = Widgets::query();
      //echo '<pre>';
      // print_r($data);
      //exit;
      return Datatables::eloquent($data)
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
        return view('admin.widgetsform', ['WidgetEdit' => Widgets::find($id)]);
      }
       else {
               //Here we are putting validatin
                 $rules = [
                   'title' => 'required',
                    'link' => 'required',
                    'alias' => 'required',
                     'description' => 'required',
                     'status'=>'required'

                 ];
                 $this->validate($request, $rules);
                 $Widget = Widgets::find($id);
                 if ($request->hasFile('image')) {
                     $dir = 'uploads/';
                     if ($Widget->image != '' && File::exists($dir . $Widget->image))
                         File::delete($dir . $Widget->image);
                     $extension = strtolower($request->file('image')->getClientOriginalExtension());
                     $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
                     $request->file('image')->move($dir, $FileName);
                     $Widget->image = $FileName;
                 }elseif ($request->remove == 1 && File::exists('uploads/' . $Widget->image)) {
                     File::delete('uploads/' . $Widget->image);
                    $Widget->image = '';
                }
               }
               $Widget->meta_title = $request->meta_title;
               $Widget->meta_description = $request->meta_description;
               $Widget->meta_keywords = $request->meta_keywords;
               $Widget->title = $request->title;
               $Widget->link = $request->link;
                 $Widget->alias = $request->alias;
                   $Widget->description = $request->description;
                     $Widget->status = $request->status;
               $Widget->save();
                 return redirect('/admin/widgets')->with('success','Widget has been Updated Successfully');
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
      try{ $alert = Widgets::find($id);
           $dir = 'uploads/';
           if ($alert->image != '' && File::exists($dir . $alert->image)){
                  File::delete($dir . $alert->image);
                  Widgets::destroy($id);
                  $message = "Widget Deleted Successfully";
                  return response()->json([
                  'status' => 200,
                  'message' => $message
             ]);
           }//if ends here
            else{
            Widgets::destroy($id);
            $message = "Widget Deleted Successfully";
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

  /* public function delete($id)
    {
      $Widget = Widgets::find($id);
             if ($Widget!==null) {
                 $dir = 'uploads/';
                 if ($Widget->image != '' && File::exists($dir . $Widget->image)){
                        File::delete($dir . $Widget->image);
                        Widgets::destroy($id);
                      return redirect('/admin/widgets')->with('success', 'Widget Deleted');}
                  else{
                    Widgets::destroy($id);
                  return redirect('/admin/widgets')->with('success', 'Widget Deleted');}

               }
    }  */
}
