<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
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
        $news = News::orderBy('created_at', 'desc')->paginate(4);
        return view('admin.news.index-news', compact('news'));

        return view('admin.news', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  return view('admin.news.create-news');
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
      $newsEdit = News::findOrFail($id);
      return view('admin.news.edit-news', compact('newsEdit'));

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

        $news = new News();
        if ($request->hasFile('image')) {
            $dir = 'uploads/';
            $extension = strtolower($request->file('image')->getClientOriginalExtension());
            $fileName = time() . '_' . rand(1000, 9999) . '.' . $extension;
            $request->file('image')->move($dir, $fileName);
            $news->image = $fileName;
        } else {
            $news->image = '';
        }

        $news->meta_title = $request->meta_title;
        $news->meta_description = $request->meta_description;
        $news->short_description = $request->short_description;
        $news->meta_keywords = $request->meta_keywords;
        $news->title = $request->title;
        $news->alias = $request->alias;
        $news->description = $request->description;
        $news->status = $request->status;
        $news->save();

        return redirect('/admin/news')->with('success', 'news has been added successfully');
    }
    public function update(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            return view('admin.newsform', ['newsEdit' => News::find($id)]);
        } else {
            $request->validate([
                'title' => 'required',
                'alias' => 'required',
                'short_description' => 'required',
                'status' => 'required',
                'description' => 'required',
                'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $news = News::find($id);

            if ($request->hasFile('image')) {
                $dir = 'uploads/';
                if ($news->image != '' && File::exists($dir . $news->image)) {
                    File::delete($dir . $news->image);
                }
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $fileName = time() . '_' . rand(1000, 9999) . '.' . $extension;
                $request->file('image')->move($dir, $fileName);
                $news->image = $fileName;
            } elseif ($request->remove == 1 && File::exists('uploads/' . $news->image)) {
                File::delete('uploads/' . $news->image);
                $news->image = null;
            }

            $news->fill($request->only([
                'meta_title',
                'meta_description',
                'meta_keywords',
                'title',
                'alias',
                'short_description',
                'description',
                'status',
            ]));

            $news->ordering = true;
            $news->save();

            return redirect('/admin/news')->with('success', 'News has been Updated Successfully');
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
            $news = News::findOrFail($id); // Using findOrFail to handle not found case
            $dir = 'uploads/';
            if ($news->image != '' && File::exists($dir . $news->image)) {
                File::delete($dir . $news->image);
            }
            $news->delete(); // Soft delete the project
            $message = "news Deleted Successfully";
            return redirect()->route('news.index')->with('success', $message); // Redirecting to index page
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return redirect()->route('news.index')->with('error', $message); // Redirecting to index page with error message
        }
    }


}