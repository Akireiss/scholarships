<div>
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
                    <h4 class="mb-3 mt-4"><span class="option">Numbers of Active Scholarship</span>
                    </h4>
                    <h5 class="card-text">{{ $scholarshipActive }}<h5>
                </div>
            </div>
        </div>

        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="mdi mdi-book-open-page-variant mdi-50px"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Numbers of Inactive Scholarship</span>
                    </h4>
                    <h5 class="card-text">{{ $scholarshipInactive }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="mdi mdi-account-multiple mdi-50px"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Numbers of Grantees in Government</span>
                    </h4>
                    <h5 class="card-text">{{ $governmentStudent }}<h5>
                </div>
            </div>
        </div>

        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="mdi mdi-account-multiple mdi-50px"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Numbers of Grantees in Private</span>
                    </h4>
                    <h5 class="card-text">{{ $privateStudent }}</h5>
                </div>
            </div>
        </div>
        {{-- active --}}
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="mdi mdi-account-multiple mdi-50px"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Numbers of Active grantees</span>
                    </h4>
                    <h5 class="card-text">{{ $active }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="mdi mdi-account-multiple mdi-50px"></i>
                    </h2>
                    <h4 class="mb-3 mt-4"><span class="option">Numbers of Inactive grantees</span>
                    </h4>
                    <h5 class="card-text">{{ $inactive }}</h5>
                </div>
            </div>
        </div>
    </div>
    {{-- inactive --}}



{{-- Line chart --}}
<div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Students per Campus</h4>
                    <canvas id="student" width="300" height="200" class="p-2"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Line chart ends --}}

<script defer src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
 document.addEventListener('livewire:load', function () {
            // Get the chart data from Livewire component
            var chartData = @this.chartData;

            // Extract data for the chart
            var campuses = chartData.map(function (item) {
                return item.campus;
            });

            // Extract student counts for the chart
            var studentCounts = chartData.map(function (item) {
                return item.studentCount;
            });

            // Create a unique color for the chart line
            var chartColor = 'rgba(75, 192, 192, 1';

            var ctx = document.getElementById('student').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: campuses,
                    datasets: [
                        {
                            label: 'Students per Campus',
                            data: studentCounts,
                            borderColor: chartColor,
                            borderWidth: 2,
                            fill: false,
                        }
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Students'
                            }
                        }
                    }
                }
            });
        });
</script>



</div>
