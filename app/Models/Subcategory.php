<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model {
    use HasFactory;
    protected $guarded = [];
    public function childcategories() {
        return $this->hasMany(Childcategory::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function courses()
{
    return $this->hasMany(Course::class, 'subcategory_id');
}
}
