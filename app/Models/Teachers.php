<?php

namespace App\Models;

use App\Models\User;
use App\Models\Classes;
use App\Models\Students;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teachers extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function classes() {
        return $this->hasMany(Classes::class, 'Teacher_ID');
    }

}
