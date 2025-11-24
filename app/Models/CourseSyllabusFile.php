<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSyllabusFile extends Model
{
    protected $fillable = ['course_id', 'file_path'];
    
    protected $table = "coursesyllabusfiles";
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}