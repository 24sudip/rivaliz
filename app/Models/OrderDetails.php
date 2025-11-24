<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model {
    use HasFactory;
    protected $guarded = [];
    public function course() {
        return $this->belongsTo(Course::class);
    }
    public function ebook() {
        return $this->belongsTo(Ebook::class);
    }

    public function affiliate() {
        return $this->belongsTo(Affiliate::class);
    }
}
