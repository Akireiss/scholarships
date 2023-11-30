<?php

namespace App\Imports;

use Illuminate\Support\Facades\Log;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;


class StudentsImport implements ToModel
{



   public function model(array $row)
{
    Log::info('CSV Headers: ' . json_encode(array_keys($row)));

    return new Student([
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
        'level' => is_numeric($row[12]) ? (int)$row[12] : 1,
        'semester' => $row[13],
        'school_year' => $row[14],
        'father' => $row[15],
        'mother' => $row[16],
        'contact' => substr($row[17], 0, 11),
        'studentType' => $row[18],
        'nameSchool' => $row[19] ?? null,
        'lastYear' => $row[20] ?? null,
        'grant' => $row[21],
        'scholarshipType' => $row[22],
        'student_status' => is_numeric($row[23]) ? (int)$row[23] : 0,
    ]);
}

    public function startRow(): int
    {
        return 2; // Skip the header row
    }
}


