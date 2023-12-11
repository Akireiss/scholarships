<div>
    <section class="p-2">
        <div class="row p-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body shadow-lg">

                        <form>
                            @csrf
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
                                    <input class="form-control form-control-sm" type="text" wire:model="selectedCampus"
                                        wire:model="selectedCampus">
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="studentType">STUDENT TYPE</label>
                                    <input class="form-control form-control-sm" type="text" wire:model="studentType"
                                        name="studentType" value="">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 mx-3 my-3">
                                    <p><span class="text-danger">*</span>
                                        If new, indicate name of school last attended:
                                    </p>
                                    <input type="text" class="form-control form-control-sm" name="nameSchool"
                                        id="nameSchool" wire:model="nameSchool">

                                    <p class="mt-1"><span class="text-danger">*</span>
                                        School year last attended:
                                    </p>
                                    <input type="text" class="form-control form-control-sm" name="lastYear"
                                        id="lastYear" wire:model="lastYear">
                                </div>
                            </div>



                            <div class="row">
                                <p class="fw-bold fs-5">I. STUDENT INFORMATION</p>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label" for="lastname" name="lastname">Last name</label>
                                    <input type="text" id="lastname" wire:model="lastname"
                                        class="form-control form-control-sm " />
                                </div>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label" for="firstname" name="firstname">First name</label>
                                    <input type="text" id="firstname" class="form-control form-control-sm"
                                        wire:model="firstname" />
                                </div>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label" for="initial" name="initial">Middle Initial</label>
                                    <input type="text" id="initial" class="form-control form-control-sm"
                                        wire:model="initial" />
                                </div>
                            </div>

                            <div class="row">
                                <p class="mt-3 fw-bold fs-6">ADDRESS<span class="text-danger">*</span></p>
                                <!-- Province Address -->
                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label">Province</label>
                                    <input type="text" class="form-control form-control-sm"
                                        wire:model="selectedProvince">
                                </div>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label">City/Municipality</label>
                                    <input type="text" class="form-control form-control-sm"
                                        wire:model="selectedMunicipality">
                                </div>

                                <!-- Barangay Address -->
                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label">Barangay</label>
                                    <input type="text" class="form-control form-control-sm"
                                        wire:model="selectedBarangay">
                                </div>
                            </div>



                            {{-- sex here --}}
                            <div class="row mx-3">
                                <div class="col-md-3 position-relative mt-3">
                                    <label class="form-label" for="sex">Sex</label>
                                    <input type="text" id="sex" class="form-control form-control-sm" wire:model="sex" />
                                </div>
                                <div class="col-md-3 position-relative mt-3">
                                    <label class="form-label" for="sex">Civil Status</label>
                                    <input type="text" id="status" class="form-control form-control-sm"
                                        wire:model="status" />
                                </div>
                                <div class="col-md-3 position-relative mt-3">
                                    <label class="form-label" for="contact">Contact
                                        Number</label>
                                    <input type="text" id="contact" class="form-control form-control-sm"
                                        wire:model="contact" maxlength="11" minlength="11" />
                                </div>
                                <!-- Email -->
                                <div class="col-md-3 position-relative mt-3">
                                    <label class="form-label" for="email">Email Address</label>
                                    <input type="email" id="email" class="form-control form-control-sm"
                                        wire:model="email" name="email" />
                                </div>
                            </div>
                            {{-- sex end --}}



                            {{-- courses here --}}

                            <div class="row mt-3 mb-3">
                                <!-- Level -->
                                <div class="col-md-3 position-relative mt-0">
                                    <label class="form-label">Year level</label>
                                    <input type="text" name="level" id="level" class="form-control form-control-sm"
                                        wire:model="level">
                                </div>

                                <!-- Course -->
                                <div class="col-md-6 position-relative mt-0">
                                    <label class="form-label">Course</label>
                                    <input class="form-select form-select-sm" wire:model="selectedCourse" />
                                </div>
                            </div>



                            {{-- family --}}
                            <div class="row mb-4">
                                <p class="fw-bold fs-5">II. FAMILY INFORMATION</p>

                                <div class="col-md-6 position-relative mt-0">
                                    <label class="form-label" for="father" name="father">Father's Full
                                        name</label>
                                    <input type="text" id="father" class="form-control form-control-sm" name="father"
                                        wire:model="father" />
                                </div>

                                <div class="col-md-6 position-relative mt-0">
                                    <label class="form-label" for="mother" name="mother">Mother's Full
                                        name</label>
                                    <input type="text" id="mother" class="form-control form-control-sm" name="mother"
                                        wire:model="mother" />
                                </div>
                            </div>
                            {{-- end --}}



                            @if($student->grantees->isNotEmpty())
                            {{-- display --}}
                            {{-- MAy karga --}}
                            @foreach ($student->grantees as $grantee)

                            <?php $grantees = $student->grantee->first(); ?>

                            <div class="row align-items-start justify-content-start">
                                <div class="col-md-4">
                                    <label class="form-check-label fw-bold mb-1" for="semester">Semester
                                    </label>
                                    <input class="form-control form-control-sm mb-2"
                                        value="{{ $grantees->semester }}" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-check-label fw-bold mb-1" for="selectedYear">School Year</label>
                                    <input class="form-control form-control-sm " value="{{ $grantees->school_year }}" />
                                </div>
                            </div>

                            {{-- start --}}
                            <div class="row mt-3 mx-5 mb-3">
                                <div class="row">
                                    <h3 class="text-start">Scholarships</h3>
                                    <div class="col-12 col-md-12">

                                        @if ($grantees->studentGrantee)

                                        <div class="d-flex justify-content-center gap-5 ">
                                            @foreach ($grantees->studentGrantee as $studentGrant)

                                            <div class="grid col-6 col-md-6">
                                                <!-- Scholarship 1 -->
                                                <div class="mb-2 mt-2">
                                                    <label for="scholarshipType1" class="mb-2">Scholarship Type</label>
                                                    <select wire:model="selectedScholarshipType1" id="scholarshipType1"
                                                        class="form-select form-select-sm mb-2" >
                                                        <option value="{{ $studentGrant->scholarship_type }}"
                                                            @if($studentGrant->scholarship_type) disabled @endif></option>
                                                        <option value="">Select Scholarship Type</option>
                                                        <option value="0">Government</option>
                                                        <option value="1">Private</option>
                                                    </select>


                                                    <input class="form-control form-control-sm "
                                                        value="{{ $studentGrant->scholarship_type }}"
                                                        @if($studentGrant->scholarship_type) disabled @endif />
                                                    </select>
                                                </div>
                                                <div class="mb-2 mt-2">
                                                    <label for="fund_sources1">Fund Sources</label>
                                                    <input class="form-control form-control-sm "
                                                        value="{{ $studentGrant->scholarship_name }}"
                                                        @if($studentGrant->scholarship_name) disabled @endif />
                                                </div>
                                            </div>

                                            @endforeach
                                        </div>
                                        @else
                                        "No Data"
                                        @endif
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
                                            {{-- ends here --}}
                                        </div>
                                    </div>
                                    @endforeach





                                </div>
                            </div>
                    </div>
                    @else
                    {{-- han nga empty --}}
                    {{-- add --}}
                    <div class="row align-items-start justify-content-start">
                        <div class="col-md-4">
                            <label class="form-check-label fw-bold mb-1" for="semester">Semester</label>
                            <select class="form-select form-select-sm mb-2 @error('semester') is-invalid @enderror"
                                wire:model="semester">
                                <option selected>Choose semester</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                            </select>
                            @error('semester')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-check-label fw-bold mb-1" for="selectedYear">School Year</label>
                            <select class="form-select form-select-sm @error('selectedYear') is-invalid @enderror"
                                wire:model="selectedYear">
                                <option selected>Choose below...</option>
                                @foreach($years as $year)
                                <option value="{{ $year->school_year }}">{{ $year->school_year }}</option>
                                @endforeach
                            </select>
                            @error('selectedYear')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    {{-- start --}}
                    <div class="row mt-3 mx-5 mb-3">
                        <div class="row">
                            <h3 class="text-start">Scholarships</h3>
                            <div class="col-12 col-md-6">

                                <div class="mb-4">
                                    <div class="grid col-6 col-md-12">
                                        <!-- Scholarship 1 -->
                                        <div class="mb-2 mt-2">
                                            <label for="scholarshipType1" class="mb-2">Scholarship Type</label>
                                            <select wire:model="selectedScholarshipType1" id="scholarshipType1"
                                                class="form-select form-select-sm mb-2">
                                                <option value="">Select Scholarship Type</option>
                                                <option value="0">Government</option>
                                                <option value="1">Private</option>
                                            </select>
                                        </div>
                                        <div class="mb-2 mt-2">
                                            <label for="fund_sources1">Fund Sources</label>
                                            <select id="fund_sources1" class="form-select form-select-sm"
                                                wire:model="selectedfundsources1">
                                                <option value="none" selected>Select Fund Source</option>
                                                @foreach($fundSources1 as $source)
                                                <option value="{{ $source->id }}">{{ $source->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Scholarship 1 (Government Scholarship) --}}
                            </div>

                            <div class="col-12 col-md-6">
                                {{-- Scholarship 2 (Private Scholarship) --}}
                                <div class="mb-4">
                                    <!-- Scholarship 2 -->
                                    <div class="mb-2 mt-2">
                                        <label for="scholarshipType2" class="mb-2">Scholarship Type</label>
                                        <select wire:model="selectedScholarshipType2" id="scholarshipType2"
                                            class="form-select form-select-sm mb-2">
                                            <option value="">Select Scholarship Type</option>
                                            <option value="0">Government</option>
                                            <option value="1">Private</option>
                                        </select>
                                    </div>

                                    <div class="mb-2 mt-2">
                                        <label for="fund_sources2">Fund Sources</label>
                                        <select id="fund_sources2" class="form-select form-select-sm"
                                            wire:model="selectedfund2sources2">
                                            <option selected>Select Fund Source</option>
                                            @foreach($fundSources2 as $source)
                                            <option value="{{ $source->id }}">{{ $source->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- End Scholarship 2 (Private Scholarship) --}}
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
                                        {{-- ends here --}}
                                    </div>
                                </div>






                            </div>
                        </div>
                    </div>

                    <div>
                    </div>
                    @endif


                    </form>


                </div>
            </div>
        </div>
</div>
</div>
</section>



{{-- forms end --}}
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
