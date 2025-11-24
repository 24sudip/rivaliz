<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Student extends Authenticatable implements JWTSubject
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'verifyToken',
        'institution',
        'batch',
        'course'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
  public function enrolledCourses()
{
    return $this->belongsToMany(Course::class, 'enrolls', 'student_id', 'course_id')
                ->withPivot('module_completed')
                ->withTimestamps();
}
}
