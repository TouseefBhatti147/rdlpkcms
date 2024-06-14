<?php

namespace App\Http\Controllers;

use App\Offices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;

class officesController extends Controller
{


  public function __construct()
  {  $this->middleware('auth:admin');  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { $Offices = Offices::orderBy('created_at', 'desc')->paginate(6);
      return view('admin.offices', compact('Offices')); }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Office creation starts here
    public function create(Request $request)
    {
      if ($request->isMethod('get')){  return view('admin.officesform');
      }else{
         $rules = [
           'office_title'=>'required',
           'alias'  =>'required',
           'address' => 'required',
           'category' => 'required',
           'city' => 'required',
           'status' => 'required',
           ];
           $this->validate($request, $rules);
           //Initializing the values as empty if they don't exsist
           $telephone_1 = (!empty($request->telephone_1)) ? $request->telephone_1 :  null;
           $telephone_2 = (!empty($request->telephone_2)) ? $request->telephone_2 :  null;
           $telephone_3 = (!empty($request->telephone_3)) ? $request->telephone_3 :  null;
           $telephone_4 = (!empty($request->telephone_4)) ? $request->telephone_4 :  null;
           $email_1 = (!empty($request->email_1)) ? $request->email_1 :  null;
           $email_2 = (!empty($request->email_2)) ? $request->email_2 :  null;
           $fax_number = (!empty($request->fax_number)) ? $request->fax_number :  null;
           $uan_number = (!empty($request->uan_number)) ? $request->uan_number :  null;
           //Office creation for database starts here
           $Office = new Offices();
           $Office->office_title = $request->office_title;
           $Office->alias = $request->alias;
           $Office->telephone_1 = $telephone_1;
           $Office->telephone_2 = $telephone_2;
           $Office->telephone_3 = $telephone_3;
           $Office->telephone_4 = $telephone_4;
           $Office->email_1 = $email_1;
           $Office->email_2 = $email_2;
           $Office->fax_number = $fax_number;
           $Office->uan_number = $uan_number;
           $Office->address = $request->address;
           $Office->category = $request->category;
           $Office->city = $request->city;
           $Office->status = $request->status;
           $Office->save();
           return redirect('/admin/offices')->with('success','Office has been Added Successfully');
         }
    }//Office creaton ends here


    public function getAllOffices(){
      $data = Offices::query();
      //echo '<pre>';
      // print_r($data);
      //exit;
      return Datatables::eloquent($data)
      ->addColumn('action', 'inc.officesactions')
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

    public function update(Request $request, $id)
    { if ($request->isMethod('get')){
        return view('admin.officesform', ['OfficeEdit' => Offices::find($id)]);
      }
       else {
               //Here we are putting validatin
                 $rules = [
                  'office_title'=>'required',
                  'alias'  =>'required',
                  'address' => 'required',
                  'category' => 'required',
                  'city' => 'required',
                  'status' => 'required',
                 ];
                 $this->validate($request, $rules);
                 //Initializing the values as empty if they don't exsist
                 $telephone_1 = (!empty($request->telephone_1)) ? $request->telephone_1 :  null;
                 $telephone_2 = (!empty($request->telephone_2)) ? $request->telephone_2 :  null;
                 $telephone_3 = (!empty($request->telephone_3)) ? $request->telephone_3 :  null;
                 $telephone_4 = (!empty($request->telephone_4)) ? $request->telephone_4 :  null;
                 $email_1 = (!empty($request->email_1)) ? $request->email_1 :  null;
                 $email_2 = (!empty($request->email_2)) ? $request->email_2 :  null;
                 $fax_number = (!empty($request->fax_number)) ? $request->fax_number :  null;
                 $uan_number = (!empty($request->uan_number)) ? $request->uan_number :  null;
                 //Office creation for database starts here
                 $Office = Offices::find($id);
                 $Office->office_title = $request->office_title;
                 $Office->alias = $request->alias;
                 $Office->telephone_1 = $telephone_1;
                 $Office->telephone_2 = $telephone_2;
                 $Office->telephone_3 = $telephone_3;
                 $Office->telephone_4 = $telephone_4;
                 $Office->email_1 = $email_1;
                 $Office->email_2 = $email_2;
                 $Office->fax_number = $fax_number;
                 $Office->uan_number = $uan_number;
                 $Office->address = $request->address;
                 $Office->category = $request->category;
                 $Office->city = $request->city;
                 $Office->status = $request->status;
                 $Office->update();
                 return redirect('/admin/offices')->with('success','Office has been Updated Successfully');
              }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
     //Logic for deletion starts here
     public function delete($id)
     {
       $office = Offices::find($id);
              if ($office!==null) {
                try{
                  Offices::destroy($id);
                  $message = "Office Deleted Successfully";
                  return response()->json([
                  'status' => 200,
                  'message' => $message
                 ]);
                }catch(\Exception $e){
                  $message =  $e->getMessage();
                  return back()->withErrors($message);
                }
        }/*if ends here*/
     }//Logic for deletion ends here



   /*  public function delete($id)
     {
       $Office = Offices::find($id);
              if ($Office!==null) {
                Offices::destroy($id);
                  return redirect('/admin/offices')->with('success', 'Office Deleted');
                    }else{
                      return redirect('/admin/videos')->with('error', 'Error');}
        }*/
}
