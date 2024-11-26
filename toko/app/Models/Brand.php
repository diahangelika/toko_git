<?php

namespace App\Models;

use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    // public function comments(): HasMany
    // {
    //     return $this->hasMany(Comment::class);
    // }

    protected $fillable = ['brand_name'];
}
