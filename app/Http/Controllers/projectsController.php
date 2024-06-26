<?php

namespace App\Http\Controllers;
use App\Models\Pages;
use App\Models\Projects;
use App\Models\Settings;
use App\Models\Offices;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;


class projectsController extends Controller
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
      $Projects = Projects::orderBy('created_at', 'desc')->paginate(7);
      return view('admin.projects', compact('Projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      if ($request->isMethod('get')){
               return view('admin.projectsform');
      }else{
           $rules = [
           'title' => 'required',
              'website' => 'required',
                    'alias' => 'required',
                      'description' => 'required',
                            'status'=> 'required',
                      'project_status'=> 'required',
                          'description'=> 'required',
                              'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',];

            $this->validate($request, $rules);
            $Project = new Projects();
            if ($request->hasFile('image')) {
                $dir = 'uploads/';
                  $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
                      $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
                        $request->file('image')->move($dir, $FileName);
                            $Project->image = $FileName;
                          }
                            $Project->meta_title = $request->meta_title;
                            $Project->meta_description = $request->meta_description;
                            $Project->meta_keywords = $request->meta_keywords;

                            $Project->title = $request->title;
                            if(isset($request->broucher_link)){
                              $Project->broucher_link = $request->broucher_link;
                             }else{
                              $Project->broucher_link = '';
                             }
                            $Project->alias = $request->alias;
                            $Project->website = $request->website;
                            $Project->description = $request->description;
                            $Project->status = $request->status;
                            $Project->project_status = $request->project_status;
                            $Project->short_description = $request->short_description;
                            $Project->save();
            return redirect('/admin/projects')->with('success','Project has been Added Successfully');
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
           'searchproject' => 'required'
       ];
        $this->validate($request, $rules);
        $search = $request->input('searchproject');
        $Projects = Projects::where('title', 'LIKE', '%'.$search.'%')->paginate(4);
        return view('admin.projects', compact('Projects'))->with('success','Searched Successfully');

    }else{
     return redirect('/admin/projects')->with('error','Error!!');
     }
     } */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAllProjects()
    {
      $data = Projects::query();
      //echo '<pre>';
      // print_r($data);
      //exit;
      return Datatables::eloquent($data)
      ->addColumn('action', 'inc.projectactions')
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
                   return view('admin.projectsform', ['ProjectEdit' => Projects::find($id)]);
                 }
                  else {
                          //Here we are putting validatin
                            $rules = [
                              'title' => 'required',
                                 'website' => 'required',
                                       'alias' => 'required',
                                         'description' => 'required',
                                               'status' => 'required',
                                                   'project_status'=> 'required',
                                                            'short_description'=> 'required',

                            ];
                            $this->validate($request, $rules);
                            $Project = Projects::find($id);
                            if ($request->hasFile('image')) {
                                $dir = 'uploads/';
                                if ($Project->image != '' && File::exists($dir . $Project->image))
                                    File::delete($dir . $Project->image);
                                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                                $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
                                $request->file('image')->move($dir, $FileName);
                                $Project->image = $FileName;
                            }elseif ($request->remove == 1 && File::exists('uploads/' . $Project->image)) {
                                File::delete('uploads/' . $Project->image);
                               $Project->image = null;
                           }
                          }
                          $Project->meta_title = $request->meta_title;
                          $Project->meta_description = $request->meta_description;
                          $Project->meta_keywords = $request->meta_keywords;

                          $Project->website = $request->website;
                          $Project->title = $request->title;

                          if(isset($request->broucher_link)){
                          $Project->broucher_link = $request->broucher_link;
                          }else{
                          $Project->broucher_link = '';
                          }

                          $Project->alias = $request->alias;
                          $Project->status = $request->status;
                          $Project->description = $request->description;
                          $Project->project_status = $request->project_status;
                          $Project->short_description = $request->short_description;
                          $Project->save();
                          return redirect('/admin/projects')->with('success','Project has been Updated Successfully');
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
      try{ $project = Projects::find($id);
           $dir = 'uploads/';
           if ($project->image != '' && File::exists($dir . $project->image)){
                  File::delete($dir . $project->image);
                  Projects::destroy($id);
                  $message = "Project Deleted Successfully";
                  return response()->json([
                  'status' => 200,
                  'message' => $message
             ]);
           }//if ends here
            else{
              Projects::destroy($id);
              $message = "Project Deleted Successfully";
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


     /*  public function delete($id)
     {
       $Project = Projects::find($id);
              if ($Project!==null) {
                  $dir = 'uploads/';
                  if ($Project->image != '' && File::exists($dir . $Project->image)){
                         File::delete($dir . $Project->image);
                        Projects::destroy($id);
                      return redirect('/admin/projects')->with('success', 'Project Deleted');
                    }else{
                      return redirect('/admin/projects')->with('error', 'Error');}

                }
     }*/


}