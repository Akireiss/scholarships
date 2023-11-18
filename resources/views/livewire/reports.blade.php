<div>
    <section class="p-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <form>
                            <div class="container">
                                <div class="col-md-6 mb-2">
                                    <h2>Students Reports</h2>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Province</label>
                                        <select class="form-select form-select-sm" id="selectedProvince"
                                            name="selectedProvince" wire:model="selectedProvince">
                                            <option selected>Select Province</option>
                                            @foreach ($provinces as $province)
                                            <option value="{{ $province->provCode }}">{{ $province->provDesc }}</option>
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
                                            <option value="{{ $barangay->brgyCode }}">{{ $barangay->brgyDesc }}</option>
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
                                        <select class="form-select form-select-sm" name="semester" id="semester">
                                            <option selected>Select Semester</option>
                                            <option value="1">1st</option>
                                            <option value="2">2nd</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">School year</label>
                                        <select class="form-select form-select-sm" id="year" name="year"
                                            wire:model="selectedYear" required>
                                            <option selected>School year</option>
                                            @foreach($years as $year)
                                            <option value="{{ $year->id }}">{{ $year->school_year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="form-label">Scholarship Type</label>
                                    <select class="form-select form-select-md" id="scholarship_type"
                                        name="scholarship_type" wire:model="scholarship_type">
                                        <option selected>School scholarship type</option>
                                        @foreach($scholarshipTypes as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Funds Source</label>
                                    <select class="form-select form-select-md" id="source_funds" name="source_funds"
                                        wire:model="source_funds">
                                        <option selected>School fund source</option>
                                        @foreach($fundsSources as $source)
                                        <option value="{{ $source->id }}">{{ $source->source_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 text-center mt-4">
                                {{-- <button type="submit" class="btn btn-sm btn-primary">Save</button> --}}
                                <button type="button" class="btn btn-sm btn-primary" id="generateReportButton">Generate
                                    Report</button>
                            </div>

                        </form>
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
