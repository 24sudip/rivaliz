<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model {
    use HasFactory;

    public function educations() {
        return $this->hasMany(CvEducation::class);
    }

    public function skills() {
        return $this->hasMany(CvSkill::class);
    }

    public function interests() {
        return $this->hasMany(CvInterest::class);
    }

    public function languages() {
        return $this->hasMany(CvLanguage::class);
    }

    public function achievements() {
        return $this->hasMany(CvAchievement::class);
    }

    public function socials() {
        return $this->hasMany(CvSocial::class);
    }

    public function references() {
        return $this->hasMany(CvReference::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }
}
