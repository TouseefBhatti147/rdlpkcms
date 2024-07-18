<?php

namespace App\Http\Controllers;
use App\Models\Events;
use App\Models\Files;
use App\Models\News;
use App\Models\Offices;
use App\Models\Pages;
use App\Models\Projects;
use App\Models\Settings;
use App\Models\Videos;
use App\Models\Widgets;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class newsController extends Controller
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
      $News = News::orderBy('created_at', 'desc')->paginate(4);
      return view('admin.news', compact('News'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      if ($request->isMethod('get')){
               return view('admin.newsform');
      }else {
         $rules = [
               'title' => 'required',
                  'alias' => 'required',
                   'short_description' => 'required',
                    'status'=> 'required',
                     'description' => 'required',
                      'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           ];
        $this->validate($request, $rules);
        $News = new News();
        if ($request->hasFile('image')) {

            $dir = 'uploads/';
            $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
            $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
            $request->file('image')->move($dir, $FileName);
            $News->image = $FileName;
        }
         $News->meta_title = $request->meta_title;
                 $News->meta_description = $request->meta_description;
                  $News->meta_keywords = $request->meta_keywords;
           $News->title = $request->title;
                 $News->alias = $request->alias;
                  $News->short_description = $request->short_description;
                     $News->description = $request->description;
                           $News->status = $request->status;
                                    $News->ordering = true;
                                $News->save();
        return redirect('/admin/news')->with('success','News has been Added Successfully');
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
/*     public function search(Request $request)
     {
       if ($request->isMethod('get')){
          $rules = [
           'searchnews' => 'required'
       ];
        $this->validate($request, $rules);
        $search = $request->input('searchnews');
        $News = News::where('title', 'LIKE', '%'.$search.'%')->paginate(4);
        return view('admin.news', compact('News'))->with('success','Searched Successfully');

   }else{
    return redirect('/admin/news')->with('error','Error!!');
   }
     } */


    public function getAllNews(){

      $data = News::query();
      //echo '<pre>';
      // print_r($data);
      //exit;
      return Datatables::eloquent($data)
      ->addColumn('action', 'inc.newsactions')
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        return view('admin.newsform', ['NewsEdit' => News::find($id)]);
      }
       else {
               //Here we are putting validatin
                 $rules = [
                   'title' => 'required',
                      'alias' => 'required',
                       'short_description' => 'required',
                        'status'=> 'required',
                         'description' => 'required',
                          'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
                             ];
                 $this->validate($request, $rules);
                 $News = News::find($id);
                 if ($request->hasFile('image')) {
                     $dir = 'uploads/';
                     if ($News->image != '' && File::exists($dir . $News->image))
                         File::delete($dir . $News->image);
                     $extension = strtolower($request->file('image')->getClientOriginalExtension());
                     $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
                     $request->file('image')->move($dir, $FileName);
                     $News->image = $FileName;
                 }elseif ($request->remove == 1 && File::exists('uploads/' . $News->image)) {
                     File::delete('uploads/' . $News->image);
                    $News->image = null;
                }
               }   $News->meta_title = $request->meta_title;
                          $News->meta_description = $request->meta_description;
                           $News->meta_keywords = $request->meta_keywords;
                      $News->title = $request->title;
                      $News->alias = $request->alias;
                      $News->short_description = $request->short_description;
                      $News->description = $request->description;
                      $News->status = $request->status;
                      $News->ordering = true;
                      $News->save();
                               return redirect('/admin/news')->with('success','News has been Updated Successfully');
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
      try{ $news = News::find($id);
           $dir = 'uploads/';
           if ($news->image != '' && File::exists($dir . $news->image)){
                  File::delete($dir . $news->image);
                  News::destroy($id);
                  $message = "News Deleted Successfully";
                  return response()->json([
                  'status' => 200,
                  'message' => $message
             ]);
           }//if ends here
            else{
            News::destroy($id);
            $message = "News Deleted Successfully";
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
       $News = News::find($id);
              if ($News!==null) {
                  $dir = 'uploads/';
                  if ($News->image != '' && File::exists($dir . $News->image)){
                         File::delete($dir . $News->image);
                         News::destroy($id);
                       return redirect('/admin/news')->with('success', 'News Deleted');}
                   else{
                     News::destroy($id);
                   return redirect('/admin/news')->with('success', 'News Deleted');}

                }
     }*/



}