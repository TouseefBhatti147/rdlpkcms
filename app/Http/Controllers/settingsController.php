<?php

namespace App\Http\Controllers;
use App\Models\Pages;
use App\Models\Settings;
use App\Models\Offices;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;


class SettingsController extends Controller
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
      $settings = Settings::paginate(10); // Adjust the number of items per page as needed
      return view('admin.settings.index-settings', compact('settings'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

      return view('admin.settings.create-settings');

    }
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'website' => 'required',
            'alias' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'status' => 'required'
        ];
        $this->validate($request, $rules);

        $project = new Settings();
        if ($request->hasFile('image')) {
            $dir = 'uploads/';
            $extension = strtolower($request->file('image')->getClientOriginalExtension());
            $fileName = time() . '_' . rand(1000, 9999) . '.' . $extension;
            $request->file('image')->move($dir, $fileName);
            $project->image = $fileName;
        } else {
            $project->image = '';
        }

        $project->meta_title = $request->meta_title;
        $project->meta_description = $request->meta_description;
        $project->short_description = $request->short_description;
        $project->meta_keywords = $request->meta_keywords;
        $project->title = $request->title;
        $project->website = $request->website;
        $project->alias = $request->alias;
        $project->description = $request->description;
        $project->status = $request->status;
        $project->save();

        return redirect('/admin/settings')->with('success', 'project has been added successfully');
    }
    public function edit($id)
    {
        $ProjectEdit = Settings::findOrFail($id);
        return view('admin.settings.edit-settings', compact('ProjectEdit'));
    }
    public function update(Request $request, $id)
    {
        $project = Settings::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'alias' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'status' => 'required|boolean',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $project->title = $request->input('title');
        $project->alias = $request->input('alias');
        $project->website = $request->input('website');
        $project->status = $request->input('status');
        $project->description = $request->input('description');
        $project->short_description = $request->input('short_description');
        $project->meta_title = $request->input('meta_title');
        $project->meta_description = $request->input('meta_description');
        $project->meta_keywords = $request->input('meta_keywords');

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $project->image = $imageName;
        } elseif ($request->input('remove') == 1) {
            $project->image = null;
        }

        $project->save();

        return redirect()->route('settings.index')->with('success', 'project updated successfully');
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
            $project = Settings::findOrFail($id); // Using findOrFail to handle not found case
            $dir = 'uploads/';
            if ($project->image != '' && File::exists($dir . $project->image)) {
                File::delete($dir . $project->image);
            }
            $project->delete(); // Soft delete the project
            $message = "project Deleted Successfully";
            return redirect()->route('settings.index')->with('success', $message); // Redirecting to index page
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return redirect()->route('settings.index')->with('error', $message); // Redirecting to index page with error message
        }
    }




}