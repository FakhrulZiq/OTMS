<?php

namespace App\Models;

use App\Models\Payments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fees extends Model
{
    use HasFactory;

    public function payments() {
        return $this->hasMany(Payments::class);
    }

}
