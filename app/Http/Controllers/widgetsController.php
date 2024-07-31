<?php

namespace App\Http\Controllers;


use App\Models\Widgets; // Add this line
use Illuminate\Support\Facades\Auth; // Make sure this line is included

use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;

class WidgetsController extends Controller
{

  public function __construct()
  {
   $this->middleware('auth:admin');

  }
  public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login1');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::check()) {
            // If not authenticated, redirect to the login screen
            return redirect()->route('admin.login')->with('error', 'You must be logged in to access this page.');
        }
      $widgets = Widgets::paginate(10); // Adjust the number of items per page as needed
      return view('admin.widgets.index-widgets', compact('widgets'));

    }

    public function edit($id)
    {
        if (!Auth::check()) {
            // If not authenticated, redirect to the login screen
            return redirect()->route('admin.login')->with('error', 'You must be logged in to access this page.');
        }
        $widget = Widgets::findOrFail($id);
        return view('admin.widgets.edit-widgets', compact('widget'));
    }


    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'link' => 'required',
            'alias' => 'required',
            'description' => 'required',
            'status' => 'required'
        ];
        $this->validate($request, $rules);

        $widget = new Widgets();
        if ($request->hasFile('image')) {
            $dir = 'uploads/';
            $extension = strtolower($request->file('image')->getClientOriginalExtension());
            $fileName = time() . '_' . rand(1000, 9999) . '.' . $extension;
            $request->file('image')->move($dir, $fileName);
            $widget->image = $fileName;
        } else {
            $widget->image = '';
        }

        $widget->meta_title = $request->meta_title;
        $widget->meta_description = $request->meta_description;
        $widget->meta_keywords = $request->meta_keywords;
        $widget->title = $request->title;
        $widget->link = $request->link;
        $widget->alias = $request->alias;
        $widget->description = $request->description;
        $widget->status = $request->status;
        $widget->save();

        return redirect('/admin/widgets')->with('success', 'Widget has been added successfully');
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!Auth::check()) {
            // If not authenticated, redirect to the login screen
            return redirect()->route('admin.login')->with('error', 'You must be logged in to access this page.');
        }

      return view('admin.widgets.create-widgets');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


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

    public function update(Request $request, $id)
    {
        $widget = Widgets::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'alias' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'status' => 'required|boolean',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $widget->title = $request->input('title');
        $widget->alias = $request->input('alias');
        $widget->link = $request->input('link');
        $widget->status = $request->input('status');
        $widget->description = $request->input('description');
        $widget->meta_title = $request->input('meta_title');
        $widget->meta_description = $request->input('meta_description');
        $widget->meta_keywords = $request->input('meta_keywords');

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $widget->image = $imageName;
        } elseif ($request->input('remove') == 1) {
            $widget->image = null;
        }

        $widget->save();

        return redirect()->route('widgets.index')->with('success', 'Widget updated successfully');
    }

    public function delete($id)
{
    // User must be deleted softly i.e 0,1 i.e either it is one or zero
    try {
        $widget = Widgets::findOrFail($id); // Using findOrFail to handle not found case
        $dir = 'uploads/';
        if ($widget->image != '' && File::exists($dir . $widget->image)) {
            File::delete($dir . $widget->image);
        }
        $widget->delete(); // Soft delete the widget
        $message = "Widget Deleted Successfully";
        return redirect()->route('widgets.index')->with('success', $message); // Redirecting to index page
    } catch (\Exception $e) {
        $message = $e->getMessage();
        return redirect()->route('widgets.index')->with('error', $message); // Redirecting to index page with error message
    }
}



}