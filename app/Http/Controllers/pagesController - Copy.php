<?php

namespace App\Http\Controllers;
use App\Models\Pages;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;

class pagesController extends Controller
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
      $Pages = Pages::orderBy('created_at', 'desc')->paginate(10);
      return view('admin.pages', compact('Pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      if ($request->isMethod('get')){
               return view('admin.pagesform');
      }else {
         $rules = [
               'title' => 'required',
                'website' => 'required',
                 'alias' => 'required',
                  'status' => 'required',
                 'description' => 'required',

           ];
        $this->validate($request, $rules);
        $Page = new Pages();
        if ($request->hasFile('image')) {

            $dir = 'uploads/';
            $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
            $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
            $request->file('image')->move($dir, $FileName);
            $Page->image = $FileName;
        }elseif($request->image==null){
              $Page->image ='';
        }

        $Page->meta_title = $request->meta_title;
        $Page->meta_description = $request->meta_description;
        $Page->meta_keywords = $request->meta_keywords;
        $Page->title = $request->title;
      $Page->alias = $request->alias;
              $Page->website = $request->website;

            $Page->description = $request->description;
            $Page->status = $request->status;
            $Page->ordering = true;
             $Page->save();
        return redirect('/admin/pages')->with('success','Page has been Added Successfully');
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
           'searchpage' => 'required'
       ];
        $this->validate($request, $rules);
        $search = $request->input('searchpage');
        $Pages = Pages::where('title', 'LIKE', '%'.$search.'%')->paginate(4);
        return view('admin.pages', compact('Pages'))->with('success','Searched Successfully');

    }else{
     return redirect('/admin/pages')->with('error','Error!!');
     }
     } */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAllPages()
    {
      $data = Pages::query();
      //echo '<pre>';
      // print_r($data);
      //exit;
      return Datatables::eloquent($data)
      ->addColumn('action', 'inc.pageactions')
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
        return view('admin.pagesform', ['PageEdit' => Pages::find($id)]);
      }
       else {
               //Here we are putting validatin
                 $rules = [
                  'title' => 'required',
                  'status' => 'required',
                  'website' => 'required',
                  'alias' => 'required',
                  'description' => 'required',
                   /*   'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',*/
                 ];
                 $this->validate($request, $rules);
                 $Page = Pages::find($id);
                 if ($request->hasFile('image')) {
                     $dir = 'uploads/';
                     if ($Page->image != '' && File::exists($dir . $Page->image))
                         File::delete($dir . $Page->image);
                     $extension = strtolower($request->file('image')->getClientOriginalExtension());
                     $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
                     $request->file('image')->move($dir, $FileName);
                     $Page->image = $FileName;
                 }elseif ($request->remove == 1 && File::exists('uploads/' . $Page->image)) {
                File::delete('uploads/' . $Page->post_image);
                $Page->image = null;
                }
               }
               $Page->meta_title = $request->meta_title;
               $Page->meta_description = $request->meta_description;
               $Page->meta_keywords = $request->meta_keywords;
               $Page->title = $request->title;
               $Page->alias = $request->alias;
               $Page->website = $request->website;

                   $Page->description = $request->description;
                   $Page->status = $request->status;
                   $Page->ordering = true;
               $Page->save();
                 return redirect('/admin/pages')->with('success','Page has been Updated Successfully');

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
      try{ $page = Pages::find($id);
           $dir = 'uploads/';
           if ($page->image != '' && File::exists($dir . $page->image)){
                  File::delete($dir . $page->image);
                  Pages::destroy($id);
                  $message = "Page Deleted Successfully";
                  return response()->json([
                  'status' => 200,
                  'message' => $message
             ]);
           }//if ends here
            else{
              Pages::destroy($id);
              $message = "Page Deleted Successfully";
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

     /*   public function delete($id)
     {
       $Page = Pages::find($id);
              if ($Page!==null) {
                  $dir = 'uploads/';
                  if ($Page->image != '' && File::exists($dir . $Page->image)){
                         File::delete($dir . $Page->image);
                        Pages::destroy($id);
                      return redirect('/admin/pages')->with('success', 'File Deleted');
                    }else{
                          Pages::destroy($id);
                     return redirect('/admin/pages')->with('success', 'File Deleted');}

                }
     } */
}