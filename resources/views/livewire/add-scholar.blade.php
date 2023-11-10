<div>
    <section class="mt-2 p-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="d-flex align-items-start justify-content-start mb-2 gap-2">
                        <!-- Add Button -->
                        <a class="btn btn-sm btn-success text-dark" href="{{ route('admin.settings.addScholar') }}">
                            Add
                        <i class="mdi mdi-library-plus mdi-20"></i>
                        </a>
                        <!-- Cancel Button -->
                        <a class="btn btn-sm btn-danger text-dark"
                            href="{{ route('admin.dashboard') }}">
                            Cancel
                            <i class="mdi mdi-close-circle mdi-20"></i></a>
                    </div>
                    <div class="card-body shadow-lg">

                        <livewire:scholarship-name-table/>
                        {{-- @if ($successMessage)
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
                                <select wire:model="scholarship_type_id" id="scholarship_type_id"
                                    class="form-select mb-2">
                                    <option value="">Select Scholarship Type</option>
                                    @foreach ($scholarshipTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-check">
                                <label for="scholarship_name" class="mb-2 fw-bold">Scholarship Name <font class="text-danger">*</font></label>
                                <input class="form-control form-control-md mb-2" type="text"
                                    wire:model="scholarship_name" id="scholarship_name">
                                    <p class="text-danger">Required</p>
                            </div>
                            <div class="form-check">
                                <label class="mb-2 fw-bold" for="fund_sources">Source of Funds <font class="text-danger">*</font></label>
                                <input type="text" wire:model="fund_sources" id="fund_sources"
                                    class="form-control form-control-md mb-2">
                                    <p class="text-danger">Required</p>
                            </div>
                            <div class="float-end mt-2 gap-2">
                                <button type="submit" class="btn btn-success btn-sm text-dark fw-bold">ADD</button>
                                <a type="button" class="btn btn-danger btn-sm fw-bold text-dark" href="{{ route('admin.dashboard') }}">Cancel</a>
                            </div>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
