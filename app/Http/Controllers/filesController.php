<?php

namespace App\Http\Controllers;
use App\Models\Files;
use Illuminate\Support\Facades\Storage;


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

     public function store(Request $request)
     {
         $request->validate([
             'title' => 'required|string',
             'title_first_line' => 'nullable|string|max:255',
             'title_second_line' => 'nullable|string|max:255',
             'image' => 'required',
             'file' => 'nullable|string|max:150',
             'category' => 'required|string',
             'status' => 'nullable|boolean',
             'alias' => 'nullable|string|max:255',
             'link' => 'nullable|string|max:150',
             'link_status' => 'nullable|boolean',
         ]);

         $file = new Files();
         if ($request->hasFile('image')) {
          $dir = 'uploads/';
          $extension = strtolower($request->file('image')->getClientOriginalExtension());
          $fileName = time() . '_' . rand(1000, 9999) . '.' . $extension;
          $request->file('image')->move($dir, $fileName);
          $file->image = $fileName;
      } else {
          $file->image = '';
      }
         $file->title = $request->title;
         $file->title_first_line = $request->title_first_line;
         $file->title_second_line = $request->title_second_line;
         $file->file = $request->file;
         $file->category = $request->category;
         $file->status = $request->status;
         $file->alias = $request->alias;
         $file->link = $request->link;
         $file->link_status = $request->link_status;
         $file->save();
         return redirect('/admin/files')->with('success','File has been Added Successfully');
     }

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
        $file = Files::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'title_first_line' => 'nullable|string|max:255',
            'title_second_line' => 'nullable|string|max:255',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048', // Assuming image upload
            'file' => 'nullable|file|mimes:pdf|max:2048', // Assuming file upload
            'category' => 'nullable|string',
            'status' => 'required|boolean',
            'alias' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:150',
        ]);


        // Update the file's metadata
        $file->title = $request->input('title');
        $file->title_first_line = $request->input('title_first_line');
        $file->title_second_line = $request->input('title_second_line');
        $file->category = $request->input('category');
        $file->status = $request->input('status');
        $file->alias = $request->input('alias');
        $file->link = $request->input('link');
        $file->link_status = $request->input('link_status');

        if ($request->hasFile('image')) {
          $imageName = time().'.'.$request->image->extension();
          $request->image->move(public_path('uploads'), $imageName);
          $file->image = $imageName;
      } elseif ($request->input('remove') == 1) {
          $file->image = null;
      }

        $file->save();


        return redirect('/admin/files')->with('success','File has been Updated Successfully');
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
     // User must be deleted softly i.e 0,1 i.e either it is one or zero
     try {
      $file = Files::findOrFail($id); // Using findOrFail to handle not found case
      $dir = 'uploads/';
      if ($file->image != '' && File::exists($dir . $file->image)) {
          File::delete($dir . $file->image);
      }
      $file->delete(); // Soft delete the widget
      $message = "File Deleted Successfully";
      return redirect('/admin/files')->with('success','File has been Updated Successfully');
    } catch (\Exception $e) {
      $message = $e->getMessage();
      return redirect()->route('file.index')->with('error', $message); // Redirecting to index page with error message
  }
    }/*Function ends here*/

}