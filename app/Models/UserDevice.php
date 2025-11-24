<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model {
    use HasFactory;
    protected $table = "user_devices";
    protected $guarded = [];
    /**
     * Get the student that owns the Access
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function student()
    // {
    //     return $this->belongsTo(Student::class, 'user_id', 'id');
    // }
}
