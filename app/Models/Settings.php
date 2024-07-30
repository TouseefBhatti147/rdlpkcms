<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Settings extends Model
{
  use HasFactory;
/*
  public static function getSettings(){
    $mSettings = []; // Initialize the variable

       $settings = self::all(['name','value','status']);

       foreach ($settings as $se){
               $mSettings[$se->alias]['status']=$se->status;
             $mSettings[$se->alias]['value']=$se->value;

       }
       return $mSettings;
   }
 */
public static function getSettings(){
  return self::where('status', 1)->get()->keyBy(function($item) {
    return str_replace(' ', '-', strtolower($item->name));
  })->toArray();
}



   public static function getSetting($alias){
           $settingsVal = self::select('value')->where(['alias'=>$alias,'status'=>1])->first();
           return $settingsVal->value;
       }
       public static function getSettingsCount(){
                  $count = self::where('status','=','1')->count();
                  return $count;
       }
}