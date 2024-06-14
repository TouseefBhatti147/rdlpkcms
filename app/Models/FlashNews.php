<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
class FlashNews extends Model
{
   //function to get the flash news in between two dates start here
    public static function getFlashNews(){
    $date = Carbon::today()->toDateString();
    $active = 1;
    $flash = self::select(['title','image','description','link','created_at'])
    ->where('status','=',$active)
    ->where('start_date','<=',$date)
    ->where('end_date','>=',$date)
    ->orderBy('ordering', 'desc')->get();
     return $flash;
   }
   //function of in between dates end here

   public static function getLastFlashNews(){
       try{
        $flash = self::select('ordering')->orderBy('created_at', 'desc')
        ->take(1)
        ->first();
        return $flash->ordering + 001;
        }catch(\Exception $e)  {
        $default = 1 ;
        return $default;
       }
    }

    //Function to get newsflash count starts here
    public static function getFNewsCount(){
      $count = self::where('status','=','1')->count();
      return $count;
     }
    //Function to get flashnews ends here
}
