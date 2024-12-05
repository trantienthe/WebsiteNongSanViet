<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    public function categoryChildrent()
    {
        return $this -> hasMany(related: Category::class, foreignKey: 'parent_id');
    }

    use HasFactory;

    public function products()
    {
        return $this -> hasMany(related: Product::class, foreignKey: 'category_id');
    }
}
