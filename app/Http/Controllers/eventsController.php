<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class EventsController extends Controller
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
        $events = Events::orderBy('created_at', 'desc')->paginate(4);
        return view('admin.events.index-events', compact('events'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  return view('admin.events.create-events');
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
      $eventsEdit = Events::findOrFail($id);
      return view('admin.events.edit-events', compact('eventsEdit'));

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
            'short_description' => 'required',
            'alias' => 'required',
            'description' => 'required',
            'status' => 'required'
        ];
        $this->validate($request, $rules);

        $events = new Events();
        if ($request->hasFile('image')) {
            $dir = 'uploads/';
            $extension = strtolower($request->file('image')->getClientOriginalExtension());
            $fileName = time() . '_' . rand(1000, 9999) . '.' . $extension;
            $request->file('image')->move($dir, $fileName);
            $events->image = $fileName;
        } else {
            $events->image = '';
        }

        $events->meta_title = $request->meta_title;
        $events->meta_description = $request->meta_description;
        $events->short_description = $request->short_description;
        $events->meta_keywords = $request->meta_keywords;
        $events->title = $request->title;
        $events->alias = $request->alias;
        $events->description = $request->description;
        $events->status = $request->status;
        $events->save();

        return redirect('/admin/events')->with('success', 'events has been added successfully');
    }
    public function update(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            return view('admin.eventsform', ['eventsEdit' => Events::find($id)]);
        } else {
            $request->validate([
                'title' => 'required',
                'alias' => 'required',
                'short_description' => 'required',
                'status' => 'required',
                'description' => 'required',
                'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $events = Events::find($id);

            if ($request->hasFile('image')) {
                $dir = 'uploads/';
                if ($events->image != '' && File::exists($dir . $events->image)) {
                    File::delete($dir . $events->image);
                }
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $fileName = time() . '_' . rand(1000, 9999) . '.' . $extension;
                $request->file('image')->move($dir, $fileName);
                $events->image = $fileName;
            } elseif ($request->remove == 1 && File::exists('uploads/' . $events->image)) {
                File::delete('uploads/' . $events->image);
                $events->image = null;
            }

            $events->fill($request->only([
                'meta_title',
                'meta_description',
                'meta_keywords',
                'title',
                'alias',
                'short_description',
                'description',
                'status',
            ]));

            $events->ordering = true;
            $events->save();

            return redirect('/admin/events')->with('success', 'events has been Updated Successfully');
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
            $events = Events::findOrFail($id); // Using findOrFail to handle not found case
            $dir = 'uploads/';
            if ($events->image != '' && File::exists($dir . $events->image)) {
                File::delete($dir . $events->image);
            }
            $events->delete(); // Soft delete the project
            $message = "events Deleted Successfully";
            return redirect()->route('events.index')->with('success', $message); // Redirecting to index page
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return redirect()->route('events.index')->with('error', $message); // Redirecting to index page with error message
        }
    }


}