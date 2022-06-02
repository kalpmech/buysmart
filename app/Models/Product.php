<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;
class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->where('gender','2');;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeActive($query) 
    {
       return $query->where('status', 1);
    }

    public function scopeFilter($query, $params)
    { 
        
        if (isset($params['size']) && !empty($params['size'])) {
            $query->whereIn('size', array_values($params['size']));
        }
        if (isset($params['color']) && !empty($params['color'])) {
            foreach($params['color'] as $val){
                $query->Where('color', 'like', '%' . $val . '%');
            }
        }
        if (isset($params['min']) && isset($params['max']) && !empty($params['min']) && !empty($params['max'])) {
            $query->WhereBetween('price', [substr($params['min'],1), substr($params['max'],1)]);
        }
        return $query;
    }
}
