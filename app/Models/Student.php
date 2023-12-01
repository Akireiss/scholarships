<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = "students";
    protected $fillable = [
        'student_id',
        'lastname',
        'firstname',
        'initial',
        'email',
        'sex',
        'status',
        'barangay',
        'municipal',
        'province',
        'campus',
        'course',
        'level',
        'father',
        'mother',
        'contact',
        'studentType',
        'nameSchool',
        'lastYear',
        'student_status'
    ];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }


    // Define the relationship with the Province model (assuming the "addresses" table has a foreign key "province_id")
    public function province()
    {
        return $this->belongsTo(Province::class, 'id');
    }

    // Define the relationship with the Municipal model (assuming the "addresses" table has a foreign key "municipal_id")
    public function municipal()
    {
        return $this->belongsTo(Municipal::class, 'id');
    }

    // Define the relationship with the Barangay model (assuming the "addresses" table has a foreign key "barangay_id")
    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'id');
    }

    public function scholarshipName()
    {
         return $this->belongsTo(ScholarshipName::class);
    }
    public function grantee()
    {
        return $this->hasOne(Grantee::class, 'student_id', 'id');
    }

    public function getStatusTextAttribute()
    {
        $value = $this->attributes['student_status'];
        switch ($value) {
            case 0:
                return 'Active';
            case 1:
                return 'Inactive';
            default:
                return 'No info';
        }
    }
}
