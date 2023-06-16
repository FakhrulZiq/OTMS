<?php

namespace App\Models;

use App\Models\Classes;
use App\Models\Parents;
use App\Models\Payments;
use App\Models\Teachers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Students extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters) {
        if ($filters['Status'] ?? false) {
            $query->where('Status', 'like', '%' . request('Status') . '%');
        }

        if ($filters['search'] ?? false) {
            $query->where('FullName', 'like', '%' . request('search') . '%');
        }
    }

    public function learningProgress() {
        return $this->hasMany(LearningProgress::class);
    }


    public function scopeWhere($query, $column, $operator = null, $value = null, $boolean = 'and') {
        return $query->where($column, $operator, $value, $boolean);
    }

    public function parent() {
        return $this->belongsTo(Parents::class, 'parent_id');
    }

    public function payments() {
        return $this->hasMany(Payments::class);
    }

    public function teacher() {
        return $this->belongsTo(Teachers::class);
    }

    public function class() {
        return $this->belongsTo(Classes::class, 'Class_id');
    }

}

