<div>
    <div class="row">

        <!-- Government Scholarships -->
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="fas fa-graduation-cap fa-2x"></i>
                    </h2>

                    <h4 class="mb-3 mt-4">
                        <a href="{{ url('/admin/settings/addScholar/government') }}">
                            <span class="option">Government Scholarships</span>
                        </a>
                    </h4>
                    <h5 class="card-text fs-4">{{ $governmentScholarships }}</h5>
                </div>
            </div>
        </div>

        <!-- Private Scholarships -->
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="fas fa-university fa-2x"></i>
                    </h2>
                    <h4 class="mb-3 mt-4">
                        <a href="{{ url('/admin/settings/addScholar/private') }}">
                            <span class="option">Private Scholarships</span>
                        </a>
                    </h4>
                    <h5 class="card-text fs-4">{{ $privateScholarships }}</h5>

                </div>
            </div>
        </div>

        <!-- Active Scholarship -->
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </h2>
                    <h4 class="mb-3 mt-4">
                        <a href="{{ url('/admin/settings/addScholar/government') }}">
                            <span class="option">Active Goverment Scholarships</span>
                        </a>
                    </h4>
                    <h5 class="card-text fs-4">{{ $govermentActive }}</h5>
                </div>
            </div>
        </div>

        <!-- Inactive Scholarship -->
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <!-- Use an appropriate icon for inactive scholarships -->
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="fas fa-times-circle fa-2x"></i>
                    </h2>
                    <h4 class="mb-3 mt-4">
                        <a href="{{ url('/admin/settings/addScholar/private') }}">
                            <span class="option">Active Private Scholarships</span>
                        </a>
                    </h4>
                    <h5 class="card-text fs-4">{{ $privateActive }}</h5>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <!-- Government Grantees -->
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="fas fa-user-graduate fa-2x"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Government Grantees</span></h4>
                    <h5 class="card-text fs-4">{{ $governmentStudent }}</h5>
                </div>
            </div>
        </div>

        <!-- Private Grantees -->
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="fas fa-users fa-2x"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Private Grantees</span></h4>
                    <h5 class="card-text fs-4">{{ $privateStudent }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-start">
            <div class="col-md-3">
                <label for="fundSources" class="form-label">Recipient</label>
                <select id="selectedSources" name="selectedSources" wire:model="selectedSources"
                    class="form-select form-select-sm mb-3">
                    <option value="All" {{ $selectedSources==='All' ? 'selected' : '' }}>All</option>
                    @foreach($fundSources as $source)
                    <option value="{{ $source->id }}">{{ $source->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="year" class="form-label">Select Year</label>
                <select id="selectedYear" name="selectedYear" wire:model="selectedYear" class="form-select form-select">
                    <option value="allYear" {{ $selectedYear==='allYear' ? 'selected' : '' }}>All</option>
                    @foreach($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="applyFilters" class="form-label">Filter</label>
                <button class="btn btn-sm btn-primary form-control">Apply Filters</button>
            </div>
        </div>

        {{-- line chart --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:load', function () {
        @this.on('renderChart', function (data){
            const ctx = document.getElementById('myChart').getContext('2d');
            const config = {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Student',
                        data: data.values,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            };
            const myChart = new Chart(ctx, config);
        });
    });
</script>



    </div>

    <style>
        .btn-primary {
            background-color: #17a2b8 !important;
        }

        .btn-primary:hover {
            background-color: #148697 !important;
        }

        a {
            color: black;
            text-decoration: none;
        }
    </style>

</div>
