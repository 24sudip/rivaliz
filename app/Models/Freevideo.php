<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freevideo extends Model {
    use HasFactory;
    protected $table = "freevideos";
    protected $guarded = [];

    
    public function category()
    {
        return $this->belongsTo(Freevideoscategory::class, 'freevideoscategory_id', 'id');
    }
}
