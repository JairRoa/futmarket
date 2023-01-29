<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_ad'];
    protected $table = 'products';
    protected $hidden = ['created_at', 'update_at'];

    public function cat(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function getGallery(){
        return $this->hasMany(PGallery::class, 'product_id', 'id');
    }
}
