<?php

namespace App\Http\Controllers;


use App\Models\Newsletters; // Add this line

use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;

class NewslettersController extends Controller
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
        $newsLetter = Newsletters::orderBy('created_at', 'desc')->paginate(10); // Paginate by 10 items per page

        return view('admin.newsletters.index-newsletters', compact('newsLetter'));
    }

    public function edit($id)
    {
        $NewsEdit = Newsletters::findOrFail($id);
        return view('admin.newsletters.edit-newsletters', compact('NewsEdit'));


    }


    public function store(Request $request)
{
    // Validate the request data
    $rules = [
        'title' => 'required|string|max:61',
        'alias' => 'required|string|unique:newsletters,alias',
        'link' => 'nullable|string',
        'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
        'status' => 'required|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string',
        'meta_keywords' => 'nullable|string',
    ];
    $this->validate($request, $rules);

    $newsletter = new Newsletters();

    // Handle image upload
    if ($request->hasFile('image')) {
        $dir = 'uploads/';
        $extension = strtolower($request->file('image')->getClientOriginalExtension());
        $fileName = time() . '_' . rand(1000, 9999) . '.' . $extension;
        $request->file('image')->move($dir, $fileName);
        $newsletter->image = $fileName;
    } else {
        $newsletter->image = '';
    }

    // Handle PDF file upload
    if ($request->hasFile('pdf_file')) {
        $dir = 'uploads/';
        $extension = strtolower($request->file('pdf_file')->getClientOriginalExtension());
        $fileName = time() . '_' . rand(1000, 9999) . '.' . $extension;
        $request->file('pdf_file')->move($dir, $fileName);
        $newsletter->pdf_file = $fileName;
    }

    $newsletter->title = $request->title;
    $newsletter->alias = $request->alias;
    $newsletter->link = $request->link;
    $newsletter->status = $request->status;
    $newsletter->meta_title = $request->meta_title;
    $newsletter->meta_description = $request->meta_description;
    $newsletter->meta_keywords = $request->meta_keywords;

    $newsletter->save();

    // Redirect to the newsletters list with a success message
    return redirect()->route('newsletters.index')->with('success', 'Newsletter created successfully.');
}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

      return view('admin.newsletters.create-newsletters');

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
    $newsletter = Newsletters::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:61',
        'alias' => 'required|string', // Corrected validation rule
        'link' => 'nullable|string',
        'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
        'status' => 'required|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string',
        'meta_keywords' => 'nullable|string',
    ]);

    $newsletter->title = $request->input('title');
    $newsletter->alias = $request->input('alias'); // Corrected variable name
    $newsletter->link = $request->input('link');
    $newsletter->status = $request->input('status');

    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);
        $newsletter->image = $imageName;
    } elseif ($request->input('remove') == 1) {
        $newsletter->image = null;
    }

    if ($request->hasFile('pdf_file')) {
        $pdfName = time().'.'.$request->pdf_file->extension();
        $request->pdf_file->move(public_path('uploads'), $pdfName);
        $newsletter->pdf_file = $pdfName;
    } elseif ($request->input('remove') == 1) {
        $newsletter->pdf_file = null;
    }

    $newsletter->save();

    return redirect()->route('newsletters.index')->with('success', 'Newsletter updated successfully');
}


    public function delete($id)
{
    // User must be deleted softly i.e 0,1 i.e either it is one or zero
    try {
        $newsletters = Newsletters::findOrFail($id); // Using findOrFail to handle not found case
        $dir = 'uploads/';
        if ($newsletters->image != '' && File::exists($dir . $newsletters->image)) {
            File::delete($dir . $newsletters->image);
        }
        $newsletters->delete(); // Soft delete the widget
        $message = "Newsletters Deleted Successfully";
        return redirect()->route('newsletters.index')->with('success', $message); // Redirecting to index page
    } catch (\Exception $e) {
        $message = $e->getMessage();
        return redirect()->route('newsletters.index')->with('error', $message); // Redirecting to index page with error message
    }
}



}