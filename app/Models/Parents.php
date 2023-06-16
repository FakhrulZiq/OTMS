<?php

namespace App\Models;

use App\Models\User;
use App\Models\Students;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parents extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function student() {
        return $this->hasOne(Students::class, 'parent_id');
    }


}
