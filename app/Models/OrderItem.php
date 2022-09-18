<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class OrderItem extends Model
{
    
    /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_items';
    
    protected $guarded = [];
    
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    
}

?>