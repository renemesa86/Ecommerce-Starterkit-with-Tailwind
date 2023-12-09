<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','price','item_code','description','active'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }   
    
    public function scopeByItemCode($query, $item_code)
    {
        return $query->where('item_code','LIKE','%'.$item_code.'%');
    }

    public function scopeByTitle($query, $name)
    {
        return $query->where('title','LIKE','%'.$name.'%');
    }

    public function scopeByPrice($query, $min, $max)
    {
        if($min != null && $max != null){
            return $query->whereBetween('price',[$min,$max]);
        } elseif ($min != null && $max == null) {
            return $query->where('price','>=',$min);
        } elseif ($min == null && $max != null) {
            return $query->where('price','<=',$max);
        }
        
    }
    
}
