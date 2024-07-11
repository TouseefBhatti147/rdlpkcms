<?php

namespace App\Http\Controllers;
use App\Models\Files;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use ZipArchive;

class FilesController extends Controller
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
    public function show($id)
{
    $file = Files::findOrFail($id);
    return view('admin.files.view-files', compact('file'));
}

    public function index(Request $request)
    {
        $query = Files::query();

        if ($request->has('file_title') && $request->file_title) {
            $query->where('title', 'like', '%' . $request->file_title . '%');
        }

        if ($request->has('file_category') && $request->file_category) {
            $query->where('category', $request->file_category);
        }

        $files = $query->paginate(10);

        return view('admin.files.index-files', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
      if ($request->isMethod('get'))
       return view('admin.filesform');
       else {
         $rules = [
                'title' => 'required',
                 'category' => 'required',
                 'status' => 'required',
                 'alias'=> 'required',
                 'image'=> 'required'
           ];
        $this->validate($request, $rules);
        $File = new Files();

        /*Code for file starts here*/
             if ($request->hasFile('file')) {
            $dir = 'uploads/';
            $size = $request->file('file')->getSize();
            $allowExt  = array('zip');  //allow extenstion
            $extension = strtolower($request->file('file')->getClientOriginalExtension()); // get image extension
            $FileNamezip =  time().'_'.rand(1000,9999).'.'.$extension;
            if(in_array($extension, $allowExt)){//check a valid image
                    if($size < 200000000){ //check image size less than 5MB
                        $request->file('file')->move($dir, $FileNamezip);
                                    $File->file = $FileNamezip;
                                        $zip = new ZipArchive();
                                              $res = $zip->open($dir.$FileNamezip);
                                              if ($res === TRUE) {
                                              $path = public_path().'/uploads/flipbooks/' . $request->alias;
                                                      File::makeDirectory($path, $mode = 0777, true, true);
                                              $zip->extractTo($path);
                                              }
                                              $zip->close();


                                                        if(File::exists($dir.$FileNamezip)){
                                                         unlink($dir.$FileNamezip);

                                                           }else{
                                                             return redirect()->back()->withErrors('No file exsists.')->withInput();  }

                           $newpath = '/uploads/flipbooks/' . $request->alias . '/index.html';
                          $File->link = $newpath;
                   }else{return redirect()->back()->withErrors('The File may not be greater than 200MB.')->withInput();}
            }else{return redirect()->back()->withErrors('Please Select proper image upload format')->withInput();}
        }elseif($request->file==null){      $File->file =''; $File->link = $request->link;   }
        /*Code for file ends here*/

        if ($request->hasFile('image')) {
            $dir = 'uploads/';
            $size = $request->file('image')->getSize();
            $allowExt  = array('pdf','doc','png','jpg','jpeg','gif');
            $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
            $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
              if(in_array($extension, $allowExt)){//check a valid image
                if($size < 200000000){ //check image size less than 5MB
                  $request->file('image')->move($dir, $FileName);
                  $File->image = $FileName;
               }else{return redirect()->back()->withErrors('The File may not be greater than 200MB.')->withInput();}
             }else{return redirect()->back()->withErrors('Please Select proper image upload format')->withInput();}

        }//elseif($request->image==null){
                //    $File->image ='';
        //}
        $File->title = $request->title;

        if(isset($request->title_first_line)){
          $File->title_first_line = $request->title_first_line;
         }else{
          $File->title_first_line = '';
         }


        if(isset($request->title_second_line)){
          $File->title_second_line = $request->title_second_line;
         }else{
          $File->title_second_line = '';
         }



        $File->link_status = 0;
        $File->alias = $request->alias;
        $File->category = $request->category;
        $File->status = $request->status;
        $File->save();
        return redirect('/admin/files')->with('success','File has been Added Successfully');
       }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function getAllFiles(Request $request){
      $query = Files::query();

      $file_title = (!empty($request->file_title)) ? $request->file_title :  null;
      $file_category = (!empty($request->file_category)) ? $request->file_category :  null;

      if ($file_title !== null) { $query->where('files.title', '=', $file_title);  }
      if ($file_category !== null) {
        $query->where('files.category', '=',$file_category);   }
       $data = $query->select('id','title','category','status','image');

      //echo '<pre>';
      // print_r($data);
      //exit;
      return Datatables::eloquent($data)
      ->addColumn('action', 'inc.fileactions')
      ->addColumn('status', function($data) {
        $val = 1;
        if ($data->status !== $val) {
              return '<label class="badge badge-danger">Disabled</label>';  } else {
                     return '<label class="badge badge-success">Enabaled</label>';    }
        })
        ->addColumn('file', function ($data) {
          if($data->image!==''){
            $allowExt1  = array('pdf');
            $allowExt2  = array('jpeg','jpg','png');
            $info = pathinfo(storage_path().'uploads/'.$data->image);
            $extension = $info['extension'];
            if(in_array($extension, $allowExt1)){//check a valid image
            $url= asset('images/pdf.png');
            return '<img src="'.$url.'" height="70px" width="70px"/>';}
            elseif(in_array($extension, $allowExt2)){//check a valid image
            $url= asset('images/image.png');
            return '<img src="'.$url.'" height="70px" width="70px"/>';}
            else{
              $url= asset('images/nofile.png');
              return '<div class="image-diemensions"><img src="'.$url.'" height="150px" width="300px" /></div>';
            }
          }
        })
      ->rawColumns(['action','status','file'])
      ->addIndexColumn()
      ->make(true);
    }

    /*

      // $url= asset('uploads/'.$data->image);




          }else{

          }
    */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = Files::find($id);
        return view('admin.files.edit-files', compact('file'));
    }
    public function update(Request $request, $id)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:logo,slider,partnersandassociates,brochure,newsletter,ourgroup,isocertificates,others',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,png,jpg,jpeg|max:10240', // 10MB max size
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the file record
        $file = Files::findOrFail($id);

        // Update file properties
        $file->title = $request->title;
        $file->category = $request->category;
        $file->status = $request->status;

        // Handle file upload if a new file is provided
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($file->file && Storage::disk('public')->exists($file->file)) {
                Storage::disk('public')->delete($file->file);
            }

            // Store new file
            $file->file = $request->file('file')->store('files', 'public');
        }

        // Save changes to the database
        $file->save();

        // Redirect back with success message
        return redirect('/admin/files')->with('success', 'Pages has been added successfully');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
      try{
     $File = Files::find($id);
            if ($File!==null) {
                $dir = 'uploads/';
                   if($File->link != ''){ $path = '/uploads/flipbooks/' . $File->alias;   File::deleteDirectory(public_path($path)); }
                if ($File->image != '' && File::exists($dir . $File->image) ){

                     File::delete($dir . $File->image);
                     Files::destroy($id);
                     $message = "File Deleted Successfully";
                     return response()->json([
                     'status' => 200,
                     'message' => $message
                      ]);
                  }

              }/*if ends here*/
           }catch(\Exception $e)  {
            $message =  $e->getMessage();
           return response()->json(['status' => 400,
            'message' => $message]);
          }
       }/*Function ends here*/

}