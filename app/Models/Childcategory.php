<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Childcategory extends Model {
    use HasFactory;
    protected $guarded = [];
    public function childsubcategories() {
        return $this->hasMany(Childsubcategory::class);
    }

    public function subcategory() {
        return $this->belongsTo(Subcategory::class);
    }
}
