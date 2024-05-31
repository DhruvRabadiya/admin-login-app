<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_name', 'url', 'description', 'parent_id'];

    public function parentcategory()
    {
        return $this->hasOne('App\Models\Category', 'id', 'parent_id')->select('id', 'category_name', 'url')->where('status', 1);
    }

    public function subcategories()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }
}
