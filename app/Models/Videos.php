<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
use HasFactory;

// Specify the attributes that are mass assignable
protected $fillable = [
'title',
'alias',
'status',
];

public static function getVideos()
{
$mVideos = [];
$videos = self::all(['title', 'alias', 'status']);

foreach ($videos as $se) {
$mVideos[$se->alias]['title'] = $se->title;
$mVideos[$se->alias]['alias'] = $se->alias;
$mVideos[$se->alias]['status'] = $se->status;
}
return $mVideos;
}

public static function getAllVideos()
{
$value = 1;
$videos = self::where('status', $value)->get();
return $videos;
}

public static function getTwoVideos()
{
$videos = self::where('status', 1)->orderBy('created_at', 'desc')->take(2)->get();
return $videos;
}

public static function getVideosCount()
{
$count = self::where('status', '=', '1')->count();
return $count;
}
}