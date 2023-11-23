<?php

namespace App\Http\Livewire;

use App\Models\Fund;
use App\Models\Student;
use Livewire\Component;
use App\Models\FundSource;
use App\Models\ScholarshipName;
use App\Models\ScholarshipType;
use Illuminate\Support\Facades\DB;


class ViewForm extends Component
{
    public $selectedFund;
    public $studentsByFund;
    public $scholarship_type;
    public $scholarship_name;
    public $fund_sources;
    public $selectedFundSource;
    public $selectedSource;

    public function render()
    {
        // Fetch the data from the database
        $scholarshipTypes = ScholarshipType::all();
        $scholarshipNames = $this->getScholarshipNames();
        $fundSources = $this->getFundSources();
        $studentsByFund = $this->getStudentsByFund();

        // Fetch the selected fund source from the database
        $selectedFundSource = FundSource::find($this->selectedFund);

        return view('livewire.view-form', [
            'scholarshipTypes' => $scholarshipTypes,
            'scholarshipNames' => $scholarshipNames,
            'fundSources' => $fundSources,
            'selectedFundSource' => $selectedFundSource,
            'studentsByFund' => $studentsByFund ?? [] // Use empty array if $studentsByFund is not set
        ]);
    }


    public function getScholarshipNames()
    {
        if ($this->scholarship_type) {
            // Assuming ScholarshipName is the correct model name
            return ScholarshipName::where('scholarship_type_id', $this->scholarship_type)->get();
        }

        return [];
    }

    public function getFundSources()
    {
        if ($this->scholarship_name) {
            // Assuming FundSource is the correct model name
            return FundSource::where('scholarship_name_id', $this->scholarship_name)->get();
        }

        return [];
    }

    public function getStudentsByFund()
    {
        if ($this->selectedFund) {
            // Assuming FundStudent is the pivot model for the many-to-many relationship
            $students = Fund::where('source_id', $this->selectedFund)
                ->pluck('student_id')
                ->toArray();

            // Assuming Student is the correct model name for the students table
            $studentDetails = Student::whereIn('student_id', $students)->get();

            return $studentDetails;
        }

        return [];
    }
    public $students;
    public $sourceName;

    public function submit()
    {
        $funds = DB::table('funds')
            ->where('source_id', $this->selectedSource)
            ->pluck('student_id');

        $students = [];
        foreach ($funds as $fund) {
            $student = Student::find($fund);
            $students[] = $student;
        }

        $sourceName = DB::table('fund_sources')
        ->where('source_id', $this->selectedSource)
        ->value('source_name');

        $this->students = $students;

        return redirect()->route('livewire.student-data', ['students' => $students, 'sourceName' => $sourceName]);
    }



}

