<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizSubCategory extends Model
{
    protected $table = 'quizsubcategories'; // your subcategories table name

    protected $fillable = [
        'name',
        'image',
        'category_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'image' => 'string',
        'category_id' =>'integer',
    ];

    public function category()
    {
        return $this->belongsTo(QuizCategory::class, 'category_id');
    }
    public function quiz()
    {
        return $this->hasMany(Quiz::class, 'subcategory_id');
    }
}
