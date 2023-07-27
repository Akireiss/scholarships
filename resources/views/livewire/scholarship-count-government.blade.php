<div>

<div class="row">
    <div class="col-md-6 stretch-card grid-margin">
        <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
            <div class="card-body">
                <div class="filter">
                    <a class="icon" data-bs-toggle="dropdown">
                        <i class="mdi mdi-dots-horizontal float-end toggle-options"></i>
                    </a>
                    <ul class="dropdown-menu float-end">
                        <li><a class="dropdown-item" wire:click="$set('selectedType', 'Government')">Government</a></li>
                        <li><a class="dropdown-item" wire:click="$set('selectedType', 'Private')">Private</a></li>
                    </ul>
                </div>
                <h2 class="font-weight-normal mb-3">
                    <i class="mdi mdi-book-open-page-variant mdi-50px"></i>
                </h2>
                <h4 class="mb-3"><span class="option">Total Scholarships</span></h4>
                @if ($selectedType == 'Government')
                    <h5 class="card-text">{{ $governmentCount }}</h5>
                @elseif ($selectedType == 'Private')
                    <h5 class="card-text">{{ $privateCount }}</h5>
                @else
                    <h5 class="card-text">0</h5>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6 stretch-card grid-margin">
        <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
          <div class="card-body">
            <i class="mdi mdi-dots-horizontal float-end"></i>
            <h2 class="font-weight-normal mb-3">
              <i class="mdi mdi-human-male mdi-50px"></i>
            </h2>
              <h4 class="mb-3">Total of Scholars in Government</h4>
              <h5 class="card-text">30,000</h5>
          </div>
        </div>
      </div>
</div>

</div>
