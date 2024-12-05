<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    public $timestamps = false; //set time to false
    protected $fillable = [ 
        'order_id', 'product_id', 'product_name', 'product_price', 'product_sales_quantity' ,'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'order_details_id';
    protected $table = 'tbl_order_details';

    public function product()
    {
        return $this -> belongsTo('App\Product', 'product_id');
    }
}
