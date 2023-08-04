
    class Grantees extends Component
    {
            // Types
            public $scholarship_name, $scholarships;
            public $selectedFundSources, $funds;


        public function saveStudent()
        {
            try{


                // Get the campus and course based on the selectedCampus and selectedCourse
                $campus = Campus::findOrFail($this->selectedCampus);
                $course = Course::findOrFail($this->selectedCourse);

                // Get the province, municipal, and barangay names based on their IDs
                $province = Province::where('provCode', $this->selectedProvince)->firstOrFail();
                $municipality = Municipal::where('citymunCode', $this->selectedMunicipality)->firstOrFail();
                $barangay = Barangay::where('brgyCode', $this->selectedBarangay)->firstOrFail();


                // Save the student data
                $studentData = [
                    'campus' => $campus->campus_name,
                    'course' => $course->course_name,
                    'lastname' => $this->lastname,
                    'firstname' => $this->firstname,
                    'initial' => $this->initial,
                    'province' => $province->provDesc,
                    'municipal' => $municipality->citymunDesc,
                    'barangay' => $barangay->brgyDesc,
                    'sex' => $this->sex,
                    'status' => $this->status,
                    'contact' => $this->contact,
                    'email' => $this->email,
                    'student_id' => $this->student_id,
                    'level' => $this->level,
                    'studentType' => $this->studentType,
                    'last_school_attended' => $this->nameSchool,
                    'last_school_year' => $this->lastYear,
                    'grant_status' => $this->grant_status,
                    'grant' => $this->grant,
                    'father' => $this->father,
                    'mother' => $this->mother,
                ];

                $student = Student::create($studentData);

                // Save the selected fund sources with the student ID in the fund table
                foreach ($this->selectedFundSources as $sourceId) {
                    Fund::create([
                        'student_id' => $this->student_id,
                        'source_id' => $sourceId
                    ]);
                }

      // Flash a success message to the session
      session()->flash('success', 'Student data saved successfully!');
        // Reset the form fields

}



        public function render()
        {

            // Fetch scholarships along with their types and fund sources
            $this->scholarships = ScholarshipName::with('scholarshipType', 'fundSources')->get();

            return view('livewire.grantees', [
                'campuses' => $this->campuses,
                'provinces' => $this->provinces,
            ]);
        }


    }
