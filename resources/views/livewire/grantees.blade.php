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
                                            value="{{ $campus->id }}">
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
                                    <input type="text" id="lastname"
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
                                    <input type="text" id="firstname"
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
                                    <input type="text" id="initial"
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
                                    <label class="form-label">Provinve</label>
                                    <select class="form-select" aria-label="Default select example" name="province"
                                        id="province">
                                        <option value="" selected disabled>Select Province</option>
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
                                    <select class="form-select" aria-label="Default select example" name="municipal"
                                        id="municipal">
                                        <option value="" selected disabled>Select City</option>
                                    </select>
                                    @error('municipal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--  Barangay Address -->
                                <div class="col-md-4  position-relative mt-0">
                                    <label class="form-label">Barangay</label>
                                    <select class="form-select" aria-label="Default select example" name="barangay"
                                        id="barangay">
                                        <option value="" selected disabled>Select Barangay</option>
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
                                                type="radio" name="sex" id="male" value="male">
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('sex') is-invalid @enderror"
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
                                                type="radio" name="status" id="single" value="single">
                                            <label class="form-check-label" for="single">Single</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('status') is-invalid @enderror"
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
                                        name="contact" maxlength="11" minlength="11" />
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
                                        name="email" />
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
                                        name="student_id" maxlength="10" />
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
                                    <select name="level" id="level"
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
                                        <input class="form-check-input" type="radio" name="studentType"
                                            id="checkNew" value="new">
                                        <label class="form-check-label" for="checkNew">New</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="studentType"
                                            id="continuing" value="continuing">
                                        <label class="form-check-label" for="continuing">Continuing</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="studentType"
                                            id="return" value="return">
                                        <label class="form-check-label" for="return">Returning Student</label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 col-lg-6" id="newInput" style="display:none;">
                                    <p class="fw-bold fs-6">
                                        <span class="text-red m-auto">*</span>
                                        if NEW, indicate name of the school last attended:
                                        <input type="text" class="form-control form-control-sm" name="nameSchool"
                                            id="new">
                                    </p>
                                    <p class="fw-bold fs-6 mt-1">
                                        School year last attended:
                                        <input type="text" class="form-control form-control-sm" name="lastYear">
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
                                        <input class="form-check-input" type="checkbox" id="yes"
                                            value="yes" name="yes">
                                        <label class="form-check-label" for="yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="no"
                                            value="no">
                                        <label class="form-check-label" for="no">No</label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 col-lg-6" style="display:none;" id="grantNew">
                                    <p>
                                        If yes, write the complete name of the scholarship/grant and amount of stipend
                                        received per semester
                                    </p>
                                    <input type="text" class="form-control form-control-sm" name="grant"
                                        id="grant">
                                </div>
                            </div>

                            <script>
                                const yesCheckbox = document.getElementById('yes');
                                const grantNew = document.getElementById('grantNew');

                                yesCheckbox.addEventListener('change', function() {
                                    if (this.checked) {
                                        grantNew.style.display = 'block';
                                    } else {
                                        grantNew.style.display = 'none';
                                    }
                                });
                            </script>


                            {{-- recipient --}}


                            <div class="row">
                                <div class="col-12 col-md-12 mb-2">
                                    <label for="scholarship_name" class="mb-2">Scholarship Name</label>
                                    <select wire:model="scholarship_name" id="scholarship_name"
                                        class="form-control form-control-sm mb-2">
                                        {{-- <option value="">Select Scholarship Name</option> --}}
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
