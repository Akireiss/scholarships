<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_id',
        'lastname',
        'firstname',
        'middle_initial',
        'email',
        'sex',
        'civil_status',
        'barangay',
        'municipal',
        'province',
        'campus',
        'course',
        'year_level',
        'father_name',
        'mother_name',
        'contact_number',
        'student_type',
        'last_school_attended',
        'last_school_year',
        'grant_status',
        'grant_details',
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
    }
