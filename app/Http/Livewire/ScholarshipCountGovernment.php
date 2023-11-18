<?php
        namespace App\Http\Livewire;

        use App\Models\Campus;
        use App\Models\Student;
        use Livewire\Component;
        use App\Models\ScholarshipName;
        use Illuminate\Support\Facades\DB;


        class ScholarshipCountGovernment extends Component
        {
            public $governmentCount, $privateCount;
            public $governmentStudent, $privateStudent;
            public $active, $inactive;
            public $scholarshipActive, $scholarshipInactive;
            public $fundSources, $years;
            public $selectedSources, $selectedYear;
            public $chartData;

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
                $this->privateStudent = Student::where('scholarshipType', 1)->distinct('student_id')->count();

                // active and inactive
                $this->active = Student::where('student_status', 0)->distinct('student_id')->count();
                $this->inactive = Student::where('student_status', 1)->distinct('student_id')->count();

                // Set default values for selectedSources and selectedYear
                $this->selectedSources = 'All';
                $this->selectedYear = Student::orderBy('school_year', 'desc')->first()->school_year;

                $this->fetchFilterOptions();
                // Initialize chart data
                 $this->chartData = $this->countStudentsByCampus();
            }

            public function render()
            {
                $campusLabels = $this->chartData['campusLabels'];
                $studentCounts = $this->chartData['studentCounts'];
                $escapedCampusLabels = htmlspecialchars(implode(', ', $campusLabels));

                return view('livewire.scholarship-count-government', [
                    'campusLabels' => $escapedCampusLabels,
                    'studentCounts' => $studentCounts,
                    'chartData' => $this->chartData,
                ]);
            }

            public function fetchFilterOptions()
            {
                // Fetch all unique fund sources from the grant column
                $this->fundSources = Student::distinct()->pluck('grant');

                // Fetch the top 5 recent years from the school_year column
                $this->years = Student::orderBy('school_year', 'desc')->distinct()->take(5)->pluck('school_year');
            }

            public function countStudentsByCampus()
                {
                    $selectedSource = $this->selectedSources;
                    $selectedYear = $this->selectedYear;

                    $query = DB::table('students')
                        ->join('campuses', 'students.campus', '=', 'campuses.campusDesc')
                        ->select('campuses.campus_name', DB::raw('COUNT(*) as student_count'))
                        ->where('students.school_year', $selectedYear);

                    if ($selectedSource != 'All') {
                        $query->where('students.grant', $selectedSource);
                    }

                    $studentCountByCampus = $query->groupBy('campuses.campus_name')->orderBy('student_count', 'desc')->get();

                    $campusLabels = $studentCountByCampus->pluck('campus_name')->toArray();
                    $studentCounts = $studentCountByCampus->pluck('student_count')->toArray();

                    return [
                        'campusLabels' => $campusLabels,
                        'studentCounts' => $studentCounts
                    ];
                }
                public function updatedSelectedSources()
                {
                    $this->fetchFilterOptions();
                    $this->emit('filterChanged'); // Emit an event to trigger a Livewire refresh
                }

                public function updatedSelectedYear()
                {
                    $this->fetchFilterOptions();
                    $this->emit('filterChanged'); // Emit an event to trigger a Livewire refresh
                }

                public function hydrate()
                {
                    // Update chart data during hydration
                    $this->chartData = $this->countStudentsByCampus();
                    $this->emit('chartDataUpdated', $this->chartData);
                }


        }
