<?php


namespace App\Http\Livewire;

        use App\Models\Campus;
        use App\Models\Student;
        use Livewire\Component;
        use App\Models\ScholarshipName;
        use App\Models\SchoolYear;
        use App\Models\StudentGrantee;
        use Illuminate\Support\Facades\DB;

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


            }
            // ends
            public function render()
            {


                return view('livewire.scholarship-count-government');
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
            }

    public $studentCounts = [];

    public function filterScholarship()
    {
        $selectedSources = $this->selectedSources;
        $selectedYear = $this->selectedYear;

        $studentCountsQuery = StudentGrantee::join('grantees', 'student_grantee.student_id', '=', 'grantees.student_id')
            ->join('students', 'grantees.student_id', '=', 'students.id')
            ->leftJoin('campuses', 'students.campus', '=', 'campuses.id')
            ->where('scholarship_name', $selectedSources)
            ->where('school_year', $selectedYear)
            ->select('campuses.campus_name', DB::raw('count(*) as student_count'))
            ->groupBy('campuses.campus_name');

        if (auth()->user()->role === 0 || auth()->user()->role === 1) {
            // Admin or manager sees data for all campuses
            $studentCounts = $studentCountsQuery->get();
        } else {
            // Other users see data for their campus only
            $studentCounts = $studentCountsQuery->where('students.campus', 1)->get(); // Assuming 1 represents their campus
        }

        $campusNames = Campus::pluck('campus_name')->toArray();

        $this->emit('renderChart', ['data' => $studentCounts, 'labels' => $campusNames]);
    }




        }

