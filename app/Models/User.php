<?php

namespace App\Models;

use App\Models\Staffs;
use App\Models\Parents;
use App\Models\Headmasters;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    const ROLE_HEADMASTER = 'admin';
    const ROLE_TEACHER = 'teacher';
    const ROLE_CLERK = 'clerk';
    const ROLE_PARENT = 'parent';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
        'is_Admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // // Relationship With Listings
    // public function listings() {
    //     return $this->hasMany(Listing::class, 'user_id');
    // }

    public function parent() {
        return $this->hasOne(Parents::class, 'user_id');
    }

    public function staff() {
        return $this->hasOne(Staffs::class);
    }

    public function teacher() {
        return $this->hasOne(Teachers::class);
    }

    public function headmaster() {
        return $this->hasOne(Headmasters::class);
    }
}