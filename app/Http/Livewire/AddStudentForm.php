<?php

namespace App\Http\Livewire;


use App\Models\Campus;
use App\Models\Grantee;
use App\Models\Student;
use Livewire\Component;
use App\Models\AuditLog;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Traits\Variables;
use Illuminate\Support\Facades\Auth;

class AddStudentForm extends Component
{
    use Variables;


    protected $rules = [
        'student_id' => 'required',
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
        'contact' => 'required|min:11|max:11',
        'email' => 'required|email',
        'level' => 'required',
        'studentType' => 'required',
        'father' => 'required',
        'mother' => 'required',
    ];


    public function updatedStudentType($value)
    {
        if ($value === 'New') {
            $this->showNewInput = true;
            $this->rules['nameSchool'] = 'required';
            $this->rules['lastYear'] = 'required|numeric';
        } else {
            $this->showNewInput = false;
            $this->rules['nameSchool'] = 'nullable';
            $this->rules['lastYear'] = 'nullable';
        }
    }

    public function showNewInput()
    {
        $this->showNewInput = true;
    }

    public function hideNewInput()
    {
        $this->showNewInput = false;
    }


    public function saveStudent(Student $studentModel)
    {
        $this->validate();

    

                // Save the student data to the database
                $student = $studentModel->create([
                    'student_id' => $this->student_id,
                    'lastname' => $this->lastname,
                    'firstname' => $this->firstname,
                    'initial' => $this->initial,
                    'email' => $this->email,
                    'sex' => $this->sex,
                    'status' => $this->status,
                    'barangay' => $this->selectedBarangay,
                    'municipal' => $this->selectedMunicipality,
                    'province' => $this->selectedProvince,
                    'campus' => $this->selectedCampus,
                    'course' => $this->selectedCourse,
                    'level' => $this->level,
                    'father' => $this->father,
                    'mother' => $this->mother,
                    'contact' => $this->contact,
                    'studentType' => $this->studentType,
                    'nameSchool' => $this->nameSchool,
                    'lastYear' => $this->lastYear,
                ]);
                    // Save the student
                    $student->save();

                    // Display success message
                    session()->flash('success', 'Student data saved successfully.');

                    // Reset form fields
                    $this->resetForm();

                    $user = Auth::user();
                    AuditLog::create([
                        'user_id' => $user->id,
                        'action' => 'Added a new student',
                        'data' => json_encode('Added by '. $user->name),
                    ]);

    }



    public function render()
    {
        if(auth()->user()->role == 0 || auth()->user()->role == 1){
            $this->campuses = Campus::all();
        }else{
            $this->campuses = Campus::where('id', 1)->get();
        }


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
        return view('livewire.add-student-form');
    }

    private function resetForm()
{
    // Reset all form fields and properties
    $this->reset([
        'student_id',
        'lastname',
        'firstname',
        'initial',
        'email',
        'sex',
        'status',
        'selectedBarangay',
        'selectedMunicipality',
        'selectedProvince',
        'selectedCampus',
        'selectedCourse',
        'level',
        'father',
        'mother',
        'contact',
        'studentType',
        'nameSchool',
        'lastYear',
    ]);
}

}
