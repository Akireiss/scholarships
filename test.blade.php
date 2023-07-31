<div>
    <section class="mt-1 p-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <form wire:submit.prevent="save">
                            <div class="d-flex align-items-center">
                                <label for="campus" class="fw-bold fs-5 col-sm-2">CAMPUS:</label>
                                @foreach ($campuses as $campus)
                                    <div class="form-check form-check-inline col-sm-2">
                                        <input class="form-check-input campus-radio" type="radio"
                                            wire:model="selectedCampus" id="{{ $campus->id }}"
                                            value="{{ $campus->name }}">

                                        <label class="form-check-label"
                                            for="{{ $campus->id }}">{{ $campus->campus_name }}</label>
                                    </div>
                                @endforeach
                            </div>


                            <hr>

                            <div class="row">
                                <p class="fw-bold fs-5">I. STUDENT INFORMATION</p>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label" for="lastname" name="lastname">Last name</label>
                                    <input type="text" id="lastname" wire:model="lastname"
                                        class="form-control form-control-sm @error('lastname') is-invalid @enderror"
                                        name="lastname" />
                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label" for="firstname" name="firstname">First name</label>
                                    <input type="text" id="firstname"  wire:model="firstname"
                                        class="form-control form-control-sm @error('firstname') is-invalid @enderror"
                                        name="firstname" />
                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label" for="initial" name="initial">Middle Initial</label>
                                    <input type="text" id="initial" wire:model="initial"
                                        class="form-control form-control-sm @error('initial') is-invalid @enderror"
                                        name="initial" />
                                    @error('initial')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="row">
                                <p class="mt-3 fw-bold fs-6">ADDRESS<span class="text-danger">*</span></p>
                                <!--  Province Address -->
                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label">Province</label>
                                    <select class="form-select" aria-label="Default select example"
                                        wire:model="selectedProvince">
                                        <option value="" selected >Select Province</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">
                                                {{ $province->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('province')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--  City Address -->
                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label">City/Municipality</label>
                                    <select class="form-select" aria-label="Default select example"
                                        wire:model="selectedMunicipality">
                                        <option value="" selected>Select City</option>
                                        @foreach($municipalities as $municipality)
                                        <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                                    @endforeach

                                    </select>
                                    @error('municipal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!--  Barangay Address -->
                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label">Barangay</label>
                                    <select class="form-select" aria-label="Default select example" name="barangay"
                                        wire:model="selectedBarangay">
                                        <option value="" selected>Select Barangay</option>
                                        @foreach($barangays as $barangay)
                                        <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                    @endforeach
                                    </select>
                                    @error('barangay')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            {{-- sex here --}}
                            <div class="row mx-3">
                                <div class="col-md-6 position-relative mt-3">
                                    <div class="form-inline">
                                        <label for="sex" class="fw-bold mr-2">Sex:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('sex') is-invalid @enderror"
                                            wire:model="sex"
                                                type="radio" name="sex" id="male" value="male">
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('sex') is-invalid @enderror"
                                            wire:model="sex"
                                            type="radio" name="sex" id="female" value="female">
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                        {{-- required here --}}
                                        @error('sex')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        {{-- ends --}}
                                    </div>
                                </div>
                                <div class="col-md-6 position-relative mt-3">
                                    <div class="form-inline">
                                        <label for="status" class="fw-bold mr-2">Civil Status:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('status') is-invalid @enderror"
                                                type="radio" name="status" id="single" value="single"
                                                wire:model="status"
                                                >
                                            <label class="form-check-label" for="single">Single</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('status') is-invalid @enderror"
                                            wire:model="status"
                                                type="radio" name="status" id="married" value="married">
                                            <label class="form-check-label" for="married">Married</label>
                                        </div>
                                        {{-- required here --}}
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        {{-- ends --}}
                                    </div>
                                </div>
                            </div>




                            {{-- contact here --}}
                            <div class="row">
                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label" for="contact" name="contact">Contact Number</label>
                                    <input type="tel" id="contact"
                                        class="form-control form-control-sm @error('contact') is-invalid @enderror"
                                        wire:model="contact" maxlength="11" minlength="11" />
                                    @error('contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- email here --}}
                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label" for="email" name="email">Email Address</label>
                                    <input type="email" id="email"
                                        class="form-control form-control-sm @error('email') is-invalid @enderror"
                                        wire:model="email" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- id here --}}
                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label" for="student_id">Student ID</label>
                                    <input type="text" id="student_id"
                                        class="form-control form-control-sm @error('student_id') is-invalid @enderror"
                                        wire:model="student_id" maxlength="10" />
                                    @error('student_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        const studentIdInput = document.getElementById("student_id");

                                        studentIdInput.addEventListener("input", function() {
                                            let inputText = this.value.replace(/\D/g, "").substring(0, 10);
                                            let formattedText = inputText.replace(/(\d{3})(\d{4})(\d{1,2})/, "$1-$2-$3");
                                            this.value = formattedText;
                                        });
                                    });
                                </script>

                                {{-- id end --}}
                            </div>
                            {{-- courses here --}}

                            <div class="row mt-3">
                                <div class="col-md-6 position-relative mt-0">
                                    <label class="form-label">Course</label>
                                    <select class="form-select" id="course" wire:model="selectedCourse">
                                        {{-- <option value="">Select Course</option> --}}
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->campus_id }}">{{ $course->course_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('course')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-md-3  position-relative mt-0">
                                    <label class="form-label">Year level</label>
                                    <select wire:model="level" id="level"
                                        class="@error('level') is-invalid @enderror form-select form-select-md text-center">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- types of students --}}

                            <div class="row mt-1 mx-3">
                                <p class="fw-bold fs-5">Type of Student:</p>
                                <div class="col-6 col-md-6 col-lg-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" wire:model="studentType"
                                            id="checkNew" value="new">
                                        <label class="form-check-label" for="checkNew">New</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" wire:model="studentType"
                                            id="continuing" value="continuing">
                                        <label class="form-check-label" for="continuing">Continuing</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" wire:model="studentType"
                                            id="return" value="return">
                                        <label class="form-check-label" for="return">Returning Student</label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 col-lg-6" id="newInput" style="display:none;">
                                    <p class="fw-bold fs-6">
                                        <span class="text-red m-auto">*</span>
                                        if NEW, indicate name of the school last attended:
                                        <input type="text" class="form-control form-control-sm" wire:model="nameSchool"
                                            id="new">
                                    </p>
                                    <p class="fw-bold fs-6 mt-1">
                                        School year last attended:
                                        <input type="text" class="form-control form-control-sm" wire:model="lastYear">
                                    </p>
                                </div>
                            </div>

                            <script>
                                const checkNew = document.getElementById('checkNew');
                                const newInput = document.getElementById('newInput');

                                checkNew.addEventListener('click', function() {
                                    newInput.style.display = 'block';
                                });

                                const radioButtons = document.getElementsByName('studentType');
                                for (const radio of radioButtons) {
                                    radio.addEventListener('click', function() {
                                        if (radio.value !== 'new') {
                                            newInput.style.display = 'none';
                                        }
                                    });
                                }
                            </script>

                            <div class="row mt-2 mx-3 mb-5">
                                <div class="col-6 col-md-6 col-lg-6">
                                    <p class="fw-bold">Are you a recipient of any scholarship/grant?</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="yes" value="yes"
                                         wire:model="grant_status" >
                                        <label class="form-check-label" for="yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="no" value="no"
                                         wire:model="grant_status">
                                        <label class="form-check-label" for="no">No</label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 col-lg-6" style="display:none;" id="grantNew">
                                    <p>
                                        If yes, write the complete name of the scholarship/grant and amount of stipend
                                        received per semester
                                    </p>
                                    <input type="text" class="form-control form-control-sm" wire:model="grant"
                                        id="grant">
                                </div>
                            </div>

                            <script>
                                const yesCheckbox = document.getElementById('yes');
                                const noCheckbox = document.getElementById('no');
                                const grantNew = document.getElementById('grantNew');

                                // Function to show or hide the "grantNew" element based on the radio button selection
                                function showHideGrantNew() {
                                    if (yesCheckbox.checked) {
                                        grantNew.style.display = 'block';
                                    } else {
                                        grantNew.style.display = 'none';
                                    }
                                }

                                // Add event listeners to both radio buttons
                                yesCheckbox.addEventListener('change', showHideGrantNew);
                                noCheckbox.addEventListener('change', showHideGrantNew);

                                // Call the function initially to set the initial state based on the default selection
                                showHideGrantNew();
                            </script>



                            {{-- recipient --}}


                            <div class="row">
                                <div class="col-12 col-md-12 mb-2">
                                    <label for="scholarship_name" class="mb-2">Scholarship Name</label>
                                    <select wire:model="scholarship_name" id="scholarship_name"
                                        class="form-control form-control-sm mb-2">
                                        {{-- <option value="">Select Scholarship Name</option> --}}
                                        @foreach ($scholarships as $scholarship)
                                            <option value="{{ $scholarship->name }}">{{ $scholarship->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-12 mb-5">
                                    <label>Scholarship Fund</label>
                                    <div class="mx-5">
                                        @if ($scholarship_name)
                                            @foreach ($scholarships as $scholarship)
                                                @if ($scholarship->id == $scholarship_name)
                                                    @foreach ($scholarship->fundSources as $fundSource)
                                                        <div class="form-check form-check-inline mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="{{ $fundSource->source_name }}"
                                                                id="fund_source_{{ $fundSource->source_id }}"
                                                                wire:model="selectedFundSources">
                                                            <label class="form-check-label"
                                                                for="fund_source_{{ $fundSource->source_id }}">{{ $fundSource->source_name }}</label>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>



                            <div class="d-flex float-start mt-3 gap-4">
                                <button type="reset"
                                    class="btn btn-gradient-warning btn-fw fw-bold text-dark mt-2">Reset</button>
                                <button type="submit"
                                    class="btn btn-gradient-success btn-fw fw-bold text-dark mt-2">Save</button>
                            </div>
                            {{-- it ends here --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- forms end --}}
</div>















{{----}}

<div class="row">
    <p class="mt-3 fw-bold fs-6">ADDRESS<span class="text-danger">*</span></p>
    <!--  Province Address -->
    <div class="col-md-4 position-relative mt-0">
        <label class="form-label">Province</label>
        <select class="form-select" aria-label="Default select example"
            wire:model="selectedProvince">
            <option value="" selected >Select Province</option>
            @foreach ($provinces as $province)
                <option value="{{ $province->id }}">
                    {{ $province->name }}
                </option>
            @endforeach
        </select>
        @error('province')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <!--  City Address -->
    <div class="col-md-4 position-relative mt-0">
        <label class="form-label">City/Municipality</label>
        <select class="form-select" aria-label="Default select example"
            wire:model="selectedMunicipality">
            <option value="" selected>Select City</option>
            @foreach($municipalities as $municipality)
            <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
        @endforeach

        </select>
        @error('municipal')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <!--  Barangay Address -->
    <div class="col-md-4 position-relative mt-0">
        <label class="form-label">Barangay</label>
        <select class="form-select" aria-label="Default select example" name="barangay"
            wire:model="selectedBarangay">
            <option value="" selected>Select Barangay</option>
            @foreach($barangays as $barangay)
            <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
        @endforeach
        </select>
        @error('barangay')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

{{-- hjdhasd --}}

<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Request;
use App\Models\Campus;
use App\Models\Course;
use Livewire\Component;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Models\ScholarshipName;

class Grantees extends Component
{
    public $selectedCampus;
    public $selectedCourse;
    public $courses;
    public $scholarships;
    public $selectedFundSources = [];
    public $scholarship_name;
    public $selectedScholarship;
    public $scholarshipName;

    public $lastname;
    public $firstname;
    public $initial;
    public $sex;
    public $status;
    public $contact;
    public $email;
    public $student_id;
    public $grant_status;
    public $studentType;
    // address
    public $selectedProvince;
    public $selectedMunicipality;
    public $selectedBarangay;
    public $municipalities = [];
    public $barangays = [];



    // address
    public function updatedSelectedProvince($provinceId)
    {
        $this->municipalities = Municipal::where('province_id', $provinceId)->get();
        $this->selectedMunicipality = null;
        $this->selectedBarangay = null;
        $this->barangays = [];
    }

    public function updatedSelectedMunicipality($municipalityId)
    {
        $this->barangays = Barangay::where('municipal_id', $municipalityId)->get();
        $this->selectedBarangay = null;
    }
    // end
    public function saveStudent()
    {
        // Validate the student form fields
        $this->validate([
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
            'student_id' => 'required|unique:students,student_id', // Ensure unique student ID
            'level' => 'required',
            'studentType' => 'required',
            'nameSchool' => 'required_if:studentType,new',
            'lastYear' => 'required_if:studentType,new',
            'grant_status' => 'required',
            'grant' => 'required_if:grant_status,yes',
        ]);

        //course here
               // Get the campus name based on the selectedCampus
               $campus = Campus::findOrFail($this->selectedCampus);
        // end here
        // address
            // Get the province, municipal, and barangay names based on their IDs
            $province = Province::findOrFail($this->selectedProvince);
            $municipality = Municipal::findOrFail($this->selectedMunicipality);
            $barangay = Barangay::findOrFail($this->selectedBarangay);
        // end
        // Save the student data
        $student = Student::create([
            'campus_name' => $campus->campus_name,
            'course_name' => $this->selectedCourse,
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'middle_initial' => $this->initial,
            'province' => $province->province_name,
            'municipal' => $municipality->municipal_name,
            'barangay' => $barangay->barangay_name,
            'sex' => $this->sex,
            'civil_status' => $this->status,
            'contact_number' => $this->contact,
            'email' => $this->email,
            'student_id' => $this->student_id,
            'year_level' => $this->level,
            'student_type' => $this->studentType,
            'last_school_attended' => $this->nameSchool,
            'last_school_year' => $this->lastYear,
            'grant_status' => $this->grant_status,
            'grant_details' => $this->grant,
        ]);

        // Optionally, you can reset the form fields after saving the data
        $this->reset();

        // Optionally, you can redirect the user to a success page or show a success message.
        session()->flash('success', 'Student data saved successfully!');
    }
    //



    public function mount()
    {
        $this->scholarships = ScholarshipName::with('scholarshipType', 'fundSources')->get();
    }


    public function render()
    {
        $provinces = Province::all();
        $campuses = Campus::all();
        $this->courses = [];
        // address

//   end here


        if ($this->selectedCampus) {
            $campus = Campus::findOrFail($this->selectedCampus);
            $this->courses = $campus->courses;
        }

        // Fetch scholarships along with their types and fund sources
        $this->scholarships = ScholarshipName::with('scholarshipType', 'fundSources')->get();

        return view('livewire.grantees', [
            'campuses' => $campuses,
            'provinces' => $provinces
        ]);
    }

    public function updatedSelectedFundSources()
    {
        // Limit the selection to 2 fund sources
        if (count($this->selectedFundSources) > 2) {
            // Uncheck any additional selections beyond the first two
            $this->selectedFundSources = array_slice($this->selectedFundSources, 1, 3);
        }
    }

    // adresssss

    }
