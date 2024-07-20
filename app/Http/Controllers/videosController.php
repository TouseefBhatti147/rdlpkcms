<?php

namespace App\Http\Controllers;

use App\Models\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class VideosController extends Controller
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
        $videos = Videos::orderBy('created_at', 'desc')->paginate(4);
        return view('admin.videos.index-videos', compact('videos'));

        return view('admin.videos', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  return view('admin.videos.create-videos');
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
      $videosEdit = Videos::findOrFail($id);
      return view('admin.videos.edit-videos', compact('videosEdit'));

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
            'title' => 'required',
            'alias' => 'required',
            'status' => 'required'
        ];
        $this->validate($request, $rules);

        $videos = new Videos();



        $videos->title = $request->title;
        $videos->alias = $request->alias;
        $videos->status = $request->status;
        $videos->save();

        return redirect('/admin/videos')->with('success', 'videos has been added successfully');
    }
    public function update(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            return view('admin.videosform', ['videosEdit' => Videos::find($id)]);
        } else {
            $request->validate([
                'title' => 'required',
                'alias' => 'required',
                'status' => 'required',
            ]);

            $videos = Videos::find($id);

            if ($request->hasFile('image')) {
                $dir = 'uploads/';
                if ($videos->image != '' && File::exists($dir . $videos->image)) {
                    File::delete($dir . $videos->image);
                }
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $fileName = time() . '_' . rand(1000, 9999) . '.' . $extension;
                $request->file('image')->move($dir, $fileName);
                $videos->image = $fileName;
            } elseif ($request->remove == 1 && File::exists('uploads/' . $videos->image)) {
                File::delete('uploads/' . $videos->image);
                $videos->image = null;
            }

            $videos->fill($request->only([
                'title',
                'alias',
                'status',
            ]));

            $videos->save();

            return redirect('/admin/videos')->with('success', 'Videos has been Updated Successfully');
        }
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
            $videos = Videos::findOrFail($id); // Using findOrFail to handle not found case
            $dir = 'uploads/';
            if ($videos->image != '' && File::exists($dir . $videos->image)) {
                File::delete($dir . $videos->image);
            }
            $videos->delete(); // Soft delete the project
            $message = "videos Deleted Successfully";
            return redirect()->route('videos.index')->with('success', $message); // Redirecting to index page
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return redirect()->route('videos.index')->with('error', $message); // Redirecting to index page with error message
        }
    }


}