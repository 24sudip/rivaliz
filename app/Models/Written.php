<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Written extends Model {

    use HasFactory;
    protected $guarded = [];

    public function quizcategory() {
        return $this->belongsTo(QuizCategory::class, 'quizcategory_id', 'id');
    }

    public function quizsubcategory() {
        return $this->belongsTo(QuizSubCategory::class, 'quizsubcategory_id', 'id');
    }

    public function written_category() {
        return $this->belongsTo(Category::class, 'written_category_id', 'id');
    }
}
