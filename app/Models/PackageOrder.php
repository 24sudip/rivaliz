<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageOrder extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the package_payment that owns the PackageOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package_payment()
    {
        return $this->belongsTo(PackagePayment::class, 'package_payment_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
}

