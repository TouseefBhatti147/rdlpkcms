<?php



namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Files extends Model
{
      use HasFactory;

  public static function getFiles(){
      $mFiles=[];

       $files = self::all(['title','title_first_line','title_second_line','image','alias','category','status','link']);

       foreach ($files as $se){
               $mFiles[$se->alias]['title']=$se->title;
               $mFiles[$se->alias]['title_first_line']=$se->title_first_line;
               $mFiles[$se->alias]['title_second_line']=$se->title_second_line;
                $mFiles[$se->alias]['image']=$se->image;
               /* $mFiles[$se->alias]['file']=$se->file; */
                  $mFiles[$se->alias]['link']=$se->link;
                   $mFiles[$se->alias]['category']=$se->category;
                    $mFiles[$se->alias]['status']=$se->status;
        }

       return $mFiles;
   }
   public static function getFilesCount(){
              $count = self::where('status','=','1')->count();
              return $count;
   }

   public static function getSliders(){
         $data = self::where('status','=',1)->where('category','=','slider')->get();
         return $data;
   }

}
