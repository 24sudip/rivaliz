<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;
    protected $guarded = [];
    public function details() {
        return $this->hasMany(OrderDetails::class);
    }

    public function orderDetails() {
        return $this->hasMany(OrderDetails::class, 'order_id', 'id'); // Adjust foreign key if needed
    }

    public function student() {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    // public function course() {
    //     return $this->belongsTo(Course::class, 'course_id', 'id');
    // }
    public function courses() {
        return $this->hasManyThrough(Course::class, OrderDetails::class, 'order_id', 'id', 'id', 'course_id');
    }

}
