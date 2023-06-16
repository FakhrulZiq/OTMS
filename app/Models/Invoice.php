<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['student_id', 'amount', 'due_date', 'status'];
    
    // Define the student relationship
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}