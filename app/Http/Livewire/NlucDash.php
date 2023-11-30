<?php

namespace App\Http\Livewire;

use App\Models\Fund;
use App\Models\Campus;
use App\Models\Student;
use Livewire\Component;
use App\Models\FundSource;
use App\Models\ScholarshipName;
use Illuminate\Support\Facades\DB;

class NlucDash extends Component
{

    public $governmentCount, $privateCount;
    public $governmentStudent, $privateStudent;
    public $active, $inactive;
    public $scholarshipActive, $scholarshipInactive;
    public $fundSources, $years;
    public $selectedSources;
    public $selectedYear;

    public function mount()
    {

        // 1st card
        // Count government scholarship names
        $this->governmentCount = ScholarshipName::where('scholarship_type', 0)->count();
        // Count private scholarship names
        $this->privateCount = ScholarshipName::where('scholarship_type', 1)->count();

        // scholarship active and inactiive
        $this->scholarshipActive = ScholarshipName::where('status', 0)->count();
        $this->scholarshipInactive = ScholarshipName::where('status', 1)->count();
        //

        // 2nd card
        // Count scholars in government
        $this->governmentStudent = Student::where('scholarshipType', 0)->distinct('student_id')->count();
        // Count scholars in private
        $this->privateStudent = Student::where('scholarshipType', 1 )->distinct('student_id')->count();

        // active and inactive
        $this->active = Student::where('student_status', 0)->distinct('student_id')->count();
        $this->inactive = Student::where('student_status', 1)->distinct('student_id')->count();

        $this->fetchFilterOptions();
        $this->initializeChart();

    }

    public function render()
    {
        $data = $this->getChartData();
                // Initialize the chart when rendering the component
                $this->initializeChart();

        return view('livewire.nluc-dash', [
            'data' => $data,
        ]);
    }

    public function fetchFilterOptions()
    {
        // Fetch all unique fund sources from the grant column
        $this->fundSources = Student::groupBy('grant')->pluck('grant');

        // Fetch the top 5 recent years from the school_year column
        $this->years = Student::orderBy('school_year', 'desc')
                            ->groupBy('school_year')
                            ->take(5)
                            ->pluck('school_year');
        // Set default values
        $this->selectedSources = 'All';
        $this->selectedYear = 'allYear';
    }

    public function initializeChart()
            {
                $this->emit('renderChart', ['labels' => $this->dataLabels(), 'values' => $this->dataValues()]);
            }


            private function getChartData()
            {
                $data = Student::join('campuses', 'students.campus', '=', 'campuses.campusDesc')
                ->where('campuses.campus_name', 'NLUC') // Filter for NLUC campus
                ->when($this->selectedSources != 'All', function ($query) {
                    return $query->where('students.grant', $this->selectedSources);
                })
                ->when($this->selectedYear != 'allYear', function ($query) {
                    return $query->where('students.school_year', $this->selectedYear);
                })
                ->select('campuses.campus_name as campus', DB::raw('count(*) as count'))
                ->groupBy('campuses.campus_name')
                ->get();

            return $data;

            }

    private function dataLabels()
    {
        return $this->getChartData()->pluck('campus')->toArray();
    }

    private function dataValues()
    {
        return $this->getChartData()->pluck('count')->toArray();
    }

 }


