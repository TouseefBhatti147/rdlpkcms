<?php

namespace App\Http\Controllers;


use App\Models\Pages; // Add this line

use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;

class PagesController extends Controller
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
      $pages = Pages::paginate(10); // Adjust the number of items per page as needed
      return view('admin.pages.index-pages', compact('pages'));

    }

    public function edit($id)
    {
        $page = Pages::findOrFail($id);
        return view('admin.pages.edit-pages', compact('page'));
    }


    public function store(Request $request)
    {
      $rules = [
        'title' => 'required',
        'status' => 'required',
        'alias' => 'required',
        'description' => 'required',
         /*   'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',*/
       ];
        $this->validate($request, $rules);
        $Page = new Pages();
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

     $Page->meta_title = $request->meta_title;
     $Page->meta_description = $request->meta_description;
     $Page->meta_keywords = $request->meta_keywords;
     $Page->title = $request->title;
     $Page->website = $request->website;
     $Page->alias = $request->alias;
     $Page->description = $request->description;
     $Page->status = $request->status;
     $Page->ordering = true;
     $Page->save();
        return redirect('/admin/pages')->with('success', 'Pages has been added successfully');
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

      return view('admin.pages.create-pages');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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


    public function update(Request $request, $id)
    {
        $page = Pages::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'alias' => 'required|string|max:255',
            'status' => 'required|boolean',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $page->title = $request->input('title');
        $page->alias = $request->input('alias');
        $page->website = $request->input('website');
        $page->status = $request->input('status');
        $page->description = $request->input('description');
        $page->meta_title = $request->input('meta_title');
        $page->meta_description = $request->input('meta_description');
        $page->meta_keywords = $request->input('meta_keywords');

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = $imageName;
        } elseif ($request->input('remove') == 1) {
            $page->image = null;
        }

        $page->save();

        return redirect()->route('pages.index')->with('success', 'Page updated successfully');
    }

    public function delete($id)
{
    // User must be deleted softly i.e 0,1 i.e either it is one or zero
    try {
        $page = Pages::findOrFail($id); // Using findOrFail to handle not found case
        $dir = 'uploads/';
        if ($page->image != '' && File::exists($dir . $page->image)) {
            File::delete($dir . $page->image);
        }
        $page->delete(); // Soft delete the widget
        $message = "Page Deleted Successfully";
        return redirect()->route('pages.index')->with('success', $message); // Redirecting to index page
    } catch (\Exception $e) {
        $message = $e->getMessage();
        return redirect()->route('pages.index')->with('error', $message); // Redirecting to index page with error message
    }
}



}