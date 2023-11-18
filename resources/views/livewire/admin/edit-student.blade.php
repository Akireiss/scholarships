<div>
    <section class="p-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mb-1">Semester</label>
                                <select class="form-select form-select-sm">
                                    <option value="1">1st</option>
                                    <option value="2">2nd</option>
                                </select>
                            </div>


                            <div class="col-md-6">
                                <label class="mb-1">CAMPUS</label>
                                <select class="form-select form-select-sm" wire:model="selectedCampus">
                                    @if(auth()->user()->role === 1 || auth()->user()->role === 0 )
                                        <option value="" selected>Select Campus</option>
                                        {{-- @foreach($campuses as $campus)
                                            <option value="{{ $campus->id }}">{{ $campus->campusDesc }}</option>
                                        @endforeach --}}
                                    @elseif( auth()->user()->role === 2)
                                        <option value="NLUC">NLUC</option>
                                    @endif
                                </select>
                            </div>

                            <div class="row m-4">
                                <div class="col-md-3">
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
                                <div class="col-md-5" id="newInput"
                                    style="display: {{ $showNewInput ? 'block' : 'none' }}">
                                    <p><span class="text-danger">*</span>
                                        If new, indicate name of school last attended:
                                    </p>
                                    <input type="text" class="form-control form-control-sm" name="nameSchool"
                                        id="nameSchool" wire:model="nameSchool">
                                </div>
                                <div class="col-md-4" id="newInput"
                                    style="display: {{ $showNewInput ? 'block' : 'none' }}">
                                    <p><span class="text-danger">*</span>
                                        School year last attended:
                                    </p>
                                    <input type="text" class="form-control form-control-sm" name="lastYear"
                                        id="lastYear" wire:model="lastYear">
                                </div>
                            </div>
                            {{-- SCRIPT --}}
                            <script>
                                // Livewire component initialization
                                                Livewire.on('hideNewInput', () => {
                                                    document.getElementById('newInput').style.display = 'none';
                                                });

                                                Livewire.on('showNewInput', () => {
                                                    document.getElementById('newInput').style.display = 'block';
                                                });
                            </script>
                            {{-- SCRIPT END --}}

                            <div class="row m-2">
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

                            {{-- <div class="row">
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
                                        <option selected></option>
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
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
