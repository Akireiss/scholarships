<div>

<section class="mt-3 p-5">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body shadow-lg">
                    <form wire:submit.prevent="submit">
                        <div class="form-check">
                            <label for="type" class="mb-2 fw-bold">Scholarship Type</label>
                            <select wire:model="scholarship_type" id="scholarship_type" class="form-select mb-2">
                                @foreach ($scholarshipTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-check">
                            <label for="scholarship_name" class="mb-2 fw-bold">Scholarship Name</label>
                            <select wire:model="scholarship_name" id="scholarship_name" class="form-select mb-2">
                                {{-- <option value="">Select Scholarship Name</option> --}}
                                @foreach ($scholarshipNames as $name)
                                    <option value="{{ $name->id }}">{{ $name->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-check">
                            <label class="mb-2 fw-bold" for="fund_sources">Source of Funds</label>
                            <select wire:model="fund_sources" id="fund_sources" class="form-select mb-2">
                                <option value="">Select Source of Funds</option>
                                @foreach ($fundSources as $fundSource)
                                    <option value="{{ $fundSource->source_id }}">{{ $fundSource->source_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <button type="submit" class="btn btn-gradient-success text-dark fw-bold">View</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</div>
