@extends('layouts.includes.campus-NLUC.index')
@section('content')

<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-success text-white me-2">
          <i class="mdi mdi-home"></i>
        </span> Dashboard
      </h3>
    </div>

    {{-- message --}}

    <div id="message" class="alert alert-success" style="display: none; width:50%; margin-top:10px;">
      {{ session('message') }}
    </div>

    {{-- message ends --}}

{{-- cards --}}

            @livewire('scholarship-count-government')

{{-- it ends here --}}


      <!-- charts -->

      <!-- Line chart -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Line chart</h4>
              <canvas id="lineChart" style="height:300px"></canvas>
            </div>
          </div>
        </div>
      </div>
      <!-- it ends here -->


      <!-- normative reports here  -->

      <div class="row align-items-lg-center justify-content-center">
        <div class="col-lg-10 grid-margin shadow-lg">
          <div class="card-body">
            <h4 class="d-flex align-items-md-center justify-content-center">
              Text here...
            </h4>
          </div>
        </div>
      </div>

      <!-- it ends here -->

      <!-- charts ends -->

  </div>

@endsection
