<?php

namespace App\Http\Controllers;
use App\Newsletters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use ZipArchive;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
class newslettersController extends Controller
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
      // $Newsletters = Newsletters::orderBy('created_at', 'desc')->paginate(4);
      $News = Newsletters::orderBy('created_at', 'desc')->paginate(10);
      return view('admin.newsletters', compact('News'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create(Request $request)
     {
       if ($request->isMethod('get')){
                return view('admin.newslettersform');
       }else {
          $rules = [
                'title' => 'required',
                   'alias' => 'required',
                  //  'file'=> 'required|mimes:zip',
                    'pdf_file'=> 'required|mimes:pdf',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                     'status'=> 'required',
            ];
         $this->validate($request, $rules);
         $News = new Newsletters();
         if ($request->hasFile('image')) {
             $dir = 'uploads/';
             $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
             $FileNameimg =  time().'_'.rand(1000,9999).'.'.$extension;
             $request->file('image')->move($dir, $FileNameimg);
             $News->image = $FileNameimg;
         }
        //PDF file is being uploaded from here
         if ($request->hasFile('pdf_file')) {
             $dir = 'uploads/';
             $extension = strtolower($request->file('pdf_file')->getClientOriginalExtension()); // get image extension
             $FileNamepdf =  time().'_'.rand(1000,9999).'.'.$extension;
             $request->file('pdf_file')->move($dir, $FileNamepdf);
             $News->pdf_file = $FileNamepdf;
         }
         if ($request->hasFile('file')) {
             $dir = 'uploads/';
             $size = $request->file('file')->getSize();
             $allowExt  = array('zip');
             $extension = strtolower($request->file('file')->getClientOriginalExtension()); // get image extension
             $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
             if(in_array($extension, $allowExt)){//check a valid image
               if($size < 200000000){ //check image size less than 5MB

             $request->file('file')->move($dir, $FileName);
             $News->file = $FileName;
             $zip = new ZipArchive();
             $res = $zip->open($dir.$FileName);
             if ($res === TRUE) {
             $path = public_path().'/uploads/flipbooks/' . $request->alias;
                     File::makeDirectory($path, $mode = 0777, true, true);
                     $newpath = '/uploads/flipbooks/' . $request->alias . '/index.html';
                      $News->link = $newpath;
             $zip->extractTo($path);
             }
             $zip->close();
             if(File::exists($dir.$FileName)){
             unlink($dir.$FileName);
             }else{
             return redirect()->back()->withErrors('No file exsists.')->withInput();  }
           }else{return redirect()->back()->withErrors('The File may not be greater than 200MB.')->withInput();}
           }else{return redirect()->back()->withErrors('Please Select proper image upload format')->withInput();}
         }else{
            $News->file = '';
              $News->link ='';
         }

            $News->title = $request->title;
                  $News->alias = $request->alias;
                       $News->meta_title = $request->meta_title;
                            $News->meta_description = $request->meta_description;
                                $News->meta_keywords = $request->meta_keywords;
                                     $News->status = $request->status;
                                          $News->save();

              return redirect('/admin/newsletters')->with('success','Newsletter has been Added Successfully');
        }
     }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 /*   public function search(Request $request)
    {
      if ($request->isMethod('get')){
         $rules = [
          'searchnewsletter' => 'required'
      ];
       $this->validate($request, $rules);
       $search = $request->input('searchnewsletter');
       $News = Newsletters::where('title', 'LIKE', '%'.$search.'%')->paginate(4);
       return view('admin.newsletters', compact('News'))->with('success','Searched Successfully');

      }else{
     return redirect('/admin/newsletters')->with('error','Error!!');
     }
    } */

    public function getAllNewsletters(){
      $data = Newsletters::query();
      //echo '<pre>';
      // print_r($data);
      //exit;
      return Datatables::eloquent($data)
      ->addColumn('action', 'inc.newslettersactions')
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
        return view('admin.newslettersform', ['NewsEdit' => Newsletters::find($id)]);
      }
       else {
               //Here we are putting validatin
                 $rules = [
                   'title' => 'required',
                      'alias' => 'required',
                       'link' => 'required',
                        'status'=> 'required',

                 ];
                 $this->validate($request, $rules);
                 $News = Newsletters::find($id);
                 if ($request->hasFile('image')) {
                     $dir = 'uploads/';
                     if ($News->image != '' && File::exists($dir . $News->image))
                         File::delete($dir . $News->image);
                         $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
                         $FileNameimg =  time().'_'.rand(1000,9999).'.'.$extension;
                         $request->file('image')->move($dir, $FileNameimg);
                         $News->image = $FileNameimg;
                 }elseif ($request->remove == 1 && File::exists('uploads/' . $News->image)) {
                File::delete('uploads/' . $News->image);
                $News->image = null;
                }


                if ($request->hasFile('pdf_file')) {
                    $dir = 'uploads/';
                    if ($News->pdf_file != '' && File::exists($dir . $News->pdf_file))
                        File::delete($dir . $News->pdf_file);
                        $extension = strtolower($request->file('pdf_file')->getClientOriginalExtension()); // get image extension
                        $FileNamepdf =  time().'_'.rand(1000,9999).'.'.$extension;
                        $request->file('pdf_file')->move($dir, $FileNamepdf);
                        $News->pdf_file = $FileNamepdf;
                }elseif ($request->remove == 1 && File::exists('uploads/' . $News->pdf_file)) {
               File::delete('uploads/' . $News->pdf_file);
               $News->pdf_file = null;
               }


                if ($request->hasFile('file')) {
                    //first deleting the old Directory
                      if ($News->alias != '' ){
                        $path = '/uploads/flipbooks/' . $News->alias;
                        File::deleteDirectory(public_path($path));
                      }

                      $dir = 'uploads/';
                      $size = $request->file('file')->getSize();
                      $allowExt  = array('zip');
                      $extension = strtolower($request->file('file')->getClientOriginalExtension()); // get image extension
                      $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
                      if(in_array($extension, $allowExt)){//check a valid image
                        if($size < 200000000){ //check image size less than 5MB

                      $request->file('file')->move($dir, $FileName);
                      $News->file = $FileName;
                      $zip = new ZipArchive();
                      $res = $zip->open($dir.$FileName);
                      if ($res === TRUE) {
                      $path = public_path().'/uploads/flipbooks/' . $request->alias;
                              File::makeDirectory($path, $mode = 0777, true, true);

                      $zip->extractTo($path);
                      }
                      $zip->close();

                    }else{return redirect()->back()->withErrors('The File may not be greater than 200MB.')->withInput();}
                     }else{return redirect()->back()->withErrors('Please Select proper image upload format')->withInput();}

                     if(File::exists($dir.$FileName)){
                     unlink($dir.$FileName);
                     }else{
                     return redirect()->back()->withErrors('No file exsists.')->withInput();  }

                   }else{
                      $News->file = '';
                      $newpath = '/uploads/flipbooks/' . $request->alias . '/index.html';
                      $News->link = $newpath;
                   }
               }




               $News->title = $request->title;
                     $News->alias = $request->alias;
                         $News->meta_title = $request->meta_title;
                             $News->meta_description = $request->meta_description;
                              $News->meta_keywords = $request->meta_keywords;
                               $News->status = $request->status;
                                    $News->save();
                 return redirect('/admin/newsletters')->with('success','Newsletter has been Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function delete($id)
    {
     //  Deleting newsletters
      try{ 
        $newsl = Newsletters::find($id);
        if($newsl !==null){
            $dir = 'uploads/';
            if($newsl->image != '' && File::exists($dir . $newsl->image)){  File::delete($dir . $newsl->image);}
            if($newsl->pdf_file != '' && File::exists($dir . $newsl->pdf_file))  {File::delete($dir . $newsl->pdf_file);}
            if($newsl->alias != ''){$path = '/uploads/flipbooks/' . $newsl->alias;   File::deleteDirectory(public_path($path)); }
            Newsletters::destroy($id);
            $message = "Newsletter Deleted Successfully";
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
              $Newsletter = Newsletters::find($id);
              if ($Newsletter!==null) {
                  $dir = 'uploads/';
             
                if($Newsletter->image != '' && File::exists($dir . $Newsletter->image)){  File::delete($dir . $Newsletter->image);}
                      if($Newsletter->pdf_file != '' && File::exists($dir . $Newsletter->pdf_file))  {File::delete($dir . $Newsletter->pdf_file);}
                         if($Newsletter->alias != ''){ $path = '/uploads/flipbooks/' . $Newsletter->alias;   File::deleteDirectory(public_path($path)); }

               
                Newsletters::destroy($id);
                return redirect('/admin/newsletters')->with('success', 'Newsletter Deleted');
                }
                else
                {  return redirect('/admin/newsletters')->withError('error', 'Newsletter Not Deleted'); }
     }*/

}
