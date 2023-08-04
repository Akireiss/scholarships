<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
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
        'grant_status',
        'grant',
    ];

  // Define the relationships if there are any
    // For example, if a student belongs to a campus and a course, you can define the relationships like this:

        public function campus()
        {
            return $this->belongsTo(Campus::class);
        }

        public function course()
        {
            return $this->belongsTo(Course::class);
        }

        // Define the relationship with the Province model (assuming the "addresses" table has a foreign key "province_id")
        public function province()
        {
            return $this->belongsTo(Province::class);
        }

        // Define the relationship with the Municipal model (assuming the "addresses" table has a foreign key "municipal_id")
        public function municipal()
        {
            return $this->belongsTo(Municipal::class);
        }

        // Define the relationship with the Barangay model (assuming the "addresses" table has a foreign key "barangay_id")
        public function barangay()
        {
            return $this->belongsTo(Barangay::class);
        }

        public function funds()
        {
            return $this->hasMany(Fund::class);
        }
        public function scholarshipType()
        {
            return $this->hasMany(ScholarshipType::class);
        }

        // public function region()
        // {
        //     return $this->belongsTo(Region::class);
        // }

    }
