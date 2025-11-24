<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Childsubcategory extends Model {
    use HasFactory;
    protected $guarded = [];
    public function childcategory() {
        return $this->belongsTo(Childcategory::class);
    }
}
