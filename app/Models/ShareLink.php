<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareLink extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $dates   = ['validity'];
    public function affiliate() {
        return $this->belongsTo(Affiliate::class);
    }
}
