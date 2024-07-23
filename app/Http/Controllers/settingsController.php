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
            'name' => 'required',
            'alias' => 'required',
            'value' => 'required',
            'status' => 'required'
        ];
        $this->validate($request, $rules);

        $setting = new Settings();



        $setting->name = $request->name;
        $setting->alias = $request->alias;
        $setting->value = $request->value;
        $setting->status = $request->status;
        $setting->save();

        return redirect('/admin/settings')->with('success', 'setting has been added successfully');
    }
    public function edit($id)
    {
        $SettingEdit = Settings::findOrFail($id);
        return view('admin.settings.edit-settings', compact('SettingEdit'));
    }
    public function update(Request $request, $id)
    {
        $setting = Settings::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'alias' => 'required|string|max:255',
            'status' => 'required|boolean',
            'value' => 'required',

        ]);

        $setting->name = $request->input('name');
        $setting->alias = $request->input('alias');
        $setting->status = $request->input('status');
        $setting->value = $request->input('value');

        $setting->save();

        return redirect()->route('settings.index')->with('success', 'setting updated successfully');
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
            $setting = Settings::findOrFail($id); // Using findOrFail to handle not found case

            $setting->delete(); // Soft delete the setting
            $message = "setting Deleted Successfully";
            return redirect()->route('settings.index')->with('success', $message); // Redirecting to index page
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return redirect()->route('settings.index')->with('error', $message); // Redirecting to index page with error message
        }
    }




}