<div>
    <section class="p-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    @if (session()->has('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="card-body shadow-lg">
                        <div class="container">
                                <div class="col-md-12 mb-2">
                                    <h2>Students Reports</h2>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Province</label>
                                            <select class="form-select form-select-sm" id="selectedProvince"
                                                name="selectedProvince" wire:model="selectedProvince">
                                                <option selected>Select Province</option>
                                                @foreach ($provinces as $province)
                                                <option value="{{ $province->provCode }}">{{ $province->provDesc }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">City / Municipality</label>
                                            <select class="form-select form-select-sm" id="selectedMunicipality"
                                                name="selectedMunicipality" wire:model="selectedMunicipality">
                                                <option selected>Select City / Municipality</option>
                                                @foreach ($municipalities as $municipality)
                                                <option value="{{ $municipality->citymunCode }}">{{
                                                    $municipality->citymunDesc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Barangay</label>
                                            <select class="form-select form-select-sm" name="selectedBarangay"
                                                id="selectedBarangay" wire:model='selectedBarangay'>
                                                <option selected>Select Barangay</option>
                                                @foreach ($barangays as $barangay)
                                                <option value="{{ $barangay->brgyCode }}">{{ $barangay->brgyDesc }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Campus</label>
                                            <select class="form-select form-select-sm" name="selectedCampus"
                                                id="selectedCampus" wire:model="selectedCampus">
                                                <option selected>Select Campus</option>
                                                @foreach ($campuses as $campus )
                                                <option value="{{ $campus->id }}">{{ $campus->campusDesc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Semester</label>
                                            <select class="form-select form-select-sm" name="semester" id="semester"
                                                name="semester" wire:model="semester">
                                                <option selected>Select Semester</option>
                                                <option value="1">1st</option>
                                                <option value="2">2nd</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">School year</label>
                                            <select class="form-select form-select-sm" id="year" name="year"
                                                wire:model="selectedYear">
                                                <option selected>School year</option>
                                                @foreach($years as $year)
                                                <option value="{{ $year->school_year }}">{{ $year->school_year }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('selectedYear')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 justify-content-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Scholarship Type</label>
                                        <select class="form-select form-select-md" wire:model="scholarship_type"
                                            wire:key="updatedScholarshipType">
                                            <option selected >School scholarship type</option>
                                            <option value="0">Government</option>
                                            <option value="1">Private</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Funds Source</label>
                                        <select class="form-select form-select-md" wire:model="source_funds">
                                            <option value="" selected>Select a fund source</option>
                                            @foreach($sourceFunds as $fund)
                                            <option value="{{ $fund->source_id }}">{{ $fund->source_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 text-start mt-4">
                                    <button type="button" class="btn btn-md btn-primary" wire:click="generateReport" wire:loading.attr="disabled">
                                        Generate Report
                                    </button>
                                    <span wire:loading class="text-dark fw-bold">Loading...</span>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <style>
        .btn-primary {
            background-color: blue;
            color: black;
        }
    </style>
</div>
