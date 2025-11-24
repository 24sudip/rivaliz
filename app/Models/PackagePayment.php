<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagePayment extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the student that owns the PackagePayment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
}

