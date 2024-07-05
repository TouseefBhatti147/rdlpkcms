<?php

namespace App\Http\Controllers;
use App\Models\Pages;
use App\Models\Videos;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class videosController extends Controller
{

  public function __construct()
  { $this->middleware('auth:admin'); }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $Videos = Videos::orderBy('created_at', 'desc')->paginate(4);
      return view('admin.videos', compact('Videos'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      if ($request->isMethod('get')){
               return view('admin.videosform');
      }else{
         $rules = [
               'title' => 'required',
                'alias' => 'required',
                'status' => 'required'
           ];
        $this->validate($request, $rules);
        $Video = new Videos();
         $Video->title = $request->title;
         $Video->alias = $request->alias;
              $Video->status = $request->status;
               $Video->save();
        return redirect('/admin/videos')->with('success','Video has been Added Successfully');
       }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function search(Request $request)
     {
       if ($request->isMethod('get')){
          $rules = [
           'searchvideo' => 'required'
       ];
        $this->validate($request, $rules);
        $search = $request->input('searchvideo');
        $Videos = Videos::where('title', 'LIKE', '%'.$search.'%')->paginate(4);
        return view('admin.videos', compact('Videos'))->with('success','Searched Successfully');

    }else{
     return redirect('/admin/videos')->with('error','Error!!');
     }
     }

     //All Videos sart here
     public function getAllVideos(){
      $data = Videos::query();
      //echo '<pre>';
      // print_r($data);
      //exit;
      return Datatables::eloquent($data)
      ->addColumn('action', 'inc.videosactions')
      ->addColumn('video', 'inc.videoframe')
      ->addColumn('status', function($data) {
        $val = 1;
        if ($data->status !== $val) {
              return '<label class="badge badge-danger">Disabled</label>';  } else {
                     return '<label class="badge badge-success">Enabaled</label>';    }
        })
       ->rawColumns(['action','status','video'])
       ->addIndexColumn()
       ->make(true);

     }//All Videos end here

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if ($request->isMethod('get')){return view('admin.videosform', ['VideoEdit' => Videos::find($id)]); }
       else {
               //Here we are putting validatin
                 $rules = [
                   'title' => 'required',
                      'status' => 'required',
                        'alias' => 'required',
                 ];
               $this->validate($request, $rules);
                  $Video =Videos::find($id);
                  $Video->title = $request->title;
                   $Video->alias = $request->alias;
                       $Video->status = $request->status;
                        $Video->save();
                 return redirect('/admin/videos')->with('success','Video has been Updated Successfully');
                }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

 //Logic for deletion starts here
     public function delete($id)
     {
       $video = Videos::find($id);
              if ($video!==null) {
                try{
                  Videos::destroy($id);
                  $message = "Video Deleted Successfully";
                  return response()->json([
                  'status' => 200,
                  'message' => $message
                 ]);
                }catch(\Exception $e){
                  $message =  $e->getMessage();
                  return back()->withErrors($message);
                }
        }/*if ends here*/
     }//Logic for deletion ends here


  }