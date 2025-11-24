<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supporter extends Model
{
    use HasFactory;

    protected $fillable = ['image'];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function course()
    // {
    //     return $this->belongsTo(Course::class); // or Course model if rating courses
    // }

    // public function student()
    // {
    //     return $this->belongsTo(Student::class);
    // }
}