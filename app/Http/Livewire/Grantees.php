<?php


    namespace App\Http\Livewire;
    use App\Traits\Variables;
    use App\Models\AuditLog;
    use App\Models\Fund;
    use App\Models\Campus;
    use App\Models\Course;
    use App\Models\FundSource;
    use App\Models\Student;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;
    use App\Models\Barangay;
    use App\Models\Province;
    use App\Models\Municipal;
    use App\Models\ScholarshipName;
    use App\Models\SchoolYear;


    class Grantees extends Component
    {
        use Variables;


            protected $rules = [
                'student_id' => 'required',
                'semester' => 'required',
                'selectedYear' => 'required',
            ];




        public function fetchSchoolYears()
        {
            $this->years = SchoolYear::orderBy('school_year', 'desc')->limit(5)->get();
        }


        public function saveStudent()
      {

            $this->validate();

                $campus = Campus::findOrFail($this->selectedCampus);
                $course = Course::findOrFail($this->selectedCourse);

                // Get the province, municipal, and barangay names based on their IDs
                $province = Province::where('provCode', $this->selectedProvince)->firstOrFail();
                $municipality = Municipal::where('citymunCode', $this->selectedMunicipality)->firstOrFail();
                $barangay = Barangay::where('brgyCode', $this->selectedBarangay)->firstOrFail();

        $privateStudentData = [
            'campus' => $campus->campusDesc,
            'course' => $course->course_name,
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'initial' => $this->initial,
            'province' => $province->provDesc,
        ];

        $privateStudent = Student::create($privateStudentData);



        session()->flash('success', 'Student data saved successfully!');
            // Reset the form fields
            $this->resetForm();

        $user = Auth::user();
        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Added ' .$this->firstname .$this->lastname. ' as a new scholars',
            'data' => json_encode('Added by '. $user->name),
        ]);
        }




        public function render()
        {

            // Call the methods to fetch scholarship data
            $this->fetchSchoolYears();


            // Fetch campuses and courses
            $this->campuses = Campus::all();

            if ($this->selectedCampus) {
                $campus = Campus::findOrFail($this->selectedCampus);
                $this->courses = $campus->courses;
            } else {
                $this->courses = [];
            }

            // Fetch provinces
            $this->provinces = Province::where('regCode', 01)->get();

            // Fetch municipalities and barangays based on the selected province and municipality
            if ($this->selectedProvince) {
                $this->municipalities = Municipal::where('provCode', $this->selectedProvince)->get();
            } else {
                $this->municipalities = [];
            }

            if ($this->selectedMunicipality) {
                $this->barangays = Barangay::where('citymunCode', $this->selectedMunicipality)->get();
            } else {
                $this->barangays = [];
            }

            return view('livewire.grantees', [
                'campuses' => $this->campuses,
                'provinces' => $this->provinces,
                'years' => $this->years, // Pass the years data to the view


            ]);
        }

            // Method to reset the form fields
            public function resetForm()
            {
                $this->semester = "";
                $this->studentType = "";
                $this->nameSchool = "";
                $this->lastYear = "";
                $this->father = "";
                $this->mother = "";
            }

    }
