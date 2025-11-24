<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model {
    use HasFactory;
    protected $guarded = [];

    // protected $fillable = [
    //     'lesson_id',
    //     'exam_status',
    //     'name',
    //     'timer',
    //     'amount',          // ✅ Add new fields
    //     'passingscore',
    //     'passingpoint',
    //     'pdf',
    //     'category_id',
    //     'subcategory_id',
    //     'inside_routine',
    //     'release_date',
    //     'negative_mark'
    // ];

    public function questions() {
        return $this->hasMany(McqQuestion::class);
    }

    public function lesson() {
        return $this->belongsTo(Lesson::class);
    }
}
