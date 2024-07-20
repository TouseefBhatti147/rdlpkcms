<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\File;


class settingsController extends Controller
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
      $Settings = Settings::orderBy('created_at', 'desc')->paginate(10);
      return view('admin.settings', compact('Settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      if ($request->isMethod('get')){
               return view('admin.settingsform');
      }else{
               $rules = [
                     'name' => 'required',
                      'alias' => 'required',
                        'value' => 'required',
                          'status' => 'required'
                 ];
              $this->validate($request, $rules);
              $Setting = new Settings();
               $Setting->name = $request->name;
                $Setting->alias = $request->alias;
                  $Setting->value = $request->value;
                    $Setting->status = $request->status;
                     $Setting->save();
              return redirect('/admin/settings')->with('success','Setting has been Added Successfully');
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
           'searchsetting' => 'required'
       ];
        $this->validate($request, $rules);
        $search = $request->input('searchsetting');
        $Settings = Settings::where('name', 'LIKE', '%'.$search.'%')->paginate(2);
        return view('admin.settings', compact('Settings'))->with('success','Searched Successfully');

    }else{
     return redirect('/admin/settings')->with('error','Error!!');
     }
     }*/

     public function getAllSettings(){
      $data = Settings::query();
      //echo '<pre>';
      // print_r($data);
      //exit;
      return Datatables::eloquent($data)
      ->addColumn('action', 'inc.settingsactions')
      ->addColumn('status', function($data) {
        $val = 1;
        if ($data->status !== $val) {
              return '<label class="badge badge-danger">Disabled</label>';  } else {
                     return '<label class="badge badge-success">Enabaled</label>';    }
        })
       ->rawColumns(['action','status'])
       ->addIndexColumn()
       ->make(true);
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        return view('admin.settingsform', ['SettingEdit' => Settings::find($id)]);
      }
       else {
               //Here we are putting validatin
                 $rules = [
                   'name' => 'required',
                    'alias' => 'required',
                      'value' => 'required',
                        'status' => 'required'
                 ];
                 $this->validate($request, $rules);
                 $Setting =Settings::find($id);
                  $Setting->name = $request->name;
                   $Setting->alias = $request->alias;
                     $Setting->value = $request->value;
                       $Setting->status = $request->status;
                        $Setting->save();
                           return redirect('/admin/settings')->with('success','Settings has been Updated Successfully');
              }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}