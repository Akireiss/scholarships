<div>
    <section class="mt-1 p-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <form wire:submit.prevent="saveStudent">
                            @csrf
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->has('error'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('error') }}
                                </div>
                            @endif
                            <!-- Campus -->
                            <div class="d-flex align-items-center">
                                <label for="campus" class="fw-bold fs-5 col-sm-2">CAMPUS:</label>
                                @foreach ($campuses as $campus)
                                    <div class="form-check form-check-inline col-sm-2">
                                        <input class="form-check-input campus-radio" type="radio"
                                            wire:model="selectedCampus" id="campus_{{ $campus->id }}"
                                            value="{{ $campus->id }}">
                                        <label class="form-check-label"
                                            for="campus_{{ $campus->id }}">{{ $campus->campus_name }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <hr>

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
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
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
                                            <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
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
                                            <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedBarangay')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                {{-- sex here --}}
                                <div class="row mx-3">
                                    <div class="col-md-6 position-relative mt-3">
                                        <div class="form-inline">
                                            <label for="sex" class="fw-bold mr-2">Sex:</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('sex') is-invalid @enderror"
                                                    type="radio" name="sex" id="male" value="male"
                                                    wire:model="sex">
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('sex') is-invalid @enderror"
                                                    type="radio" name="sex" id="female" value="female"
                                                    wire:model="sex">
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
                                                    wire:model="status">
                                                <label class="form-check-label" for="single">Single</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('status') is-invalid @enderror"
                                                    type="radio" name="status" id="married" value="married"
                                                    wire:model="status">
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
                                            wire:model="student_id" name="student_id" maxlength="10" />
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
                                    <!-- Course -->
                                    <div class="col-md-6 position-relative mt-0">
                                        <label class="form-label">Course</label>
                                        <select class="form-select" id="selectedCourse" wire:model="selectedCourse">
                                            <option value="">Select Course</option>
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


                                    <!-- Types of Students -->
                                    <div class="row mt-1 mx-3">
                                        <p class="fw-bold fs-5">Type of Student:</p>
                                        <div class="col-6 col-md-6 col-lg-6">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="studentType"
                                                    id="checkNew" value="new" wire:model="studentType"
                                                    wire:click="showNewInput">
                                                <label class="form-check-label" for="checkNew">New</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="studentType"
                                                    id="continuing" value="continuing" wire:model="studentType"
                                                    wire:click="hideNewInput">
                                                <label class="form-check-label" for="continuing">Continuing</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="studentType"
                                                    id="return" value="return" wire:model="studentType"
                                                    wire:click="hideNewInput">
                                                <label class="form-check-label" for="return">Returning
                                                    Student</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6 col-lg-6" id="newInput"
                                            style="display: {{ $showNewInput ? 'block' : 'none' }}">
                                            <p><span class="text-danger">*</span>
                                                If new, indicate name of school last attended:
                                            </p>
                                            <input type="text" class="form-control form-control-sm"
                                                name="nameSchool" id="nameSchool" wire:model.defer="nameSchool">

                                            <p class="fw-bold fs-6 mt-1">
                                                School year last attended:
                                            </p>
                                            <input type="text" class="form-control form-control-sm"
                                                name="lastYear" id="lastYear" wire:model.defer="lastYear">
                                        </div>
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


                                    <div class="row mt-2 mx-3 mb-3">
                                        <div class="col-6 col-md-6 col-lg-6">
                                            <p class="fw-bold">Are you a recipient of any scholarship/grant?</p>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="yes"
                                                    value="yes" name="grant_status" wire:model="grant_status">
                                                <label class="form-check-label" for="yes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="no"
                                                    value="no" name="grant_status" wire:model="grant_status">
                                                <label class="form-check-label" for="no">No</label>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-6 col-lg-6" id="grantNew">
                                            <p>
                                                If yes, write the complete name of the scholarship/grant and amount of
                                                stipend received per semester
                                            </p>
                                            <input type="text" class="form-control form-control-sm" name="grant"
                                                id="grant" wire:model.defer="grant">
                                        </div>
                                    </div>

                                    <script>
                                        const yesCheckbox = document.getElementById('yes');
                                        const noCheckbox = document.getElementById('no');
                                        const grantNew = document.getElementById('grantNew');

                                        // Function to show or hide the "grantNew" element based on the radio button selection
                                        function showHideGrantNew() {
                                            grantNew.style.display = yesCheckbox.checked ? 'block' : 'none';
                                        }

                                        // Add event listeners to both radio buttons
                                        yesCheckbox.addEventListener('change', showHideGrantNew);
                                        noCheckbox.addEventListener('change', showHideGrantNew);

                                        // Initially set the display based on the initial value of the grant_status property
                                        document.addEventListener("DOMContentLoaded", function() {
                                            showHideGrantNew();
                                        });
                                    </script>

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


                                    <div class="row">
                                        <div class="col-12 col-md-12 mb-2">
                                            <label for="scholarship_name" class="mb-2">Scholarship Name</label>
                                            <select wire:model="scholarship_name" id="scholarship_name"
                                                class="form-control form-control-sm mb-2">
                                                <option>Select Scholarship Name</option>
                                                @foreach ($scholarships as $scholarship)
                                                    <option value="{{ $scholarship->id }}">{{ $scholarship->name }} -
                                                        {{ $scholarship->scholarshipType->name }}</option>
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
                                                                        value="{{ $fundSource->source_id }}"
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
                                            class="btn btn-gradient-warning btn-fw fw-bold text-dark mt-2"
                                            wire:model="resetForm">Reset</button>
                                        <button type="submit"
                                            class="btn btn-gradient-success btn-fw fw-bold text-dark mt-2">Save</button>
                                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- forms end --}}
</div>
