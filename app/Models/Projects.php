<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
  use HasFactory;

  public static function getProjects(){
    $mProjects=[];
       $projects = self::all(['title','broucher_link','website','image','alias','description','status','meta_title','meta_description','meta_keywords']);

       foreach ($projects as $se){
               $mProjects[$se->alias]['title']=$se->title;
               $mProjects[$se->alias]['broucher_link']=$se->broucher_link;
                  $mProjects[$se->alias]['website']=$se->website;
                      $mProjects[$se->alias]['image']=$se->image;
                           $mProjects[$se->alias]['description']=$se->description;
                              $mProjects[$se->alias]['status']=$se->status;
                                                    $mProjects[$se->alias]['alias']=$se->alias;
                                                    $mProjects[$se->alias]['meta_title']=$se->meta_title;
                                                            $mProjects[$se->alias]['meta_description']=$se->meta_description;
                                                                      $mProjects[$se->alias]['meta_keywords']=$se->meta_keywords;
     }
       return $mProjects;
   }
   public static function getAllcureentProjects(){
     $value = 1;
        $projects = self::where('status', 1 )->where('project_status', 'current' )->orderBy('created_at', 'desc')->get();
        return $projects;
    }
    public static function getAllupcomingProjects(){
      $value = 1;
         $projects = self::where('status', 1 )->where('project_status', 'upcoming' )->orderBy('created_at', 'desc')->get();
         return $projects;
     }
     public static function getProjectsCount(){
                $count = self::where('status','=','1')->count();
                return $count;
     }

}
