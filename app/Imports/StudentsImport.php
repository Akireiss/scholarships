<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Collection;

class StudentsImport
{
    public function import(Collection $rows)
    {
        foreach ($rows as $row) {
            Student::create([
                'student_id' => $row[0],
                'lastname' => $row[1],
                'firstname' => $row[2],
                'initial' => $row[3],
                'email' => $row[4],
                'sex' => $row[5],
                'status' => $row[6],
                'barangay' => $row[7],
                'municipal' => $row[8],
                'province' => $row[9],
                'campus' => $row[10],
                'course' => $row[11],
                'level' => $row[12],
                'semester' => $row[13],
                'father' => $row[14],
                'mother' => $row[15],
                'contact' => $row[16],
                'studentType' => $row[17],
                'nameSchool' => $row[18],
                'lastYear' => $row[19],
                'grant' => $row[20],
                'scholarshipType' => $row[21],
                'student_status' => $row[22],
            ]);
        }
    }
}
