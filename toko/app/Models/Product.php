<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // use HasFactory;

    // protected $table = 'products';
    // protected $primaryKey = 'id';

    // @var array
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = ['name','category_id','brand_id','price','stock'];
}
