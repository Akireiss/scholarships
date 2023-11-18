<div>
    <div class="row">

        <!-- Government Scholarships -->
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="fas fa-graduation-cap fa-2x"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Government Scholarships</span></h4>
                    <h5 class="card-text fs-4">{{ $governmentCount }}</h5>
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
                    <h4 class="mb-3 mt-4"><span class="option">Private Scholarships</span></h4>
                    <h5 class="card-text fs-4">{{ $privateCount }}</h5>
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
                    <h4 class="mb-3 mt-4"><span class="option">Active Scholarship</span></h4>
                    <h5 class="card-text fs-4">{{ $scholarshipActive }}</h5>
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
                    <h4 class="mb-3 mt-4"><span class="option">Inactive Scholarship</span></h4>
                    <h5 class="card-text fs-4">{{ $scholarshipInactive }}</h5>
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

        <!-- Active Grantees -->
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="fas fa-user-check fa-2x"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Active Grantees</span></h4>
                    <h5 class="card-text fs-4">{{ $active }}</h5>
                </div>
            </div>
        </div>

        <!-- Inactive Grantees -->
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <!-- Use an appropriate icon for inactive grantees -->
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="fas fa-user-times fa-2x"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Inactive Grantees</span></h4>
                    <h5 class="card-text fs-4">{{ $inactive }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="container ">
        <div class="row justify-content-start">
            <div class="col-md-3">
                <label for="fundSources" class="form-label">Recepient</label>
                <select id="selectedSources" name="selectedSources" wire:model="selectedSources"
                    class="form-select form-select-sm mb-3">
                    <option selected value="All">All</option>
                    @foreach($fundSources as $source)
                    <option value="{{ $source }}">{{ $source }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="year" class="form-label">Select Year</label>
                <select id="selectedYear" name="selectedYear" wire:model="selectedYear" class="form-select form-select">
                    <option selected value="Choose from below...">Choose from below...</option>
                    @foreach($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- line chart --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card" height="300px">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script defer src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
                document.addEventListener("livewire:load", function () {
                const chartData = @json($chartData);

            // Create the line chart
                const chart = new Chart(document.getElementById('myChart'), {
                    type: 'line',
                    data: {
                        labels: chartData.campusLabels,
                        datasets: [{
                            label: 'Students per Campus',
                            data: chartData.studentCounts,
                            fill: false,
                            borderColor: '#333',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Students per Campus by Source: {{ $selectedSources }} and Year: {{ $selectedYear }}'
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Campus'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Student Count'
                                }
                            }
                        }
                    }
                });

                Livewire.on('filterChanged', () => {
            // Fetch new data when the filters change
            Livewire.reload();
        });

        Livewire.on('chartDataUpdated', (newChartData) => {
            // Update the chart data when it changes
            chart.data.labels = newChartData.campusLabels;
            chart.data.datasets[0].data = newChartData.studentCounts;
            chart.update();
        });
    });
        </script>
    </div>


</div>
