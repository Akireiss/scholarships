<?php

namespace App\Models;

use App\Models\StudentGrantee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grantee extends Model
{
    use HasFactory;
    protected $table = 'grantees';
    protected $fillable = [
        'student_id',
        'semester',
        'school_year',
        // 'scholarship_type_1',
        // 'scholarship_name_1',
        // 'scholarship_type_2',
        // 'scholarship_name_2',
    ];
    // public function student()
    // {
    //     return $this->belongsTo(Student::class);
    // }
    public function studentGrantee()
    {
        return $this->hasMany(StudentGrantee::class, 'grantees_id');
    }
    public function scholarshipName()
    {
        return $this->belongsTo(ScholarshipName::class, 'scholarship_name');
    }
}
