<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 'product_id'
    ];
}
