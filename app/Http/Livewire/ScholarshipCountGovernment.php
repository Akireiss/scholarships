<?php



        namespace App\Http\Livewire;

        use App\Models\Student;
        use Livewire\Component;
        use App\Models\ScholarshipName;
        use App\Models\SchoolYear;
        use Illuminate\Support\Facades\Redirect;


        class ScholarshipCountGovernment extends Component
        {
            public $governmentScholarships, $privateScholarships;
            public $governmentStudent, $privateStudent;

            public $govermentActive, $privateActive;
            public $fundSources, $years;
            public $selectedSources;
            public $selectedYear;




            public function mount()
            {

                // 1st card
                $this->governmentScholarships = ScholarshipName::where('scholarship_type', 0)->count();
                $this->privateScholarships = ScholarshipName::where('scholarship_type', 1)->count();

                // scholarship active and inactiive
                $this->govermentActive = ScholarshipName::where('status', 0)->where('scholarship_type', 0)->count();
                $this->privateActive = ScholarshipName::where('status', 0)->where('scholarship_type', 1)->count();

                // 2nd card
                // // Count scholars in government
                // $this->governmentStudent = Student::where('scholarshipType', 0)->distinct('student_id')->count();

                // // Count scholars in private
                // $this->privateStudent = Student::where('scholarshipType', 1)->distinct('student_id')->count();

                $this->fetchFilterOptions();
                // $this->initializeChart();

            }
            // ends
            public function render()
            {
                // $data = $this->getChartData();
                // // Initialize the chart when rendering the component
                // $this->initializeChart();

                return view('livewire.scholarship-count-government', [
                    // 'data' => $data,
                ]);
            }

            public function fetchFilterOptions()
            {
                // Fetch all unique fund sources from the grant column
                $this->fundSources = ScholarshipName::all();

                // Fetch the top 5 recent years from the school_year column
                $this->years = SchoolYear::orderBy('school_year', 'desc')
                                    ->groupBy('school_year')
                                    ->take(5)
                                    ->pluck('school_year');
                // Set default values
                $this->selectedSources = 'All';
                $this->selectedYear = 'allYear';
            }


            // public function initializeChart()
            // {
            //     $this->emit('renderChart', ['labels' => $this->dataLabels(), 'values' => $this->dataValues()]);
            // }

            // private function getChartData()
            // {
            //     $data = Student::join('campuses', 'students.campus', '=', 'campuses.campusDesc')
            //     ->when($this->selectedSources != 'All', function ($query) {
            //         return $query->where('students.grant', $this->selectedSources);
            //     })
            //     ->when($this->selectedYear != 'allYear', function ($query) {
            //         return $query->where('students.school_year', $this->selectedYear);
            //     })
            //     ->select('campuses.campus_name as campus', DB::raw('count(*) as count'))
            //     ->groupBy('campuses.campus_name')
            //     ->get();

            //     return $data;
            // }



            // private function dataLabels()
            // {
            //     return $this->getChartData()->pluck('campus')->toArray();
            // }

            // private function dataValues()
            // {
            //     return $this->getChartData()->pluck('count')->toArray();
            // }


        }