form for view-form //  <section class="mt-3 p-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body shadow-lg p-5">
                        <form wire:submit.prevent="submit">
                            @csrf
                            <div class="form-check">
                                <label for="type" class="mb-2 fw-bold">Scholarship Type</label>
                                <select wire:model="selectedType" id="scholarship_type" class="form-select mb-2">
                                    <option value="">Select Scholarship type</option>
                                    @foreach ($scholarshipTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-check">
                                <label for="scholarship_name" class="mb-2 fw-bold">Scholarship Name</label>
                                <select wire:model="selectedName" id="scholarship_name" class="form-select mb-2">
                                    <option value="">Select Scholarship Name</option>
                                    @foreach ($scholarshipNames as $name)
                                    <option value="{{ $name->id }}">{{ $name->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-check">
                                <label class="mb-2 fw-bold" for="fund_sources">Source of Funds</label>
                                <select wire:model="selectedSource" id="fund_sources" class="form-select mb-2">
                                    <option value="">Select Source of Funds</option>
                                    @foreach ($fundSources as $fundSource)
                                    <option value="{{ $fundSource->source_id }}">{{ $fundSource->source_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <button type="submit" class="btn btn-gradient-success text-dark fw-bold"
                                    wire:click="submit">View</button>
                                <span wire:loading wire:target="submit" class="me-2 fs-6 fw-bold">Loading...</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
 // its livewire //     public function mount()
    {
        // Retrieve data from the database
        $this->scholarshipTypes = ScholarshipType::all();
        $this->scholarshipNames = collect();
        $this->fundSources = collect();
    }

    public function updatedSelectedType($value)
    {
        // Update the scholarship names based on the selected scholarship type
        if ($value) {
            $this->scholarshipNames = ScholarshipName::where('scholarship_type_id', $value)->get();
        } else {
            $this->scholarshipNames = collect();
        }
        // Reset the selected scholarship name and fund source
        $this->selectedName = null;
        $this->selectedSource = null;
    }

    public function updatedSelectedName($value)
    {
        // Update the fund sources based on the selected scholarship name
        if ($value) {
            $this->fundSources = FundSource::where('scholarship_name_id', $value)->get();
        } else {
            $this->fundSources = collect();
        }
        // Reset the selected fund source
        $this->selectedSource = null;
    }

    public function submit()
    {
        // Retrieve students based on the selected source of funds
        $students = Student::whereHas('funds', function ($query) {
            $query->where('source_id', $this->selectedSource);
        })->get();

        // Retrieve the name of the selected source of funds
        $sourceName = FundSource::find($this->selectedSource)->source_name;

        // Redirect to the student data route with the students and source name as parameters
        return redirect()->route('admin.scholarship.student-view', [
            'students' => $students,
            'sourceName' => $sourceName,
        ]);
    }

    public function render()
    {
        return view('livewire.view-form');
    }

//



<section class="p-4">
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card">
                    @if ($students && $sourceName)
                    <div class="card-header">
                        <h2>{{ $sourceName }}</h2>
                        <input type="search" class="form-control form-control-md rounded float-end"
                            placeholder="search...">
                    </div>
                    <div class="card-body shadow-lg">
                        <div class="table-responsive">
                            <table wire:model='students' id="students" class="table table-striped data-table"
                                style="width: 100%">
                                <thead>
                                    <th>Student Id</th>
                                    <th>Lastname</th>
                                    <th>Firstname</th>
                                    <th>Middle Initial</th>
                                    <th>Email</th>
                                    <th>Sex</th>
                                    <th>Civil Status</th>
                                    <th>Barangay</th>
                                    <th>City/Municipal</th>
                                    <th>Province</th>
                                    <th>School</th>
                                    <th>Course</th>
                                    <th>Year level</th>
                                    <th>Father's full name</th>
                                    <th>Mother's full name</th>
                                    <th>Contact number</th>
                                    <th>Student Type</th>
                                    <th>Name of School Last attended</th>
                                    <th>School Year Last attended</th>
                                    <th>Recipient</th>
                                    <th>Name of Scholarship/Grant</th>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                    <tr>
                                        <th>{{ $student->student_id }}</th>
                                        <th>{{ $student->lastname }}</th>
                                        <th>{{ $student->firstname }}</th>
                                        <th>{{ $student->initial }}</th>
                                        <th>{{ $student->email }}</th>
                                        <th>{{ $student->sex }}</th>
                                        <th>{{ $student->status }}</th>
                                        <th>{{ $student->barangay }}</th>
                                        <th>{{ $student->municipal }}</th>
                                        <th>{{ $student->province }}</th>
                                        <th>{{ $student->campus }}</th>
                                        <th>{{ $student->course }}</th>
                                        <th>{{ $student->level }}</th>
                                        <th>{{ $student->father }}</th>
                                        <th>{{ $student->mother }}</th>
                                        <th>{{ $student->contact }}</th>
                                        <th>{{ $student->studentType }}</th>
                                        <th>{{ $student->nameSchool }}</th>
                                        <th>{{ $student->lastYear }}</th>
                                        <th>{{ $student->grant_status }}</th>
                                        <th>{{ $student->grant }}</th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
    </section>
    <script>
        $(document).ready(function () {
          $(".data-table").each(function (_, table) {
            $(table).DataTable();
          });
        });

        $(document).ready(function() {
          $('#students').DataTable( {
            dom: 'Bfrtip',
            buttons: [
              'csv', 'excel'
            ]
          } );
        } );
    </script>





<div>

    <section class="p-2">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Users</h2>
                    </div>
                    <div class="card-body shadow-lg">
                        <div class="table-responsive">
                            <table id="students" class="table table-striped data-table" style="width: 100%">
                                <thead>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <th>{{ $user->id }}</th>
                                        <th>{{ $user->name }}</th>
                                        <th>{{ $user->username }}</th>
                                        <th>
                                            <button wire:click="editUser({{ $user->id }})"
                                                class="btn-gradient-warning btn-sm" type="button" data-bs-toggle="modal"
                                                data-bs-target="#editUserModal">Edit</button>

                                            {{-- modal --}}
                                            @if ($showEditModal)
                                            <div class="modal fade" id="editUserModal" tabindex="-1"
                                                aria-labelledby="editUserModalLabel" aria-hidden="true">
                                                <!-- Your form content goes here -->
                                                <form method="post"
                                                    action="{{ route('admin.settings.accountSettings', $selectedUserId) }}">
                                                    @csrf
                                                    <div class="row g-3 mb-3">
                                                        <div class="col">
                                                            <input type="text" id="name"
                                                                class="form-control form-control-sm @error('name') is-invalid @enderror"
                                                                name="name" value="{{ old('name') }}">
                                                            <label class="form-label" for="name">Name</label>
                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col">
                                                            <input type="text" id="username"
                                                                class="form-control form-control-sm @error('username') is-invalid @enderror"
                                                                name="username" value="{{ old('username') }}" />
                                                            <label class="form-label" for="username">Username</label>
                                                            @error('username')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row g-3 mb-3">
                                                        <div class="col" style="position: relative;">
                                                            <input type="password" id="password"
                                                                class="form-control form-control-sm @error('password') is-invalid @enderror"
                                                                name="password" value="{{ old('password') }}" />
                                                            <label class="form-label" for="password">Password</label>
                                                            <i class="mdi mdi-eye" id="passwordToggle"
                                                                style="position:absolute; top:20%; right:10px; transform:translateY(-50); cursor: pointer;"
                                                                onclick="togglePasswordVisibility('password')"></i>
                                                            @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col" style="position: relative;">
                                                            <input type="password" id="cpassword"
                                                                class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror"
                                                                name="password_confirmation"
                                                                value="{{ old('cpassword') }}" />
                                                            <label class="form-label" for="cpassword">Confirm
                                                                password</label>
                                                            <i class="mdi mdi-eye" id="cpasswordToggle"
                                                                style="position:absolute; top:20%; right:10px; transform:translateY(-50); cursor: pointer;"
                                                                onclick="togglePasswordVisibility('cpassword')"></i>
                                                            @error('cpassword')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </div>

                                            @endif
                                            {{-- end here --}}

                                        </th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function togglePasswordVisibility(fieldId) {
          const field = document.getElementById(fieldId);

        if(field.type === 'password')
        {
            field.type = 'text';
        } else
        {
            field.type = 'password';
        }
        }

        function validateForm() {
          var password = document.getElementById("password").value;
          var cPassword = document.getElementById("cpassword").value;

          if (password !== cPassword) {
            alert("Passwords do not match!");
            return false;
          }

          return true;
        }

        livewire.hook('afterMount', () => {
          // Set showEditModal to true when the user clicks the editUser button
          livewire.emit('editUser', {{ $user->id }}, () => {
            window.livewire.refs.editUserModal.showEditModal = true;
          });
        });
    </script>
    {{-- it ends here --}}
</div>





<div>

    <section class="p-5">
        <div class="row">
            <div class="pagetitle">
                <h1>Users Profile</h1>
            </div><!-- End Page Title -->

            <section class="section profile">
                <div class="row">

                    <div class="col-xl-12">

                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">

                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#profile-overview">Overview</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-edit">Edit
                                            Profile</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-change-password">Change Password</button>
                                    </li>

                                </ul>
                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                        <h5 class="card-title">Profile Details</h5>
                                        {{-- @foreach ($users as $user ) --}}
                                        <div class="row mb-2">
                                            <div class="col-lg-6 col-md-8">
                                                <label class="col-form-label">Name</label>
                                                <input wire:model="name" type="text" class="form-control" id="name">
                                            </div>
                                            <div class="col-lg-6 col-md-4">
                                                <label class="col-form-label">Username</label>
                                                <input wire:model="username" type="text" class="form-control" id="username">
                                            </div>
                                        </div>

                                        {{-- @endforeach --}}

                                    </div>

                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                        <!-- Profile Edit Form -->
                                        <form>

                                            <div class="row mb-3">
                                                <label for="name" class="col-md-4 col-lg-3 col-form-label">Full
                                                    Name</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input wire:model="name" type="text" class="form-control" id="name">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="username"
                                                    class="col-md-4 col-lg-3 col-form-label">Username</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input wire:model="username" type="text" class="form-control"
                                                        id="username">
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form><!-- End Profile Edit Form -->

                                    </div>


                                    <div class="tab-pane fade pt-3" id="profile-change-password">
                                        <!-- Change Password Form -->
                                        <form wire:submit.prevent="changePassword">
                                            @csrf

                                            <div class="row mb-3">
                                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                                    Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input wire:model="password" type="password" class="form-control" id="currentPassword" required minlength="8">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                    Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input wire:model="newPass" type="password" class="form-control" id="newPassword" required minlength="8">
                                                    @error('newPass')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                                    Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="renewpassword" type="password" class="form-control" id="renewPassword" required minlength="8"
                                                        {{ $errors->has('renewpassword') ? 'is-invalid' : '' }}>
                                                    @error('renewpassword')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Change Password</button>
                                            </div>
                                        </form><!-- End Change Password Form -->

                                    </div>



                                </div><!-- End Bordered Tabs -->

                            </div>
                        </div>

                    </div>
                </div>

        </div>
    </section>

</div>


 Don Mariano Marcos Memorial State  University North La Union Campus
 Don Mariano Marcos Memorial State  University Mid La Union Campus
 Don Mariano Marcos Memorial State  University South La Union Campus
 Don Mariano Marcos Memorial State  University Open University System





 <?php

namespace App\Http\Livewire;

use App\Models\Fund;
use App\Models\Student;
use Livewire\Component;
use App\Models\ScholarshipName;
use PowerComponents\LivewirePowerGrid\PowerGrid;


class ViewForm extends Component
{

    public $grid;
    public $selectedScholarshipName;
    public $selectedSourceId;
    // public $selectedSourceId;

     public function render()
    {

        // scholarship names & funds sources

        $scholarship = ScholarshipName::query()
        ->where('name', $this->selectedScholarshipName)
        ->with('fundSources')
        ->first();

            $studentIds = Fund::query()
        ->where('source_id', $this->selectedSourceId)
        ->pluck('student_id');

            $students = Student::query()
        ->whereIn('id', $studentIds)
        ->get();

        // it ends here

        $grid = PowerGrid::eloquent($students);
            $this->model('students')
            ->addColumn('id', 'ID')
            ->addColumn('student_id', 'Student ID')
            ->addColumn('lastname', 'Lastname')
            ->addColumn('firstname', 'Firstname')
            ->addColumn('initial', 'Middle Initial')
            ->addColumn('email', 'Email Address')
            ->addColumn('sex', 'Sex')
            ->addColumn('status', 'Civil Status')
            ->addColumn('barangay', 'Barangay')
            ->addColumn('municipal', 'Municipal')
            ->addColumn('province', 'Province')
            ->addColumn('campus', 'Campus')
            ->addColumn('course', 'Course')
            ->addColumn('level', 'Year Level')
            ->addColumn('father', 'Fathers Full Name')
            ->addColumn('mother', 'Mothers Full Name')
            ->addColumn('contact', 'Contact Number')
            ->addColumn('studentType', 'Type of Student ')
            ->addColumn('nameSchool', 'Name of School Last Attended')
            ->addColumn('lastYear', 'School Year Last Attended')
            ->addColumn('grant_status', 'Recipient')
            ->addColumn('grant', 'Name of Scholarship/Grant')
            ->filterable('lastname')
            ->sortable('id')
            ->disablePagination()
            ->exportable();

             return view('livewire.view-form', [
        'grid' => $grid
    ]);
    }

}


public function mount()
    {
        // Retrieve data from the database
        $this->scholarshipNames = ScholarshipName::all();
        $this->fundSources = collect();
    }


    public function updatedSelectedName($value)
    {
        // Update the fund sources based on the selected scholarship name
        if ($value) {
            $this->fundSources = FundSource::where('scholarship_name_id', $value)->get();
        } else {
            $this->fundSources = collect();
        }
        // Reset the selected fund source
        $this->selectedSource = null;
    }

    public function render()
    {
        // Retrieve data from the database
        $this->scholarshipNames = ScholarshipName::all();
        $this->fundSources = collect();

        public function updatedSelectedName($value)
    {
        // Update the fund sources based on the selected scholarship name
        if ($value) {
            $this->fundSources = FundSource::where('scholarship_name_id', $value)->get();
        } else {
            $this->fundSources = collect();
        }
        // Reset the selected fund source
        $this->selectedSource = null;
    }

        // Retrieve students based on the selected source of funds
        $students = Student::whereHas('funds', function ($query) {
            $query->where('source_id', $this->selectedSource);
        })->get();

        // Retrieve the name of the selected source of funds
        $sourceName = FundSource::find($this->selectedSource)->source_name;

        // Redirect to the student data route with the students and source name as parameters
        return view('livewire.view-form');
    }




    public function render()
    {
            public function getScholarshipNames()
    {
        if ($this->scholarship_type) {
            // Assuming ScholarshipName is the correct model name
            return ScholarshipName::where('scholarship_type_id', $this->scholarship_type)->get();
        }

        return [];
    }

    public function getFundSources()
    {
        if ($this->scholarship_name) {
            // Assuming FundSource is the correct model name
            return FundSource::where('scholarship_name_id', $this->scholarship_name)->get();
        }

        return [];
    }

    public function getStudentsByFund()
    {
        if ($this->selectedFund) {
            // Assuming FundStudent is the pivot model for the many-to-many relationship
            $students = Fund::where('source_id', $this->selectedFund)
                ->pluck('student_id')
                ->toArray();

            // Assuming Student is the correct model name for the students table
            $studentDetails = Student::whereIn('student_id', $students)->get();

            return $studentDetails;
        }

        return [];
    }
    public $students;
    public $sourceName;

    public function submit()
    {
        $funds = DB::table('funds')
            ->where('source_id', $this->selectedSource)
            ->pluck('student_id');

        $students = [];
        foreach ($funds as $fund) {
            $student = Student::find($fund);
            $students[] = $student;
        }

        $sourceName = DB::table('fund_sources')
        ->where('source_id', $this->selectedSource)
        ->value('source_name');

        $this->students = $students;

        // Fetch the data from the database
        $scholarshipTypes = ScholarshipType::all();
        $scholarshipNames = $this->getScholarshipNames();
        $fundSources = $this->getFundSources();
        $studentsByFund = $this->getStudentsByFund();

        // Fetch the selected fund source from the database
        $selectedFundSource = FundSource::find($this->selectedFund);

        return view('livewire.view-form', [
            'scholarshipTypes' => $scholarshipTypes,
            'scholarshipNames' => $scholarshipNames,
            'fundSources' => $fundSources,
            'selectedFundSource' => $selectedFundSource,
            'studentsByFund' => $studentsByFund ?? [] // Use empty array if $studentsByFund is not set
        ]);
    }



        return redirect()->route('livewire.student-data', ['students' => $students, 'sourceName' => $sourceName]);
    }



}



    // "auth": {
    //     "github": {
    //         "token": "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"
    //     }
    // },




// "datatables.net-buttons-dt": "^2.4.1",
// "datatables.net-dt": "^1.13.6",
// "datatables.net-responsive-dt": "^2.5.0",
// "datatables.net-scroller-dt": "^2.2.0",
// "datatables.net-searchbuilder-dt": "^1.5.0",






                                {{-- <div class="row">
                                    <div class="col-12 col-md-12 mb-2">
                                        <label for="scholarship_name" class="mb-2">Scholarship Name</label>
                                        <select wire:model="scholarship_name" id="scholarship_name"
                                            class="form-control form-control-sm mb-2">
                                            <option>Select Scholarship Name</option>
                                            @foreach ($scholarships as $scholarship)
                                            <option value="{{ $scholarship->id }}">{{ $scholarship->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($selectedScholarshipType)
                                        <p class="mt-2">Selected Scholarship Type: {{ $selectedScholarshipType }}</p>
                                        @endif
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
                                                    value="{{ $fundSource->source_id }}"
                                                    id="fund_source_{{ $fundSource->source_id }}"
                                                    wire:model="selectedFundSources">
                                                <label class="form-check-label"
                                                    for="fund_source_{{ $fundSource->source_id }}">{{
                                                    $fundSource->source_name }}</label>
                                                @error('selectedFundSources')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            @endforeach
                                            @endif
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- <div class="row mt-2 mx-3 mb-3">
                                    <div class="col-6 col-md-6 col-lg-6">
                                        <p class="fw-bold">Are you a recipient of any scholarship/grant?</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="yes" value="yes"
                                                name="grant_status" wire:model="grant_status"
                                                wire:change="showHideFundSource">
                                            <label class="form-check-label" for="yes">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="no" value="no"
                                                name="grant_status" wire:model="grant_status">
                                            <label class="form-check-label" for="no">No</label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-6 col-lg-6" id="fundSource" wire:loading.remove>
                                        @if ($grant_status === 'yes')
                                        <p>If yes, write the complete name of the scholarship/grant and amount of
                                            stipend received per semester</p>
                                        <label class="mb-1">Select Fund Source <font class="text-danger">*</font>
                                        </label>
                                        <select class="form-control form-control-sm" id="grant" wire:model="grant">
                                            <option>Select Fund Source</option>
                                            @foreach ($fundSources as $fundSource)
                                            <option value="{{ $fundSource->source_id }}">{{ $fundSource->source_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>
                                </div> --}}


            // Fetch scholarships along with their types and fund sources
            // $this->scholarships = ScholarshipName::with('scholarshipType', 'fundSources')->get();
            // $this->fundSources = FundSource::all();



            // updatedSelectedFundSources method
            // public function updatedSelectedFundSources()
            // {
            //     // Ensure $this->selectedFundSources is an array
            //     if (!is_array($this->selectedFundSources)) {
            //         $this->selectedFundSources = [];
            //     }

            //     // Limit the selection to 2 fund sources
            //     if (count($this->selectedFundSources) > 2) {
            //         // Uncheck any additional selections beyond the first two
            //         $this->selectedFundSources = array_slice($this->selectedFundSources, 1, 3); // Corrected slice parameters
            //     }
            // }


            FY40PG#?fbcd



            <?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\AuditLog;
use App\Models\ScholarshipName;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class ScholashipNameTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\ScholarshipName>
     */
    public function datasource(): Builder
    {
        return ScholarshipName::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')

           /** Example of custom column using a closure **/
            ->addColumn('name_lower', fn (ScholarshipName $model) => strtolower(e($model->name)));

            // ->addColumn('scholarship_type_id')
            // ->addColumn('created_at_formatted', fn (ScholarshipName $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
      * PowerGrid Columns.
      *
      * @return array<int, Column>
      */
    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            Filter::inputText('name')->operators(['contains']),
            // Filter::datetimepicker('created_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid ScholarshipName Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
       return [
           Button::make('view', 'View')
               ->class('btn btn-sm btn-primary text-dark')
               ->route('scholarship-name.view', function(ScholarshipName $model) {
                    return ['scholarship' => $model->id];

               }),
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid ScholarshipName Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($scholarship-name) => $scholarship-name->id === 1)
                ->hide(),
        ];
    }
    */
}

// <livewire:scholarship-name-table/>





                        {{-- @if($scholar->fundSources)
                        @forelse ($scholar->fundSources as $funds)
                        <li>{{ $funds->source_name }}</li>


                        @empty
                        <div>
                            No fund sources
                        </div>
                        @endforelse

                        @endif --}}




                        <section class="p-5">
    <div class="row p-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body shadow-lg">
                    <form wire:submit.prevent="saveStudent">
                        @csrf

                        <div class="row mt-0 mb-1 justify-content-center">
                            <div class="col-6 col-md-6 col-lg-6 text-center">
                                {{-- Add an additional div for the image and label --}}
                                <div class="d-flex flex-column align-items-center">
                                    <img src="{{ asset('assets/images/updated.png') }}" class="img-fluid"
                                        style="width: 150px; height: 150px;" alt="dmmmsu-logo">
                                    <label class="form-check-label fw-bold mb-1" for="semester">Semester</label>
                                    <select class="form-select form-select-sm text-center " name="semester" wire:model="semester">
                                        <option selected>{{ $student->semester }}</option>
                                        <option value="1">1st</option>
                                        <option value="2">2nd</option>
                                    </select>
                                    @error('semester')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row align-items-center">
                            <label for="campus" class="fw-bold fs-5 col-sm-2">CAMPUS:</label>
                            @foreach ($campuses as $campus)
                            <div class="form-check form-check-inline col-sm-2">
                                <input class="form-check-input campus-radio" type="radio" wire:model="selectedCampus" value="{{ $campus->id }}">
                                <label class="form-check-label" for="campus_{{ $campus->id }}">{{ $campus->campus_name }}</label>
                            </div>
                            @endforeach
                        </div>


                        <hr>

                        <div class="row mt-2 mb-3 mx-2">
                            <div class="col-12 col-md-6 col-lg-6" style="margin-inline-start: 20px;">
                                <div class="d-flex align-items-start">
                                    @foreach (['New', 'Continuing', 'Returning Student'] as $type)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('studentType') is-invalid @enderror"
                                            type="radio" name="studentType" id="check{{ $type }}"
                                            value="{{ $type }}" wire:model="studentType"
                                            wire:click="{{ $type === 'New' ? 'showNewInput' : 'hideNewInput' }}">
                                        <label class="form-check-label" style="margin-left: 0%; margin-right:20px;"
                                            for="check{{ $type }}">{{ $type
                                            }}</label>
                                        @error('studentType')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- end --}}

                        <div class="col-12 col-md-6 col-lg-6 mx-3 my-3" id="newInput"
                            style="display: {{ $showNewInput ? 'block' : 'none' }}">
                            <p><span class="text-danger">*</span>
                                If new, indicate name of school last attended:
                            </p>
                            <input type="text" class="form-control form-control-sm" name="nameSchool"
                                id="nameSchool" wire:model.defer="nameSchool">

                            <p class="mt-1"><span class="text-danger">*</span>
                                School year last attended:
                            </p>
                            <input type="text" class="form-control form-control-sm" name="lastYear" id="lastYear"
                                wire:model.defer="lastYear">
                        </div>
                        {{--
                </div> --}}

                <script>
                    // Livewire component initialization
                                    Livewire.on('hideNewInput', () => {
                                        document.getElementById('newInput').style.display = 'none';
                                    });

                                    Livewire.on('showNewInput', () => {
                                        document.getElementById('newInput').style.display = 'block';
                                    });
                </script>
                {{-- end --}}


                <div class="row">
                    <p class="fw-bold fs-5">I. STUDENT INFORMATION</p>

                    <div class="col-md-4 position-relative mt-0">
                        <label class="form-label" for="lastname" name="lastname">Last name</label>
                        <input type="text" id="lastname"
                            class="form-control form-control-sm @error('lastname') is-invalid @enderror"
                            wire:model="lastname" />
                        @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 position-relative mt-0">
                        <label class="form-label" for="firstname" name="firstname">First name</label>
                        <input type="text" id="firstname"
                            class="form-control form-control-sm @error('firstname') is-invalid @enderror"
                            wire:model="firstname" />
                        @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 position-relative mt-0">
                        <label class="form-label" for="initial" name="initial">Middle Initial</label>
                        <input type="text" id="initial"
                            class="form-control form-control-sm @error('initial') is-invalid @enderror"
                            wire:model="initial" />
                        @error('initial')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>

                <div class="row">
                    <p class="mt-3 fw-bold fs-6">ADDRESS<span class="text-danger">*</span></p>
                    <!-- Province Address -->
                    <div class="col-md-4 position-relative mt-0">
                        <label class="form-label">Province</label>
                        <select class="form-select" aria-label="Default select example"
                            wire:model="selectedProvince">
                            <option value="" selected>Select Province</option>
                            @foreach ($provinces as $province)
                            <option value="{{ $province->provCode }}">{{ $province->provDesc }}</option>
                            @endforeach
                        </select>
                        @error('selectedProvince')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 position-relative mt-0">
                        <label class="form-label">City/Municipality</label>
                        <select class="form-select" aria-label="Default select example"
                            wire:model="selectedMunicipality">
                            <option value="" selected>Select City</option>
                            @foreach ($municipalities as $municipality)
                            <option value="{{ $municipality->citymunCode }}">{{ $municipality->citymunDesc
                                }}</option>
                            @endforeach
                        </select>
                        @error('selectedMunicipality')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Barangay Address -->
                    <div class="col-md-4 position-relative mt-0">
                        <label class="form-label">Barangay</label>
                        <select class="form-select" aria-label="Default select example"
                            wire:model="selectedBarangay">
                            <option value="" selected>Select Barangay</option>
                            @foreach ($barangays as $barangay)
                            <option value="{{ $barangay->brgyCode }}">{{ $barangay->brgyDesc }}</option>
                            @endforeach
                        </select>
                        @error('selectedBarangay')
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
                            <label for="sex" class="fw-light">Sex:</label>
                            <div class="form-check form-check-inline">
                                @foreach (['Male', 'Female'] as $sex )
                                <input class="form-check-input @error('sex') is-invalid @enderror" type="radio"
                                    id="{{ $sex }}" value="{{ $sex }}" wire:model="sex">
                                <label class="form-check-label m-0" for="{{ $sex }}">{{ $sex }}</label>
                                @endforeach
                            </div>
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
                            <label for="status" class="fw-light mr-2">Civil Status:</label>
                            <div class="form-check form-check-inline">
                                @foreach (['Single', 'Married'] as $cs )
                                <input class="form-check-input @error('status') is-invalid @enderror" type="radio"
                                    id="{{ $cs }}" value="{{ $cs }}" wire:model="status">
                                <label class="form-check-label m-0" for="{{ $cs }}">{{ $cs }}</label>
                                @endforeach
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
                {{-- sex end --}}


                {{-- contact here --}}
                <div class="row">
                    <div class="col-md-4 position-relative mt-0">
                        <label class="form-label" for="contact" name="contact">Contact
                            Number</label>
                        <input type="text" id="contact"
                            class="form-control form-control-sm @error('contact') is-invalid @enderror"
                            wire:model="contact" maxlength="11" minlength="11" />
                        @error('contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- Email -->
                    <div class="col-md-4 position-relative mt-0">
                        <label class="form-label" for="email" name="email">Email Address</label>
                        <input type="email" id="email"
                            class="form-control form-control-sm @error('email') is-invalid @enderror"
                            wire:model="email" name="email" />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Student ID -->
                    <div class="col-md-4 position-relative mt-0">
                        <label class="form-label" for="student_id">Student ID</label>
                        <input type="text" id="student_id"
                            class="form-control form-control-sm @error('student_id') is-invalid @enderror"
                            wire:keydown="checkScholarshipLimit" wire:model="student_id" name="student_id"
                            maxlength="10" />
                        @error('student_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        @if ($scholarshipLimitExceeded)
                        <div class="alert alert-danger mt-2">
                            The student has reached the maximum scholarship limit.
                        </div>
                        @endif
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
                    <!-- Course -->
                    <div class="col-md-6 position-relative mt-0">
                        <label class="form-label">Course</label>
                        <select class="form-select" id="selectedCourse" wire:model="selectedCourse">
                            <option selected>Select Course</option>
                            @foreach ($courses as $course)
                            <option value="{{ $course->course_id }}">{{ $course->course_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('selectedCourse')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Level -->
                    <div class="col-md-3 position-relative mt-0">
                        <label class="form-label">Year level</label>
                        <select name="level" id="level"
                            class="@error('level') is-invalid @enderror form-select form-select-md text-center"
                            wire:model="level">
                            <option selected>Select year level</option>
                            @foreach (['1','2','3','4','5','6'] as $yearLevel )
                            <option value="{{ $yearLevel }}">{{ $yearLevel }}</option>
                            @endforeach
                        </select>
                        @error('level')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    {{-- family --}}
                    <div class="row mb-4">
                        <p class="fw-bold fs-5">I. FAMILY INFORMATION</p>

                        <div class="col-md-6 position-relative mt-0">
                            <label class="form-label" for="father" name="father">Father's Full
                                name</label>
                            <input type="text" id="father"
                                class="form-control form-control-sm @error('father') is-invalid @enderror"
                                name="father" wire:model="father" />
                            @error('father')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-6 position-relative mt-0">
                            <label class="form-label" for="mother" name="mother">Mother's Full
                                name</label>
                            <input type="text" id="mother"
                                class="form-control form-control-sm @error('mother') is-invalid @enderror"
                                name="mother" wire:model="mother" />
                            @error('mother')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    {{-- end --}}


                    {{-- start --}}

                    <div class="row mt-2 mx-3 mb-3">
                        <div class="col-6 col-md-6 col-lg-6 mb-4">
                            <p class="fw-bold">Are you a recipient of any scholarship/grant?</p>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="yes" value="Yes"
                                    name="grant_status" wire:model="grant_status" wire:change="showHideFundSource">
                                <label class="form-check-label" for="yes">Yes</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="no" value="No" name="grant_status"
                                    wire:model="grant_status">
                                <label class="form-check-label" for="no">No</label>
                            </div>
                        </div>


                        <div class="row" wire:loading.remove>
                            @if ($grant_status === 'Yes')
                            <div class="col-12 col-md-6">
                                {{-- Scholarship 1 (Government Scholarship) --}}
                                <div class="mb-4">
                                    <h5>Scholarship 1 (Government Scholarship)</h5>
                                    <div class="grid col-6 col-md-12">
                                        <div class="mb-2">
                                            <label for="government_scholarship" class="mb-2">Government Scholarship
                                                Name</label>
                                            <select wire:model="selectedGovernmentScholarship"
                                                id="government_scholarship" class="form-select form-select-sm mb-2"
                                                @if ($selectedPrivateScholarship) disabled @endif>
                                                <option value="">Select Scholarship Name</option>
                                                @foreach ($governmentScholars as $governmentScholar)
                                                <option value="{{ $governmentScholar->id }}">{{
                                                    $governmentScholar->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-2 mt-2">
                                            <label for="government_fund_sources">Government Scholarship Fund
                                                Sources</label>
                                            <select id="government_fund_sources" class="form-select form-select-sm"
                                                wire:model="selectedGovernmentFundSources" @if ($selectedPrivateFundSources) disabled @endif>
                                                <option selected>Select Fund Source</option>
                                                @if ($selectedGovernmentScholarship)
                                                @foreach ($governmentScholars as $governmentScholar)
                                                @if ($governmentScholar->id == $selectedGovernmentScholarship)
                                                @foreach ($governmentScholar->fundsources as $fundSource)
                                                <option value="{{ $fundSource->source_id }}">{{
                                                    $fundSource->source_name }}</option>
                                                @endforeach
                                                @endif
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Scholarship 1 (Government Scholarship) --}}
                            </div>

                            <div class="col-12 col-md-6">
                                {{-- Scholarship 2 (Private Scholarship) --}}
                                <div class="mb-4">
                                    <h5>Scholarship 2 (Private Scholarship)</h5>
                                    <div class="mb-2">
                                        <label for="private_scholarship" class="mb-2">Private Scholarship
                                            Name</label>
                                        <select wire:model="selectedPrivateScholarship" id="private_scholarship"
                                            class="form-select form-select-sm mb-2" @if ($selectedGovernmentScholarship) disabled @endif>
                                            <option value="">Select Scholarship Name</option>
                                            @foreach ($privateScholars as $privateScholar)
                                            <option value="{{ $privateScholar->id }}">{{ $privateScholar->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('selectedPrivateScholarship') <span class="error">{{ $message
                                            }}</span> @enderror
                                    </div>

                                    <div class="mb-2 mt-2">
                                        <label for="private_fund_sources">Private Scholarship Fund Sources</label>
                                        <select id="private_fund_sources" class="form-select form-select-sm"
                                            wire:model="selectedPrivateFundSources" @if ($selectedGovernmentFundSources) disabled @endif>
                                            <option selected>Select Fund Source</option>
                                            @if ($selectedPrivateScholarship)
                                            @foreach ($privateScholars as $privateScholar)
                                            @if ($privateScholar->id == $selectedPrivateScholarship)
                                            @foreach ($privateScholar->fundsources as $fundSource)
                                            <option value="{{ $fundSource->source_id }}">{{ $fundSource->source_name
                                                }}</option>
                                            @endforeach
                                            @endif
                                            @endforeach
                                            @endif
                                        </select>
                                        @error('selectedPrivateFundSources') <span class="error">{{ $message
                                            }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- End Scholarship 2 (Private Scholarship) --}}
                            @endif
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 d-flex justify-content-center gap-4">
                                <button type="submit" wire:loading.attr='disabled'
                                    class="btn btn-success btn-md fw-bold text-dark mt-2">
                                    <i class="mdi mdi-content-save"></i>
                                    Update
                                </button>
                                <a type="button" class="btn btn-danger btn-md fw-bold text-dark mt-2"
                                    href="{{ route('admin.dashboard') }}">
                                    <i class="mdi mdi-close-circle"></i>
                                    Cancel
                                </a>
                            </div>
                            <div class="col-md-6">
                                {{-- Display success message --}}
                                @if (session()->has('success'))
                                <div class="alert alert-success text-center">
                                    {{ session('success') }}
                                </div>
                                @endif
                                @if (session()->has('error'))
                                <div class="alert alert-danger text-center">
                                    {{ session('error') }}
                                </div>
                                @endif
                                {{-- ends here --}}
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>



 $campuses = [
            ['campus_name' => 'NLUC', 'campusDesc' => 'Don Mariano Marcos Memorial State  University North La Union Campus'],
            ['campus_name' => 'MLUC', 'campusDesc' => 'Don Mariano Marcos Memorial State  University Mid La Union Campus'],
            ['campus_name' => 'SLUC', 'campusDesc' => 'Don Mariano Marcos Memorial State  University South La Union Campus'],
            ['campus_name' => 'OUS', 'campusDesc' => 'Don Mariano Marcos Memorial State  University Open University System'],
        ];

        DB::table('campuses')->insert($campuses);


         $courses =
        [
            ['course_name' => 'Bachelor of Science in Information System', 'campus_id' => 1],
            ['course_name' => 'Bachelor of Science in Information Technology', 'campus_id' => 2],
            ['course_name' => 'Bachelor of Science in Fish', 'campus_id' => 3],
            ['course_name' => 'Bachelor of Science in ML', 'campus_id' => 4],
        ];

        DB::table('courses')->insert($courses);
















        <div class="row mt-0 mb-1 justify-content-center">
                                <!-- Logo Column -->
                                <div class="col-12 col-md-6 col-lg-6 text-center">
                                    {{-- Add an additional div for the image and label --}}
                                    <div class="d-flex flex-column align-items-center">
                                        <img src="{{ asset('assets/images/updated.png') }}" class="img-fluid" style="width: 150px; height: 150px;" alt="dmmmsu-logo">
                                        <label class="form-check-label fw-bold mb-1" for="semester">Semester</label>
                                        <select class="form-select form-select-sm text-center mb-2 @error('semester') is-invalid @enderror" wire:model="semester">
                                            <option value="1" selected>1st</option>
                                            <option value="2">2nd</option>
                                        </select>
                                        @error('semester')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Add another column for the School Year select -->
                                <div class="col-12 col-md-6 col-lg-6 text-center">
                                    {{-- Add an additional div for the School Year select --}}
                                    <div class="d-flex flex-column align-items-center">
                                        <label class="form-check-label fw-bold mb-1" for="year">School Year</label>
                                        <select class="form-select form-select-sm text-center @error('year') is-invalid @enderror" wire:model="year">
                                            <option selected>Choose below...</option>
                                            <option value=""></option>
                                        </select>
                                        @error('year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>






{{-- Line chart --}}
<div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Students per Campus</h4>
                    <canvas id="student" width="300" height="200" class="p-2"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Line chart ends --}}

<script defer src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
 document.addEventListener('livewire:load', function () {
            // Get the chart data from Livewire component
            var chartData = @this.chartData;

            // Extract data for the chart
            var campuses = chartData.map(function (item) {
                return item.campus;
            });

            // Extract student counts for the chart
            var studentCounts = chartData.map(function (item) {
                return item.studentCount;
            });

            // Create a unique color for the chart line
            var chartColor = 'rgba(75, 192, 192, 1';

            var ctx = document.getElementById('student').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: campuses,
                    datasets: [
                        {
                            label: 'Students per Campus',
                            data: studentCounts,
                            borderColor: chartColor,
                            borderWidth: 2,
                            fill: false,
                        }
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Students'
                            }
                        }
                    }
                }
            });
        });
</script>





make a function for this//         public function generateReport()
        {
            // Validate the selectedYear and other fields if needed
            $this->validate([
                'selectedYear' => 'required',
            ]);

            // Fetch data based on the selected input fields
            $data = Student::query();

            if ($this->selectedProvince) {
                $data->where('province', $this->selectedProvince);
            }

            if ($this->selectedMunicipality) {
                $data->where('municipality', $this->selectedMunicipality);
            }

            if ($this->selectedBarangay) {
                $data->where('barangay', $this->selectedBarangay);
            }

            if ($this->selectedCampus) {
                $data->where('campus', $this->selectedCampus);
            }

            if ($this->semester) {
                $data->where('semester', $this->semester);
            }

            if ($this->selectedYear) {
                $data->where('school_year', $this->selectedYear);
            }

            // Add more conditions based on other input fields

            // Get the final result
            $data = $data->get();

            // Your logic to generate and export the Excel file using Maatwebsite Excel package
            Excel::create('students_report', function($excel) use ($data) {
                $excel->sheet('Sheet1', function($sheet) use ($data) {
                    $sheet->fromArray($data);
                });
            })->export('xlsx');

            // Optionally, you can add a success message
            session()->flash('success', 'Report generated successfully');


        } // without using this //composer require maatwebsite/excel
