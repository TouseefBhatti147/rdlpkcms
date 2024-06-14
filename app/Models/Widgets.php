<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widgets extends Model
{
  use HasFactory;

   protected $table = 'widgets';
   public static function getWidgets(){
    $mWidgets=[];
        $widgets = self::all(['title','link','image','alias','description','status','meta_title','meta_description','meta_keywords']);

        foreach ($widgets as $se){
        $mWidgets[$se->alias]['title']=$se->title;
        $mWidgets[$se->alias]['link']=$se->link;
        $mWidgets[$se->alias]['image']=$se->image;
        $mWidgets[$se->alias]['description']=$se->description;
        $mWidgets[$se->alias]['status']=$se->status;
        $mWidgets[$se->alias]['meta_title']=$se->meta_title;
        $mWidgets[$se->alias]['meta_description']=$se->meta_description;
        $mWidgets[$se->alias]['meta_keywords']=$se->meta_keywords;
      }
        return $mWidgets;
    }

    public static function getWidgetsCount(){
               $count = self::where('status','=','1')->count();
               return $count;
    }
}
