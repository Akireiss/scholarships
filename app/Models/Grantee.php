<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grantee extends Model
{
    use HasFactory;
    protected $table = 'grantees';
    protected $fillable = [
        'student_id',
        'semester',
        'school_year',
        'scholarship_type',
        'scholarship_name',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
