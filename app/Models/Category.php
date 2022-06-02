<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "categories";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function scopeActive($query) 
    {
       return $query->where('status', 1);
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }

    public function scopeFilter($query, $params)
    { 
        if (isset($params['color']) && !empty($params['color'])) {
            $query->whereIn('color', array_keys($params['color']));
        }

        if (isset($params['size']) && !empty($params['size'])) {
            $query->whereIn('size', array_values($params['size']));
        }

        if (isset($params['category_id']) && !empty($params['category_id'])) {
            $query->whereIn('category_id', array_values($params['category_id']));
        }
        return $query;
    }
}
