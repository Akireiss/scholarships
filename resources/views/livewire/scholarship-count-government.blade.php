<div>

    <div class="row">
        <div class="col-md-6 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <div class="filter d-flex justify-content-end position-relative">
                        <div class="dropdown">
                            <a class="icon" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal toggle-options"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownMenuLink"
                                style="position: absolute; right:0; top:-80px; cursor: pointer; max-width:5rem; padding:0;">
                                <a class="dropdown-item" wire:click="$set('selectedType', 'Government')">Government</a>
                                <a class="dropdown-item" wire:click="$set('selectedType', 'Private')">Private</a>
                            </div>
                        </div>
                    </div>
                    <h2 class="font-weight-normal mb-3">
                        <i class="mdi mdi-book-open-page-variant mdi-50px"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Total Scholarships of {{ $selectedType }}</span></h4>
                    <h5 class="card-text">
                        {{ $selectedType === 'Government' ? $governmentCount : ($selectedType === 'Private' ?
                        $privateCount : '0') }}
                    </h5>
                </div>
            </div>
        </div>


        <div class="col-md-6 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <div class="filter d-flex justify-content-end position-relative">
                        <div class="dropdown">
                            <a class="icon" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal toggle-options"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownMenuLink"
                                style="position: absolute; right:0; top:-80px; cursor: pointer; max-width:5rem; padding:0;">
                                <a class="dropdown-item" wire:click="$set('selectedTypeScholar', 'Government')">Government</a>
                                <a class="dropdown-item" wire:click="$set('selectedTypeScholar', 'Private')">Private</a>
                            </div>
                        </div>
                    </div>
                    <h2 class="font-weight-normal mb-3">
                        <i class="mdi mdi-book-open-page-variant mdi-50px"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Total of Scholars in {{ $selectedTypeScholar }}</span></h4>
                    <h5 class="card-text">
                        {{ $selectedTypeScholar === 'Government' ? $governmentScholar : ($selectedTypeScholar === 'Private' ?
                        $privateScholar : '0') }}
                    </h5>
                </div>
            </div>
        </div>

    </div>
