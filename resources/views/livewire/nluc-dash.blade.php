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
                                <a class="dropdown-item"
                                    wire:click="$set('selectedTypeScholar', 'Government')">Government</a>
                                <a class="dropdown-item" wire:click="$set('selectedTypeScholar', 'Private')">Private</a>
                            </div>
                        </div>
                    </div>
                    <h2 class="font-weight-normal mb-3">
                        <i class="mdi mdi-book-open-page-variant mdi-50px"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Total of Scholars in {{ $selectedTypeScholar }}</span>
                    </h4>
                    <h5 class="card-text">
                        {{ $selectedTypeScholar === 'Government' ? $governmentScholar : ($selectedTypeScholar ===
                        'Private' ?
                        $privateScholar : '0') }}
                    </h5>
                </div>
            </div>
        </div>
    </div>

    {{-- line chart --}}
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Line chart</h4>
                    <canvas id="studentsChart" width="300" height="200" class="p-4"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- it ends here -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
            document.addEventListener('livewire:load', function () {
            var ctx = document.getElementById('studentsChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json(array_column($chartData, 'campus')),
                    datasets: [{
                        label: 'Total of Students',
                        data: @json(array_column($chartData, 'total')),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255,1)',
                            'rgba(255, 159, 64,1)'
                        ],
                        borderWidth: 3
                    }]
                },
                options: {
                    indexAxis: 'y',
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });
    </script>


    {{-- end here --}}
</div>
