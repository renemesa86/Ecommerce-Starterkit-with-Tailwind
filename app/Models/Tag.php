<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name','parent_id'];

    protected $name = 'tags';

    public function children()
    {
       return $this->hasMany(Tag::class,'parent_id','id');
    }

    public function parents()
    {
       return $this->belongsto(Tag::class,'parent_id','id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function scopeCategories($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeSubCategoriesByParentId($query, $parent_id)
    {
        return $query->where('parent_id',$parent_id);
    }

    public function scopeSubCategories($query)
    {
        return $query->where('parent_id','!=',null);
    }

    // public function scopeSubCategoryParentId($query,$id_subcategory)
    // {
    //     return $query->where('parent_id','!=',null);
    // }
}
