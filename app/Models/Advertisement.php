<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model {
    use HasFactory;
    protected $guarded = [];

    public function adcategory() {
        return $this->belongsTo(Adcategory::class);
    }
}
