<?php

namespace App\Models;

use App\Models\Fees;
use App\Models\Students;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payments extends Model
{
    use HasFactory;

    public function student() {
        return $this->belongsTo(Students::class);
    }

public function fee() {
        return $this->belongsTo(Fees::class);
    }

}
