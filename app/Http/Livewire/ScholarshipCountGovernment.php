<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use App\Models\ScholarshipName;
use Illuminate\Support\Facades\DB;


class ScholarshipCountGovernment extends Component
{
    public $governmentCount, $privateCount;
    public $governmentStudent , $privateStudent;
    public $chartData; 

    public function mount()
{
            //1st card
                // Count government scholarship names
                $this->governmentCount = ScholarshipName::whereHas('scholarshipType', function ($query) {
                    $query->where('name', 'Government');
                })->count();

                // Count private scholarship names
                $this->privateCount = ScholarshipName::whereHas('scholarshipType', function ($query) {
                    $query->where('name', 'Private');
                })->count();

            // 2nd card
            // Count scholars in government
            $this->governmentStudent = Student::where('scholarshipType', 'Government')->count();

            // Count scholars in private
            $this->privateStudent = Student::where('scholarshipType', 'Private')->count();

                // Get all campus names
                    $campuses = DB::table('campuses')->pluck('campus_name');

                    // Initialize chartData as an empty array
                    $this->chartData = [];

                    // Fetch student count for each campus
                    foreach ($campuses as $campus) {
                        $studentCount = Student::where('campus', $campus)->count();
                        $this->chartData[] = ['campus_name' => $campus, 'total' => $studentCount];
                    }
 }

 
 public function render()
 {


     return view('livewire.scholarship-count-government');
}

}

