<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PodcastcategorY extends Model {
    use HasFactory;
    protected $table = "podcastcategories";
    protected $guarded = [];

    // public function videos()
    // {
    //     return $this->hasMany(Freevideo::class, 'freevideoscategory_id', 'id');
    // }
}
