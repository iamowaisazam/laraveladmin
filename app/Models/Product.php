<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 
class Product extends Model
{ use HasFactory;
    
    /*
     * The table associated with the model.
     */
    protected $table = 'products';
    protected $guarded = [];
    
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    
     public function Category()
    {
        return $this->belongsTo(Category::class);
    }
    
}
?>