<?php

    namespace App\Http\Livewire;

    use App\Models\Fund;
    use App\Models\Campus;
    use App\Models\Course;
    use App\Models\Student;
    use Livewire\Component;
    use App\Models\Barangay;
    use App\Models\Province;
    use App\Models\Municipal;
    use App\Models\ScholarshipName;
    use Illuminate\Support\Facades\Redirect;


    class Grantees extends Component
    {
            // campus&course
            public $selectedCampus, $campuses;
            public $selectedCourse, $courses = [];
            // Types
            public $scholarship_name, $scholarships;
            public $selectedFundSources, $funds;

            // Personal Information
            public $lastname, $firstname, $initial;
            public $sex, $status, $contact, $email, $level;
            public $nameSchool, $lastYear;
            public $student_id;
            public $grant_status, $grant;
            public $studentType;
            public $father, $mother;

            // Address
            public $selectedProvince;
            public $selectedMunicipality;
            public $selectedBarangay;
            public $provinces = [];
            public $municipalities = [];
            public $barangays = [];

            // show&hide
            public $showNewInput = false;

            public function showNewInput()
            {
                $this->showNewInput = true;
            }

            public function hideNewInput()
            {
                $this->showNewInput = false;
            }

        public function saveStudent()
        {
            try{
            // dd('Debugging');
            // Validate the student form fields
                $rules = [
                    'selectedCampus' => 'required',
                    'selectedCourse' => 'required',
                    'lastname' => 'required',
                    'firstname' => 'required',
                    'initial' => 'required',
                    'sex' => 'required',
                    'status' => 'required',
                    'selectedProvince' => 'required',
                    'selectedMunicipality' => 'required',
                    'selectedBarangay' => 'required',
                    'contact' => 'required',
                    'email' => 'required|email',
                    'student_id' => 'required',
                    'level' => 'required',
                    'studentType' => 'required',
                    'father' => 'required',
                    'mother' => 'required',
                ];

                if ($this->studentType === 'new') {
                    $rules['nameSchool'] = 'required';
                    $rules['lastYear'] = 'required|numeric'; // Ensure lastYear is numeric
                }

                if ($this->grant_status === 'yes') {
                    $rules['grant'] = 'required';
                }

                // Count the occurrences of the student_id in the funds table
                $studentIdCount = Fund::where('student_id', $this->student_id)->count();

                // Define the maximum limit for scholarship
                $maxLimit = 2;

                // Check if the student has reached the scholarship limit
                if ($studentIdCount >= $maxLimit) {
                // Display error message and return early
                    session()->flash('error', 'The student has reached the maximum scholarship limit.');
                    return;
                }

                $this->validate($rules);



                // Get the campus and course based on the selectedCampus and selectedCourse
                $campus = Campus::findOrFail($this->selectedCampus);
                $course = Course::findOrFail($this->selectedCourse);

                // Get the province, municipal, and barangay names based on their IDs
                $province = Province::where('provCode', $this->selectedProvince)->firstOrFail();
                $municipality = Municipal::where('citymunCode', $this->selectedMunicipality)->firstOrFail();
                $barangay = Barangay::where('brgyCode', $this->selectedBarangay)->firstOrFail();
                // dd($barangay);
                // Get the selected scholarship
                $scholarship = ScholarshipName::find(1);
                $scholarshipType = $scholarship->scholarshipType;
                // dd($scholarshipType);

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
                    'scholarshipType' => $scholarship->scholarshipType->id,
                ];

                $student = Student::create($studentData);
                // dd($studentData);

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
        $this->resetForm();

  } catch (\Exception $e) {
      // Flash an error message to the session
      session()->flash('error', 'An error occurred while saving the student data.');

    //   // Or dispatch a browser event with a custom error message
    //  $this->dispatchBrowserEvent('student-error', ['message' => 'An error occurred while saving the student data.']);
  }
}



        public function render()
        {
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

            // Fetch scholarships along with their types and fund sources
            $this->scholarships = ScholarshipName::with('scholarshipType', 'fundSources')->get();

            return view('livewire.grantees', [
                'campuses' => $this->campuses,
                'provinces' => $this->provinces,
            ]);
        }

            // updatedSelectedFundSources method
            public function updatedSelectedFundSources()
            {
                // Ensure $this->selectedFundSources is an array
                if (!is_array($this->selectedFundSources)) {
                    $this->selectedFundSources = [];
                }

                // Limit the selection to 2 fund sources
                if (count($this->selectedFundSources) > 2) {
                    // Uncheck any additional selections beyond the first two
                    $this->selectedFundSources = array_slice($this->selectedFundSources, 1, 3); // Corrected slice parameters
                }
            }



            // Method to reset the form fields
            public function resetForm()
            {
                $this->selectedCampus = null;
                $this->selectedCourse = null;
                $this->lastname = null;
                $this->firstname = null;
                $this->initial = null;
                $this->sex = null;
                $this->status = null;
                $this->selectedProvince = null;
                $this->selectedMunicipality = null;
                $this->selectedBarangay = null;
                $this->contact = null;
                $this->email = null;
                $this->student_id = null;
                $this->level = null;
                $this->studentType = null;
                $this->nameSchool = null;
                $this->lastYear = null;
                $this->grant_status = null;
                $this->grant = null;
                $this->father = null;
                $this->mother = null;
                $this->selectedFundSources = [];

                $this->showNewInput = false;
            }

    }
