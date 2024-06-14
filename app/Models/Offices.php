<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offices extends Model
{
   use HasFactory;

  public static function getOffices(){
       $offices = self::all(['address','alias','category','city','office_title','telephone_1','telephone_2','telephone_3','telephone_4','email_1','email_2','fax_number','uan_number','status']);
       if (!$offices->isEmpty()) {
        foreach ($offices as $se){
                $mOffices[$se->alias]['address']=$se->address;
                $mOffices[$se->alias]['category']=$se->category;
                $mOffices[$se->alias]['city']=$se->city;
                $mOffices[$se->alias]['office_title']=$se->office_title;
                $mOffices[$se->alias]['telephone_1']=$se->telephone_1;
                $mOffices[$se->alias]['telephone_2']=$se->telephone_2;
                $mOffices[$se->alias]['telephone_3']=$se->telephone_3;
                $mOffices[$se->alias]['telephone_4']=$se->telephone_4;
                $mOffices[$se->alias]['email_1']=$se->email_1;
                $mOffices[$se->alias]['email_2']=$se->email_2;
                $mOffices[$se->alias]['fax_number']=$se->fax_number;
                $mOffices[$se->alias]['uan_number']=$se->uan_number;
                $mOffices[$se->alias]['status']=$se->status;
        }
        return $mOffices;
       }else{
          $error = 'No office found';
          return $error;
       }

   }
   public static function getOfficesCount(){
              $count = self::where('status','=','1')->count();
              return $count;
   }
}
