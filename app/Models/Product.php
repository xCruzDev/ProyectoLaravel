<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description','quantity','price','category_id'];
    public $timestamps = false;
    use HasFactory;

    public function categories() {
        return $this->belongsTo(Category::class,'category_id');
    }
}
