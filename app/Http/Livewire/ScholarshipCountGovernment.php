<?php





        namespace App\Http\Livewire;

        use App\Models\Student;
        use Livewire\Component;
        use App\Models\ScholarshipName;
        use App\Models\SchoolYear;
        use Illuminate\Support\Facades\Redirect;
        use App\Models\Grantee;
        use App\Models\Campus;

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
                $data = $this->fetchCampusChartData();

                // $this->initializeChart();

                return view('livewire.scholarship-count-government', [
                    'data' => $data,
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

            public function fetchCampusChartData()
                {
                    // Fetch all unique campus names as default labels
                    $defaultLabels = Campus::pluck('campus_name')->toArray();

                    $query = Grantee::when($this->selectedSources !== 'All', function ($query) {
                        return $query->where('scholarship_name', $this->selectedSources);
                    })
                    ->when($this->selectedYear !== 'allYear', function ($query) {
                        return $query->where('school_year', $this->selectedYear);
                    })
                    ->join('students', 'grantees.student_id', '=', 'students.student_id')
                    ->join('campuses', 'students.campus', '=', 'campuses.id') // Assuming the column name is campus_id
                    ->select('campuses.campus_name'); // Select campus_name instead of campus_id

                    $campusData = $query->get()->groupBy('campuses.campus_name');

                    if ($campusData->isEmpty()) {
                        // Use the default labels and set values to 0
                        $labels = $defaultLabels;
                        $values = [];
                    } else {
                        // Use the retrieved labels and values
                        $labels = $campusData->keys()->toArray();
                        $values = $campusData->map->count()->toArray();
                    }

                    $this->emit('renderChart', ['labels' => $labels, 'values' => $values]);
                }



        }
