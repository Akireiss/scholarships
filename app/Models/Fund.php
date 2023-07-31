<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{

    protected $fillable = ['student_id', 'source_id'];

    // Define the relationship between Fund and Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function fundSources()
    {
        return $this->hasMany(FundSource::class, 'scholarship_name_id', 'id');
    }
}
