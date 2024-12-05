<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;
    
    use HasFactory;

    protected $guarded = [];
    public function images()
    {
        return $this -> hasMany(ProductImage::class, foreignKey: 'product_id');
    }

    public function tags(){
        return $this -> belongsToMany(related: Tag::class, table: 'product_tags', 
                        foreignPivotKey:'product_id', relatedPivotKey:'tag_id')-> withTimestamps();
    }

    public function category(){
        return $this -> belongsTo(related: Category::class, foreignKey: 'category_id');
    }

    public function productImages(){
        return $this -> hasMany(related: productImage::class, foreignKey: 'product_id');
    }

    public $timestamps = false; //set time to false
    protected $fillable = [ 
        'name', 'price', 'feature_image_path', 'content', 'user_id', 'category_id', 'feature_image_name',
        'product_quantity', 'product_sold', 'deleted_at', 'views_count', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'products';
}
