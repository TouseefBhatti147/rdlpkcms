<?php

namespace App\Http\Controllers;


use App\Models\FlashNews; // Add this line

use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;

class FlashNewsController extends Controller
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
        $flashNews = FlashNews::orderBy('created_at', 'desc')->paginate(10); // Paginate by 10 items per page

        return view('admin.flashnews.index-flashnews', compact('flashNews'));
    }

    public function edit($id)
    {
        $flashNews = FlashNews::findOrFail($id);
        return view('admin.flashnews.edit-flashnews', compact('flashNews'));
    }


    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'link' => 'required',
            'image' => 'required|image',  // Added image validation rule
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required'
        ];
        $this->validate($request, $rules);

        $news = new FlashNews();
        if ($request->hasFile('image')) {
            $dir = 'uploads/';
            $extension = strtolower($request->file('image')->getClientOriginalExtension());
            $fileName = time() . '_' . rand(1000, 9999) . '.' . $extension;
            $request->file('image')->move($dir, $fileName);
            $news->image = $fileName;
        } else {
            $news->image = '';
        }

        $news->title = $request->title;
        $news->link = $request->link;
        $news->description = $request->description;
        $news->status = $request->status;
        $news->start_date = $request->start_date;
        $news->end_date = $request->end_date;
        $news->save();

        return redirect('/admin/flashnews')->with('success', 'FlashNews has been added successfully');
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

      return view('admin.flashnews.create-flashnews');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     public function getAllFlashNews(){

      $data = FlashNews::query();
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
        $news = FlashNews::findOrFail($id);

        $request->validate([

            'start_date' => 'required',
            'end_date' => 'required',
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'status' => 'required|boolean',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $news->title = $request->input('title');
        $news->link = $request->input('link');
        $news->status = $request->input('status');
        $news->description = $request->input('description');
        $news->start_date = $request->input('start_date');
        $news->end_date = $request->input('end_date');

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $news->image = $imageName;
        } elseif ($request->input('remove') == 1) {
            $news->image = null;
        }

        $news->save();

        return redirect()->route('flashnews.index')->with('success', 'FlashNews updated successfully');
    }

    public function delete($id)
{
    // User must be deleted softly i.e 0,1 i.e either it is one or zero
    try {
        $widget = FlashNews::findOrFail($id); // Using findOrFail to handle not found case
        $dir = 'uploads/';
        if ($widget->image != '' && File::exists($dir . $widget->image)) {
            File::delete($dir . $widget->image);
        }
        $widget->delete(); // Soft delete the widget
        $message = "Flashnews Deleted Successfully";
        return redirect()->route('flashnews.index')->with('success', $message); // Redirecting to index page
    } catch (\Exception $e) {
        $message = $e->getMessage();
        return redirect()->route('flashnews.index')->with('error', $message); // Redirecting to index page with error message
    }
}



}