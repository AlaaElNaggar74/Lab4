<?php

namespace App\Models;
use App\Models\products;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name','logo'];
    
    function products(){
        return $this->hasMany(products::class);
    }
}
