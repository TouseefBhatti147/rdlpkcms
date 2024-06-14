<?php

namespace App\Http\Controllers\User;
use App\Models\Widgets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class userWidgetsController extends Controller
{

     public function __construct()
     {
         $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $Widgets = Widgets::orderBy('created_at', 'desc')->paginate(10);
            return view('admin.widgets', compact('Widgets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function search(Request $request)
     {
       if ($request->isMethod('get')){
          $rules = [
           'searchwidget' => 'required'
       ];
        $this->validate($request, $rules);
        $search = $request->input('searchwidget');
        $Widgets = Widgets::where('title', 'LIKE', '%'.$search.'%')->paginate(4);
        return view('admin.widgets', compact('Widgets'))->with('success','Searched Successfully');

   }else{
    return redirect('/user/widgets')->with('error','Error!!');
   }
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {
       if ($request->isMethod('get')){
         return view('admin.widgetsform', ['WidgetEdit' => Widgets::find($id)]);
       }
        else {
                //Here we are putting validatin

                  $Widget = Widgets::find($id);
                  if ($request->hasFile('image')) {
                      $dir = 'uploads/';
                      if ($Widget->image != '' && File::exists($dir . $Widget->image))
                          File::delete($dir . $Widget->image);
                      $extension = strtolower($request->file('image')->getClientOriginalExtension());
                      $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
                      $request->file('image')->move($dir, $FileName);
                      $Widget->image = $FileName;
                  }elseif ($request->remove == null && File::exists('uploads/' . $Widget->image)) {
                      File::delete('uploads/' . $Widget->image);
                     $Widget->image = '';
                 }
                }

                $Widget->save();
                  return redirect('/user/widgets')->with('success','Widget has been Updated Successfully');
     }
}
