
<div>
    <section class="mt-3 p-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body shadow-lg">
                            @if ($successMessage)
                                <div class="alert alert-success mt-3" wire:offline.remove>
                                    {{ $successMessage }}
                                </div>
                            @endif
                            @if ($errorMessage)
                                <div class="alert alert-danger mt-3" wire:offline.remove>
                                    {{ $errorMessage }}
                                </div>
                            @endif
                        <form wire:submit.prevent="submit">
                            <div class="form-check">
                                <label for="scholarship_type_id" class="mb-2 fw-bold">Scholarship Type</label>
                                <select wire:model="scholarship_type_id" id="scholarship_type_id" class="form-select mb-2">
                                    <option value="">Select Scholarship Type</option>
                                    @foreach ($scholarshipTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-check">
                                <label for="scholarship_name" class="mb-2 fw-bold">Scholarship Name</label>
                                <input class="form-control form-control-md mb-2" type="text" wire:model="scholarship_name" id="scholarship_name">
                            </div>
                            <div class="form-check">
                                <label class="mb-2 fw-bold" for="fund_sources">Source of Funds</label>
                                <input type="text" wire:model="fund_sources" id="fund_sources" class="form-control form-control-md mb-2">
                            </div>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <button type="submit" class="btn btn-gradient-success text-dark fw-bold">ADD</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
