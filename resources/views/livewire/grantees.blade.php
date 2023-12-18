<div>
    <section class="p-2">
        <div class="row p-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body shadow-lg">



                        <!-- Student ID -->
                        <div class="col-md-3 position-relative mt-0 mb-3">
                            <label class="form-label" for="student_id">Student ID</label>
                            <input type="tel" id="student_id"
                                class="form-control form-control-sm @error('student_id') is-invalid @enderror"
                                wire:model="student_id" name="student_id" maxlength="10" />
                            @error('student_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6 col-md-6">
                                <label class="form-label" for="campus">CAMPUS</label>
                                <input class="form-control form-control-sm" type="text"
                                    value="{{ $selectedCampus ? $selectedCampus->campusDesc : '' }}"
                                    @if($selectedCampus) disabled @endif>

                            </div>
                            <div class="col-6 col-md-6">
                                <label class="form-label" for="studentType">STUDENT TYPE</label>
                                <input class="form-control form-control-sm" type="text" wire:model="studentType" @if($studentType) disabled @endif
                                    name="studentType">
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mx-3 my-3">
                                <p><span class="text-danger">*</span>
                                    If new, indicate name of school last attended:
                                </p>
                                <input type="text" class="form-control form-control-sm" name="nameSchool"
                                    id="nameSchool" wire:model="nameSchool" @if($nameSchool) disabled @endif>

                                <p class="mt-1"><span class="text-danger">*</span>
                                    School year last attended:
                                </p>
                                <input type="text" class="form-control form-control-sm" name="lastYear" id="lastYear"
                                    wire:model="lastYear" @if($lastYear) disabled @endif>
                            </div>
                        </div>



                        <div class="row">
                            <p class="fw-bold fs-5">I. STUDENT INFORMATION</p>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label" for="lastname" name="lastname">Last name</label>
                                <input type="text" id="lastname" wire:model="lastname" @if($lastname) disabled @endif
                                    class="form-control form-control-sm " />
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label" for="firstname" name="firstname">First name</label>
                                <input type="text" id="firstname" class="form-control form-control-sm"
                                    wire:model="firstname" @if($firstname) disabled @endif/>
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label" for="initial" name="initial">Middle Initial</label>
                                <input type="text" id="initial" class="form-control form-control-sm"
                                    wire:model="initial" @if($initial) disabled @endif />
                            </div>
                        </div>

                        <div class="row">
                            <p class="mt-3 fw-bold fs-6">ADDRESS<span class="text-danger">*</span></p>

                            <!-- Province Address -->
                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label">Province</label>
                                <input type="text" class="form-control form-control-sm"
                                    value="{{ $selectedProvince ? $selectedProvince->provDesc : 'No Data' }}"
                                    @if($selectedProvince) disabled @endif >
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label">City/Municipality</label>
                                <input type="text" class="form-control form-control-sm"
                                    value="{{ $selectedMunicipality ? $selectedMunicipality->citymunDesc : 'No Data' }}">
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label">Barangay</label>
                                <input type="text" class="form-control form-control-sm"
                                    value="{{ $selectedBarangay ? $selectedBarangay->brgyDesc : 'No Data' }}">
                            </div>

                        </div>






                        {{-- sex here --}}
                        <div class="row mx-3">
                            <div class="col-md-3 position-relative mt-3">
                                <label class="form-label" for="sex">Sex</label>
                                <input type="text" id="sex" class="form-control form-control-sm" wire:model="sex" @if($sex) disabled @endif />
                            </div>
                            <div class="col-md-3 position-relative mt-3">
                                <label class="form-label">Civil Status</label>
                                <input type="text" id="status" class="form-control form-control-sm"
                                    wire:model="status" @if($status) disabled @endif />
                            </div>
                            <div class="col-md-3 position-relative mt-3">
                                <label class="form-label" for="contact">Contact
                                    Number</label>
                                <input type="text" id="contact" class="form-control form-control-sm"
                                    wire:model="contact" maxlength="11" minlength="11" @if($contact) disabled @endif />
                            </div>
                            <!-- Email -->
                            <div class="col-md-3 position-relative mt-3">
                                <label class="form-label" for="email">Email Address</label>
                                <input type="email" id="email" class="form-control form-control-sm" wire:model="email"
                                    name="email" @if($email) disabled @endif />
                            </div>
                        </div>
                        {{-- sex end --}}



                        {{-- courses here --}}

                        <div class="row mt-3 mb-3">
                            <!-- Level -->
                            <div class="col-md-3 position-relative mt-0">
                                <label class="form-label">Year level</label>
                                <input type="text" name="level" id="level" class="form-control form-control-sm"
                                    wire:model="level" @if($level) disabled @endif>
                            </div>

                            <!-- Course -->
                            <div class="col-md-6 position-relative mt-0">
                                <label class="form-label">Course</label>
                                <input class="form-control form-control-sm"
                                    value="{{ $selectedCourse ? $selectedCourse->course_name : ''}}"
                                    @if($selectedCourse) disabled @endif />
                            </div>
                        </div>



                        {{-- family --}}
                        <div class="row mb-4">
                            <p class="fw-bold fs-5">II. FAMILY INFORMATION</p>

                            <div class="col-md-6 position-relative mt-0">
                                <label class="form-label" for="father" name="father">Father's Full
                                    name</label>
                                <input type="text" id="father" class="form-control form-control-sm" name="father"
                                    wire:model="father" @if($father) disabled @endif />
                            </div>

                            <div class="col-md-6 position-relative mt-0">
                                <label class="form-label" for="mother" name="mother">Mother's Full
                                    name</label>
                                <input type="text" id="mother" class="form-control form-control-sm" name="mother"
                                    wire:model="mother" @if($mother) disabled @endif />
                            </div>
                        </div>
                        {{-- end --}}



                        <!-- Assuming this is within a Livewire component view -->
<form wire:submit.prevent="updateGrantee">
    @csrf

    @if($student->grantees->isNotEmpty())
        <p>Update</p>
        @foreach($student->grantees as $grantee)
        <div class="row align-items-start justify-content-start">
            <div class="col-md-4">
                <label class="form-check-label fw-bold mb-1" for="semester">Semester</label>
                <input wire:model="semester" value="{{ $grantee->semester }}" class="form-select form-select-sm mb-2" @if($grantee->semester) disabled @endif />
            </div>
            <div class="col-md-4">
                <label class="form-check-label fw-bold mb-1" for="Year">School Year</label>
                <select wire:model="school_year_{{ $grantee->id }}" class="form-select form-select-sm" @if($grantee->school_year) disabled @endif>
                    <option value="{{ $grantee->school_year }}" selected>{{ $grantee->school_year }}</option>
                </select>
            </div>
        </div>

            <!-- Scholarships Section -->
            <div class="row mt-3 mx-5 mb-3">
                <div class="col-md-12">
                    <h3 class="text-start">Scholarships</h3>

                    @if($grantee->studentGrantee->isNotEmpty())
                        <div class="d-flex justify-content-center gap-5">
                            @foreach($grantee->studentGrantee as $studentGrant)
            <div class="grid col-6 col-md-6">
                <!-- Scholarship 1 -->
                <div class="mb-2 mt-2">
                    <label for="scholarshipType" class="mb-2">Scholarship Type</label>
                    <select wire:model="selectedScholarshipType1" id="scholarshipType" class="form-select form-select-sm mb-2" @if($studentGrant->scholarship_type) disabled @endif>
                        <option value="{{ $studentGrant->scholarship_type }}">
                            {{ $studentGrant->scholarship_type ? ($studentGrant->scholarship_type == 0 ? 'Government' : 'Private') : 'Select Scholarship Type' }}
                        </option>
                        <option value="0">Government</option>
                        <option value="1">Private</option>
                    </select>
                </div>
                
                <div class="mb-2 mt-2">
                    <label for="fund_sources">Fund Sources</label>
                    <select id="fund_sources" class="form-select form-select-sm" wire:model="selectedfundsources1" @if($studentGrant->scholarship_name) disabled @endif>
                        <option value="{{ $studentGrant->scholarship_name }}">{{ $studentGrant->scholarship_name ?: 'Select Fund Source' }}</option>
                        @foreach($fundSources1 as $source)
                            <option value="{{ $source->id }}">{{ $source->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach
                        </div>
                    @else
                        <p>No Data</p>
                    @endif
                </div>

                <!-- Buttons Section -->
                <div class="row mt-3">
                    <div class="col-md-6 d-flex justify-content-end gap-4">
                        <button type="reset" class="btn btn-warning btn-sm fw-bold text-dark mt-2">
                            <i class="mdi mdi-close"></i>
                            Reset
                        </button>
                        <button type="submit" wire:loading.attr='disabled' class="btn btn-success btn-sm fw-bold text-dark mt-2">
                            <i class="mdi mdi-content-save"></i>
                            Save
                        </button>
                        <a type="button" class="btn btn-danger btn-sm fw-bold text-dark mt-2" href="{{ route('admin.dashboard') }}">
                            <i class="mdi mdi-close-circle"></i>
                            Cancel
                        </a>
                    </div>
                    <div class="col-md-6">
                        {{-- Display success or error messages --}}
                        @if(session()->has('success'))
                            <div class="alert alert-success text-center">{{ session('success') }}</div>
                        @endif
                        @if(session()->has('error'))
                            <div class="alert alert-danger text-center">{{ session('error') }}</div>
                        @endif
                    </div>
                </div>
            </div>
</form>

                    @endforeach
                    @else

                    <form wire:submit="addGrantee">
                        @csrf
                        <p>add</p>

                        <div class="row align-items-start justify-content-start">
                            <div class="col-md-4">
                                <label class="form-check-label fw-bold mb-1" for="semester">Semester</label>
                                <select wire:model="save_semester" class="form-select form-select-sm mb-2">
                                    <option selected>Select semester</option>
                                    <option value="0">1st</option>
                                    <option value="1">2nd</option>

                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-check-label fw-bold mb-1" for="selectedYear">School Year</label>
                                <select wire:model="save_school_year" class="form-select form-select-sm">
                                    <option selected>Select school year</option>
                                    @foreach ( $years as $year )
                                    <option value="{{ $year->school_year }}">{{ $year->school_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Start --}}
                        <div class="row mt-3 mx-5 mb-3">
                            <div class="row">
                                <h3 class="text-start">Scholarships</h3>
                                <div class="col-12 col-md-12">
                                    <div class="d-flex justify-content-center gap-5">
                                        <div class="grid col-6 col-md-6">
                                            <!-- Scholarship 2 -->
                                            <div class="mb-2 mt-2">
                                                <label for="scholarshipType1" class="mb-2">Scholarship Type</label>
                                                <select wire:model="save_selectedScholarshipType1" id="scholarshipType1" class="form-select form-select-sm mb-2">
                                                    <option selected>Select Scholarship Type</option>
                                                    <option value="0">Government</option>
                                                    <option value="1">Private</option>
                                                </select>
                                            </div>
                                            <div class="mb-2 mt-2">
                                                <label for="fund_sources1">Fund Sources</label>
                                                <select id="save_fund_sources1" class="form-select form-select-sm" wire:model="save_selectedfundsources1">
                                                    <option selected> Select Fund Source </option>
                                                    @foreach($fundSources1 as $source)
                                                        <option value="{{ $source->id }}">{{ $source->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                        {{-- scholarship 2 --}}

                                        <div class="grid col-6 col-md-6">
                                            <!-- Scholarship 1 -->
                                            <div class="mb-2 mt-2">
                                                <label for="scholarshipType2" class="mb-2">Scholarship Type</label>
                                                <select wire:model="save_selectedScholarshipType2" id="scholarshipType2"
                                                    class="form-select form-select-sm mb-2">
                                                    <option selected>Select Scholarship Type</option>
                                                    <option value="0">Government</option>
                                                    <option value="1">Private</option>
                                                </select>
                                            </div>
                                            <div class="mb-2 mt-2">
                                                <label for="fund_sources2">Fund Sources</label>
                                                <select id="fund_sources2" class="form-select form-select-sm"
                                                    wire:model="save_selectedfundsources2">
                                                    <option selected> Select Fund Source </option>
                                                    @foreach($fundSources2 as $source)
                                                    <option value="{{ $source->id }}">{{ $source->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6 d-flex justify-content-end gap-4">
                                        <button type="reset" class="btn btn-warning btn-sm fw-bold text-dark mt-2">
                                            <i class="mdi mdi-close"></i>
                                            Reset
                                        </button>
                                        <button type="submit" wire:loading.attr='disabled'
                                            class="btn btn-success btn-sm fw-bold text-dark mt-2">
                                            <i class="mdi mdi-content-save"></i>
                                            Save
                                        </button>
                                        <a type="button" class="btn btn-danger btn-sm fw-bold text-dark mt-2"
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
                                        {{-- Ends here --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
                @endif
                {{-- forms end --}}


            </div>
        </div>
</div>
</div>
</div>
</section>



<style>
    .mdi-icon {
        font-size: 18px;
        vertical-align: middle;
    }

    .btn .mdi-icon {
        margin-right: 5px;
    }
</style>
</div>
