<div>
    <section class="p-2">
        <div class="row p-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body shadow-lg">

                        <div class="col-md-3 position-relative mb-3">
                            <div class="input-group">
                                <label class="form-label" for="student_id">Student ID</label>
                                <input type="text" id="student_id" class="form-control form-control-sm"
                                       wire:model.lazy="student_id" name="student_id" maxlength="10" aria-describedby="studentIdHelp" />
                                <button type="button" class="btn btn-primary btn-sm" wire:click="studentSearch" wire:loading.attr="disabled">
                                    <i class="fas fa-search"></i>
                                </button>
                                @error('student_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <small id="studentIdHelp" class="form-text text-muted">Enter the 8-digit student ID.</small>
                            </div>
                        </div>

                        @if($noStudentRecord)
                        <div class="col-md-3 mt-3">
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                No record of the student. Please add the student below.
                                <button type="button" class="btn btn-sm btn-primary ms-auto" wire:click="redirectToAddStudent">
                                    <i class="fas fa-plus-circle"></i> Add Student
                                </button>
                            </div>
                        </div>
                        @endif



                        <div class="row">
                            <div class="col-6 col-md-6">
                                <label class="form-label" for="campus">CAMPUS</label>
                                <input class="form-control form-control-sm" type="text"
                                    wire:model="selectedCampus"  disabled >

                            </div>
                            <div class="col-6 col-md-6">
                                <label class="form-label" for="studentType">STUDENT TYPE</label>
                                <input class="form-control form-control-sm" type="text" wire:model="studentType"
                                 disabled  name="studentType">
                            </div>
                            <div class="col-3 col-md-3 col-lg-3 mx-3 my-3">
                                <p><span class="text-danger">*</span>
                                    If new, indicate name of school last attended:
                                </p>
                                <input type="text" class="form-control form-control-sm" name="nameSchool"
                                    id="nameSchool" wire:model="nameSchool" disabled >

                                <p class="mt-1"><span class="text-danger">*</span>
                                    School year last attended:
                                </p>
                                <input type="text" class="form-control form-control-sm" name="lastYear" id="lastYear"
                                    wire:model="lastYear" disabled >
                            </div>
                        </div>



                        <div class="row">
                            <p class="fw-bold fs-5">I. STUDENT INFORMATION</p>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label" for="lastname" name="lastname">Last name</label>
                                <input type="text" id="lastname" wire:model="lastname" disabled
                                    class="form-control form-control-sm " />
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label" for="firstname" name="firstname">First name</label>
                                <input type="text" id="firstname" class="form-control form-control-sm"
                                    wire:model="firstname" disabled  />
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label" for="initial" name="initial">Middle Initial</label>
                                <input type="text" id="initial" class="form-control form-control-sm"
                                    wire:model="initial" disabled  />
                            </div>
                        </div>

                        <div class="row">
                            <p class="mt-3 fw-bold fs-6">ADDRESS<span class="text-danger">*</span></p>

                            <!-- Province Address -->
                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label">Province</label>
                                <input type="text" class="form-control form-control-sm" wire:model="selectedProvince"
                                 disabled  />
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label">City/Municipality</label>
                                <input type="text" class="form-control form-control-sm"
                                    wire:model="selectedMunicipality" disabled  />
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label">Barangay</label>
                                <input type="text" class="form-control form-control-sm" wire:model="selectedBarangay"
                                 disabled  />
                            </div>
                        </div>






                        {{-- sex here --}}
                        <div class="row mx-3">
                            <div class="col-md-3 position-relative mt-3">
                                <label class="form-label" for="sex">Sex</label>
                                <input type="text" id="sex" class="form-control form-control-sm" wire:model="sex"
                                 disabled  />
                            </div>
                            <div class="col-md-3 position-relative mt-3">
                                <label class="form-label">Civil Status</label>
                                <input type="text" id="status" class="form-control form-control-sm" wire:model="status"
                                 disabled  />
                            </div>
                            <div class="col-md-3 position-relative mt-3">
                                <label class="form-label" for="contact">Contact
                                    Number</label>
                                <input type="text" id="contact" class="form-control form-control-sm"
                                    wire:model="contact" maxlength="11" minlength="11" disabled  />
                            </div>
                            <!-- Email -->
                            <div class="col-md-3 position-relative mt-3">
                                <label class="form-label" for="email">Email Address</label>
                                <input type="email" id="email" class="form-control form-control-sm" wire:model="email"
                                    name="email" disabled  />
                            </div>
                        </div>
                        {{-- sex end --}}



                        {{-- courses here --}}

                        <div class="row mt-3 mb-3">
                            <!-- Level -->
                            <div class="col-md-3 position-relative mt-0">
                                <label class="form-label">Year level</label>
                                <input type="text" name="level" id="level" class="form-control form-control-sm"
                                    wire:model="level" disabled >
                            </div>

                            <!-- Course -->
                            <div class="col-md-6 position-relative mt-0">
                                <label class="form-label">Course</label>
                                <input class="form-control form-control-sm" wire:model="selectedCourse"
                                 disabled  />
                            </div>
                        </div>



                        {{-- family --}}
                        <div class="row mb-4">
                            <p class="fw-bold fs-5">II. FAMILY INFORMATION</p>

                            <div class="col-md-6 position-relative mt-0">
                                <label class="form-label" for="father" name="father">Father's Full
                                    name</label>
                                <input type="text" id="father" class="form-control form-control-sm" name="father"
                                    wire:model="father" disabled  />
                            </div>

                            <div class="col-md-6 position-relative mt-0">
                                <label class="form-label" for="mother" name="mother">Mother's Full
                                    name</label>
                                <input type="text" id="mother" class="form-control form-control-sm" name="mother"
                                    wire:model="mother" disabled  />
                            </div>
                        </div>
                        {{-- end --}}

                        <form wire:submit.prevent="addSeach">

                            <p>add</p>

                            <div class="row align-items-start justify-content-start">
                                <div class="col-md-4">
                                    <label class="form-check-label fw-bold mb-1" for="semester">Semester</label>
                                    <select wire:model="semester" @if($semester) disabled @endif
                                        class="form-select form-select-sm mb-2">
                                        <option selected>Select semester</option>
                                        <option value="1">1st</option>
                                        <option value="2">2nd</option>

                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-check-label fw-bold mb-1" for="selectedYear">School Year</label>
                                    <select wire:model="school_year" @if($school_year) disabled @endif
                                        class="form-select form-select-sm">
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
                                        <div class="d-flex justify-content-center gap-5 ">
                                            <div class="grid col-6 col-md-6">
                                                <!-- Scholarship 1 -->
                                                <div class="mb-2 mt-2">
                                                    <label class="mb-2">Scholarship Type</label>
                                                    <select wire:model="selectedScholarshipType1" @if($selectedScholarshipType1) readonly @endif class="form-select form-select-sm mb-2">
                                                        <option value="" selected>Select Scholarship Type</option>
                                                        <option value="0" @if($selectedScholarshipType1 === 0) disabled @endif>Government</option>
                                                        <option value="1" @if($selectedScholarshipType1 === 1) disabled @endif>Private</option>
                                                    </select>
                                                </div>
                                                <div class="mb-2 mt-2">
                                                    <label class="mb-2">Fund Sources</label>
                                                    <select class="form-select form-select-sm"
                                                        wire:model="selectedfundsources1" @if($selectedfundsources1) disabled @endif>
                                                        <option value="" selected>Select Fund Source</option>
                                                        @foreach($fundSources1 as $source)
                                                        <option value="{{ $source->id }}">{{ $source->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- scholarship 2 --}}

                                            <div class="grid col-6 col-md-6">
                                                <!-- Scholarship 2 -->
                                                <div class="mb-2 mt-2">
                                                    <label class="mb-2">Scholarship Type</label>
                                                    <select wire:model="selectedScholarshipType2"
                                                        class="form-select form-select-sm mb-2"
                                                        @if($selectedScholarshipType2) disabled @endif>
                                                        <option selected>Select Scholarship Type</option>
                                                        <option value="0">Government</option>
                                                        <option value="1">Private</option>
                                                    </select>
                                                </div>
                                                <div class="mb-2 mt-2">
                                                    <label class="mb-2">Fund Sources</label>
                                                    <select class="form-select form-select-sm"
                                                        wire:model="selectedfundsources2" @if($selectedfundsources2)
                                                        disabled @endif>
                                                        <option selected>Select Fund Source</option>
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
                                            <button type="reset" class="btn btn-warning btn-sm fw-bold text-dark mt-2 btn-transparent">
                                                <i class="mdi mdi-close"></i>
                                                Reset
                                            </button>
                                            <button type="submit" wire:loading.attr='disabled' class="btn btn-success btn-sm fw-bold text-dark mt-2 btn-transparent">
                                                <i class="mdi mdi-content-save"></i>
                                                Save
                                            </button>
                                            <a type="button" class="btn btn-danger btn-sm fw-bold text-dark mt-2 btn-transparent" href="{{ route('admin.dashboard') }}">
                                                <i class="mdi mdi-close-circle"></i>
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>

                    {{-- forms end --}}


                </div>
            </div>
        </div>
</div>
</div>
</section>



<style>
    .btn-transparent {
        background-color: transparent;
        border: 1px solid; /* Add a border to maintain visibility */
        transition: background-color 0.2s ease-in-out; /* Smooth transition effect */
    }

    .btn-transparent:hover {
        background-color: inherit; /* Inherit the button's original background color */
    }
    .mdi-icon {
        font-size: 18px;
        vertical-align: middle;
    }

    .btn .mdi-icon {
        margin-right: 5px;
    }
    .add{
        background: rgb(245, 74, 74);
    }
</style>
</div>
