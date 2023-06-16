<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staffs extends Model
{
    use HasFactory;

    protected $table = 'staffs'; // Replace with the actual table name if different

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
