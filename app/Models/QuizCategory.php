<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizCategory extends Model
{
    protected $table = 'quizcategories'; // your table name

    protected $fillable = [
       'name',
       'image'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'image' => 'string',
    ];

    public function subcategories()
    {
        return $this->hasMany(QuizSubCategory::class, 'category_id');
    }

    public function quiz()
    {
        return $this->hasMany(Quiz::class, 'category_id');
    }
}
