<div>
    {{-- wire:init="mount" --}}
    <div class="row">
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="mdi mdi-book-open-page-variant mdi-50px"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Number of Scholarships in Government</span></h4>
                    <h5 class="card-text">
                        {{ $governmentCount }}
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="mdi mdi-book-open-page-variant mdi-50px"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Number of Scholarships in Private</span></h4>
                    <h5 class="card-text">
                        {{ $privateCount }}
                    </h5>
                </div>
            </div>
        </div>



        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="mdi mdi-book-open-page-variant mdi-50px"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Numbers of Scholar in Government</span>
                    </h4>
                    <h5 class="card-text">{{ $governmentStudent }}<h5>
                </div>
            </div>
        </div>

        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="mdi mdi-book-open-page-variant mdi-50px"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Numbers of Scholar in Private</span>
                    </h4>
                    <h5 class="card-text">{{ $privateStudent }}</h5>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('node_modules/chart.js/dist/chart.min.js') }}"></script>
        {{-- Line chart --}}
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" wire:init='mount'>
                        <h4 class="card-title">Line chart</h4>
                        <canvas id="chart" width="300" height="200" class="p-2"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- it ends here -->

        <script>
            document.addEventListener('livewire:load', function () {
                const ctx = document.getElementById('chart').getContext('2d');
                const chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json(array_column($chartData, 'campus_name')),
                        datasets: [{
                            label: 'Number of students',
                            data: @json(array_column($chartData, 'total')),
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1,
                            yAxisID: 'y',
                        },
                        // Add another dataset here for the second y-axis
                        ],
                    },
                    options: {
                        scales: {
                            y: {
                                type: 'linear',
                                display: true,
                                position: 'left',
                            },
                            y1: {
                                type: 'linear',
                                display: true,
                                position: 'right',
                                // Ensure the y1 axis does not clash with the y axis
                                gridLines:{
                                    drawOnChartArea:false
                                }
                            },
                        },
                    },
                });
            });
            </script>


    {{-- end here --}}
</div>
