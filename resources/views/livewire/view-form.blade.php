<div>

    <section class="mt-3 p-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body shadow-lg p-5">
                        <form wire:submit.prevent="submit">
                            @csrf
                            <div class="form-check">
                                <label for="type" class="mb-2 fw-bold">Scholarship Type</label>
                                <select wire:model="selectedType" id="scholarship_type" class="form-select mb-2">
                                    <option value="">Select Scholarship type</option>
                                    @foreach ($scholarshipTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-check">
                                <label for="scholarship_name" class="mb-2 fw-bold">Scholarship Name</label>
                                <select wire:model="selectedName" id="scholarship_name" class="form-select mb-2">
                                    <option value="">Select Scholarship Name</option>
                                    @foreach ($scholarshipNames as $name)
                                    <option value="{{ $name->id }}">{{ $name->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-check">
                                <label class="mb-2 fw-bold" for="fund_sources">Source of Funds</label>
                                <select wire:model="selectedSource" id="fund_sources" class="form-select mb-2">
                                    <option value="">Select Source of Funds</option>
                                    @foreach ($fundSources as $fundSource)
                                    <option value="{{ $fundSource->source_id }}">{{ $fundSource->source_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <button type="submit" class="btn btn-gradient-success text-dark fw-bold"
                                    wire:click="submit">View</button>
                                <span wire:loading wire:target="submit" class="mr-2 fs-6 fw-bold">Loading...</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
