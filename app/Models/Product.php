<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Cart;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name', 'description', 'price', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function carts() {
        return $this->belongsToMany(Cart::class, 'cart_product')->withTimestamps();
    }
}
