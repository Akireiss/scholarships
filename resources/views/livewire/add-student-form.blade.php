<div>
    <section class="mt-2 p-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="text-align: center; font-size:25px; font-weight: bold;">
                        Student Data
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="saveStudent">
                            <div class="row">
                                <div class="col-md-3 position-relative mt-0 mb-2">
                                    <label class="form-label" for="student_id">Student ID</label>
                                    <input type="text" id="student_id"
                                        class="form-control form-control-sm @error('student_id') is-invalid @enderror"
                                        wire:model="student_id" name="student_id" maxlength="10" />
                                    @error('student_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    {{-- @if ($scholarshipLimitExceeded)
                                    <div class="alert alert-danger mt-2">
                                        The student has reached the maximum scholarship limit.
                                    </div>
                                    @endif --}}
                                </div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function()
                                        {
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
                            <div class="form-group mt-2">
                                <label class="fw-bold fs-5 col-sm">CAMPUS:</label>
                                <div class="row align-items-center">
                                    @foreach ($campuses as $campus)
                                    <div class="col-sm-2 m-0">
                                        <label class="campus-label" for="campus_{{ $campus->id }}">
                                            <input class="form-check-input campus-radio" type="radio"
                                                wire:model="selectedCampus" value="{{ $campus->id }}"
                                                id="campus_{{ $campus->id }}">
                                            {{ $campus->campus_name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            {{-- student type --}}
                            <div class="row mt-2 mb-3 mx-2">
                                <p class="fw-bold fs-6 m-0">STUDENT TYPE</p>
                                <div class="col-md-4" style="margin-inline-start: 20px;">
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

                            <div class="col-md-4 mx-3 my-1" id="newInput"
                                style="display: {{ $showNewInput ? 'block' : 'none' }}">
                                <p><span class="text-danger">*</span>
                                    If new, indicate name of school last attended:
                                </p>
                                <input type="text" class="form-control form-control-sm" name="nameSchool"
                                    id="nameSchool">

                                <p class="mt-1"><span class="text-danger">*</span>
                                    School year last attended:
                                </p>
                                <input type="text" class="form-control form-control-sm" name="lastYear" id="lastYear"
                                    wire:model.defer="lastYear">
                            </div>

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
                                            }}
                                        </option>
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
                                <div class="col-md-3 position-relative mt-3">
                                    <div class="form-inline">
                                        <label for="sex" class="fw-light">Sex:</label>
                                        <div class="form-check form-check-inline">
                                            @foreach (['Male', 'Female'] as $sex )
                                            <input class="form-check-input @error('sex') is-invalid @enderror"
                                                type="radio" id="{{ $sex }}" value="{{ $sex }}" wire:model="sex">
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
                                <div class="col-md-3 position-relative mt-3">
                                    <div class="form-inline">
                                        <label for="status" class="fw-light mr-2">Civil Status:</label>
                                        <div class="form-check form-check-inline">
                                            @foreach (['Single', 'Married'] as $cs )
                                            <input class="form-check-input @error('status') is-invalid @enderror"
                                                type="radio" id="{{ $cs }}" value="{{ $cs }}" wire:model="status">
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
                                <div class="col-md-3 position-relative mt-3">
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
                                <div class="col-md-3 position-relative mt-3">
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
                            </div>
                            {{-- sex end --}}
                            <div class="row mt-2 mb-2">
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
                            </div>
                            {{-- family --}}
                            <div class="row mb-4">
                                <p class="fw-bold fs-5">II. FAMILY INFORMATION</p>

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
                            <div class="row mt-3">
                                <div class="col-md-6 d-flex justify-content-center gap-4">
                                    <button type="reset" class="btn btn-warning btn-md fw-bold text-dark mt-2">
                                        <i class="mdi mdi-close"></i>
                                        Reset
                                    </button>
                                    <button type="submit" wire:loading.attr='disabled'
                                        class="btn btn-success btn-md fw-bold text-dark mt-2">
                                        <i class="mdi mdi-content-save"></i>
                                        Save
                                    </button>
                                    <a type="button" class="btn btn-danger btn-md fw-bold text-dark mt-2"
                                        href="{{ route('admin.student') }}">
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
    <style>
        .campus-label {
            display: inline-flex;
            align-items: center;
            margin-right: 15px;
        }

        .campus-radio {
            margin-right: 5px;
        }

        .mdi-icon {
            font-size: 18px;
            vertical-align: middle;
        }

        .btn .mdi-icon {
            margin-right: 5px;
        }
    </style>
</div>
