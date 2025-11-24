<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model {
    use HasFactory;
    protected $guarded = [];
    /**
     * Get all of the pdf_items for the Lesson
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pdf_items()
    {
        return $this->hasMany(Pdf::class, 'lession_id', 'id');
    }

    public function videos() {
        return $this->hasMany(Video::class);
    }

    public function quizzes() {
        return $this->hasMany(Quiz::class);
    }

    public function module() {
        return $this->belongsTo(Module::class);
    }
}
