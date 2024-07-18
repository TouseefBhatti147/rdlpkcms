<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
use HasFactory;

// Specify the attributes that are mass assignable
protected $fillable = [
'title',
'image',
'alias',
'short_description',
'description',
'status',
'meta_title',
'meta_description',
'meta_keywords',
];

public static function getNews()
{
$mNews = [];
$news = self::all(['title', 'image', 'alias', 'short_description', 'description', 'status', 'meta_title',
'meta_description', 'meta_keywords']);

foreach ($news as $se) {
$mNews[$se->alias]['title'] = $se->title;
$mNews[$se->alias]['image'] = $se->image;
$mNews[$se->alias]['short_description'] = $se->short_description;
$mNews[$se->alias]['description'] = $se->description;
$mNews[$se->alias]['status'] = $se->status;
$mNews[$se->alias]['alias'] = $se->alias;
$mNews[$se->alias]['meta_title'] = $se->meta_title;
$mNews[$se->alias]['meta_description'] = $se->meta_description;
$mNews[$se->alias]['meta_keywords'] = $se->meta_keywords;
}
return $mNews;
}

public static function getAllNews()
{
$news = self::where('status', 1)->orderBy('created_at', 'desc')->get();
return $news;
}

public static function getTwoNews()
{
$news = self::where('status', 1)->orderBy('created_at', 'desc')->take(2)->get();
return $news;
}

public static function getNewsCount()
{
$count = self::where('status', '=', '1')->count();
return $count;
}
}