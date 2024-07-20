<?php

namespace App\Http\Controllers;

use App\Models\Offices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class OfficesController extends Controller
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
        $offices = Offices::orderBy('created_at', 'desc')->paginate(4);
        return view('admin.offices.index-offices', compact('offices'));

        return view('admin.offices', compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  return view('admin.offices.create-offices');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // This method can be implemented if needed.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $OfficeEdit = Offices::findOrFail($id);
      return view('admin.offices.edit-offices', compact('OfficeEdit'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
    public function update(Request $request, $id)
    {
        $offices = Offices::findOrFail($id);

        $validatedData = $request->validate([
            'office_title' => 'required|string|max:255',
            'alias' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'category' => 'required|string|in:head_office,corporate_office,sales_and_marketing,global_office',
            'city' => 'nullable|string|max:255',
            'telephone_1' => 'nullable|string|max:20',
            'telephone_2' => 'nullable|string|max:20',
            'telephone_3' => 'nullable|string|max:20',
            'telephone_4' => 'nullable|string|max:20',
            'email_1' => 'nullable|email|max:255',
            'email_2' => 'nullable|email|max:255',
            'uan_number' => 'nullable|string|max:50',
            'fax_number' => 'nullable|string|max:50',
            'status' => 'required|boolean',
        ]);
        $offices->update($validatedData);

            $offices->save();

            return redirect('/admin/offices')->with('success', 'Office has been Updated Successfully');

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
            $offices = Offices::findOrFail($id); // Using findOrFail to handle not found case
            $dir = 'uploads/';
            if ($offices->image != '' && File::exists($dir . $offices->image)) {
                File::delete($dir . $offices->image);
            }
            $offices->delete(); // Soft delete the project
            $message = "Office Deleted Successfully";
            return redirect()->route('offices.index')->with('success', $message); // Redirecting to index page
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return redirect()->route('offices.index')->with('error', $message); // Redirecting to index page with error message
        }
    }


}