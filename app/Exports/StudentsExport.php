<?php
namespace App\Exports;


use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class StudentsExport implements FromArray, WithEvents
  {

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Set the additional row style
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 20,
                    ],
                ]);

                // // Set column widths
                $event->sheet->getColumnDimension('A')->setWidth(30); // Adjust the width as needed
                // $imagePath = public_path('assets/images/logo-min.png');

                // // Add the logo image to the sheet
                // $drawing = new Drawing();
                // $drawing->setPath($imagePath);
                // $drawing->setCoordinates('A1');
                // $drawing->setWidth(350);
                // $drawing->setHeight(150);
                // $drawing->setOffsetX(5);
                // $drawing->setOffsetY(5);
                // $drawing->setWorksheet($event->sheet->getDelegate());
            },
        ];
    }
    public function array(): array
    {
        $rows = [];
    
        // Additional row at the top
        $additionalRow = [
            'List of Grantees',
        ];
    
        $rows[] = $additionalRow;
    
        // Add headers
        $headerRow = [
            'Student id',
            'Lastname',
            'Firstname',
            'Middle Initial',
            'Email Address',
            'Sex',
            'Status',
            'Barangay',
            'Municipal',
            'Province',
            'Campus',
            'Course/Program',
            'Year level',
            'Semester',
            'School year',
            'Father Fullname',
            'Mother Fullname',
            'Contact Number',
            'Type of Student',
            'Name of School Last Attended',
            'Last School Year Attended',
            'Recipient',
            'Scholarship Type',
            'Remarks',
        ];
    
        $rows[] = $headerRow;
    
        // Add data
        foreach ($this->data as $row) {
            $scholarText = $row->getTypeScholarshipAttribute(); 
            $remarks = $row->getStatusTextAttribute();
            $rows[] = [
                $row->student_id,
                $row->lastname,
                $row->firstname,
                $row->initial,
                $row->email,
                $row->sex,
                $row->status,
                $row->barangay,
                $row->municipal,
                $row->province,
                $row->campus,
                $row->course,
                $row->level,
                $row->semester,
                $row->school_year,
                $row->father,
                $row->mother,
                $row->contact,
                $row->studentType,
                empty($row->nameSchool) ? 'No data' : $row->nameSchool,
                empty($row->lastYear) ? 'No data' : $row->lastYear,
                $row->grant,
                $scholarText,
                $remarks,
            ];
        }
    
        return $rows;
    }
    

   
    
}
