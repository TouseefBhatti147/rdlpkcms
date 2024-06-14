<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
  use HasFactory;

  public static function getEvents(){

       $events = self::all(['title','short_description','event_date','image','alias','description','status','meta_title','meta_description','meta_keywords']);

       foreach ($events as $se){
               $mEvents[$se->alias]['title']=$se->title;
                $mEvents[$se->alias]['short_description']=$se->short_description;
                    $mEvents[$se->alias]['event_date']=$se->event_date;
                      $mEvents[$se->alias]['image']=$se->image;
                      $mEvents[$se->alias]['description']=$se->description;
                      $mEvents[$se->alias]['status']=$se->status;
                      $mEvents[$se->alias]['meta_title']=$se->meta_title;
                          $mEvents[$se->alias]['meta_description']=$se->meta_description;
                                      $mEvents[$se->alias]['meta_keywords']=$se->meta_keywords;
     }
       return $mEvents;
   }
   public static function getAllEvents(){

        $events = self::where('status', 1)->orderBy('created_at', 'desc')->get();
        return $events;
    }
    public static function getTwoEvents(){
        $events = self::where('status', 1)->orderBy('created_at', 'desc')->take(2)->get();
         return $events;
     }
     public static function getEventsCount(){
                $count = self::where('status','=','1')->count();
                return $count;
     }

}
