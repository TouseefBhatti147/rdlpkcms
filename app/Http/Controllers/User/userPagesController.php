<?php

namespace App\Http\Controllers\User;
use App\Pages;
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
      $Pages = Pages::orderBy('created_at', 'desc')->paginate(10);
            return view('admin.pages', compact('Pages'));
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
           'searchpage' => 'required'
       ];
        $this->validate($request, $rules);
        $search = $request->input('searchpage');
        $Pages = Pages::where('title', 'LIKE', '%'.$search.'%')->paginate(4);
        return view('admin.pages', compact('Pages'))->with('success','Searched Successfully');

    }else{
     return redirect('/user/pages')->with('error','Error!!');
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
         return view('admin.pagesform', ['PageEdit' => Pages::find($id)]);
       }
        else {  $Page = Pages::find($id);
                  if ($request->hasFile('image')) {
                      $dir = 'uploads/';
                      if ($Page->image != '' && File::exists($dir . $Page->image))
                          File::delete($dir . $Page->image);
                      $extension = strtolower($request->file('image')->getClientOriginalExtension());
                      $FileName =  time().'_'.rand(1000,9999).'.'.$extension;
                      $request->file('image')->move($dir, $FileName);
                      $Page->image = $FileName;
                  }elseif ($request->remove == null && File::exists('uploads/' . $Page->image)) {
                      File::delete('uploads/' . $Page->image);
                     $Page->image = '';
                 }
                }

                $Page->save();
                  return redirect('/user/pages')->with('success','Page has been Updated Successfully');

}
}