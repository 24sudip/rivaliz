<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizsubmit extends Model {
    use HasFactory;
    protected $guarded = [];

    public function submitanswers() {
        return $this->hasMany(QuizsubmitAnswer::class, 'submit_id');
    }

    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }
    
     protected $fillable = [
        'student_id', 'quiz_id', 'totalquestion', 'rightanswer'
    ];
    public function rightAnswers()
{
    return $this->hasMany(Quizsubmit::class, 'student_id', 'student_id');
}
public function student()
{
    return $this->belongsTo(Student::class, 'student_id');
}
}
