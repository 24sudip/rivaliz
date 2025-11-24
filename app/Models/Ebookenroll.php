<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebookenroll extends Model
{
    use HasFactory;
    
    public function student() {
        return $this->belongsTo(Student::class);
    }
    
    public function ebook() {
        return $this->belongsTo(Ebook::class);
    }
}
