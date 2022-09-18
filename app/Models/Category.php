<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use \App\Models\SubCategory;

class Category extends Model
{  use HasFactory;
    
    /*
     * The table associated with the model.
     * @var string
     */
    protected $table = 'categories';
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    /*
     * Get the phone associated with the user.
     */
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class,'category_id');
    }
 
    
}
?>