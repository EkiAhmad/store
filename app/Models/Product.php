<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description'
    ];

    public function scopeGetProduct($query)
    {
        // $sql = $query->with(['category:category_id,name'])
        $sql = $query->select('products.name', 'products.description', 'products.enable', 'products.created_at', 'c.name as category_name', 'i.name as image_name', 'i.file')
                ->join('category_products as cp', 'products.id', '=', 'cp.product_id')
                ->join('categories as c', 'cp.category_id', '=', 'c.id')
                ->join('product_images as pi', 'products.id', '=', 'pi.product_id')
                ->join('images as i', 'pi.image_id', '=', 'i.id')
                ->orderBy('products.created_at', 'desc')
                ->get();
        return $sql;
    }
}
