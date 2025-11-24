<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_id', 'rating', 'review_text','created_at','student_id','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class); // or Course model if rating courses
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}