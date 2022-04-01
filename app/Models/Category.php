<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
        //use to identity parent id 
   public function parent()
   {
       return $this->belongsTo(Category::class);
       
   }
   public function products()
   {
       return $this->hasMany(Product::class);
       
   }

   public static function ParentOrNotCategory($parent_id, $category_id)
   {
       $categories = Category::where('id', $category_id)->where('parent_id', $parent_id)->get();
       if(!is_null($categories)){
           return true;
       }else{
           return false;
       }

   }

}
