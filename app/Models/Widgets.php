<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widgets extends Model
{
use HasFactory;

protected $table = 'widgets';

public static function getWidgets()
{
$widgets = self::all(['title', 'link', 'image', 'alias', 'description', 'status', 'meta_title', 'meta_description',
'meta_keywords']);
$mWidgets = [];

foreach ($widgets as $widget) {
$mWidgets[$widget->alias] = [
'title' => $widget->title,
'link' => $widget->link,
'image' => $widget->image,
'description' => $widget->description,
'status' => $widget->status,
'meta_title' => $widget->meta_title,
'meta_description' => $widget->meta_description,
'meta_keywords' => $widget->meta_keywords,
];
}

return $mWidgets;
}

public static function getWidgetsCount()
{
return self::where('status', '=', '1')->count();
}
}