<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Newsletters extends Model
{
  protected $fillable = ['title','alias','link','image','file','status'];
  public static function getNewslettersCount(){
             $count = self::where('status','=','1')->count();
             return $count;
  }

  public static function getNewsletters(){
       $newsletter = self::where('status', 1)->orderBy('created_at', 'desc')->get();
       return $newsletter;
   }

   public static function getTwoNewsletters(){
     $newsletter = self::where('status', 1)->orderBy('created_at', 'desc')->take(2)->get();
      return $newsletter;
    }


}
