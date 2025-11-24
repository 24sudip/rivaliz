<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liveclass extends Model {
    use HasFactory;
    protected $guarded = [];

    public function course() {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function instructor() {
        return $this->belongsTo(Instructor::class);
    }
}
