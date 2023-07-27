@extends('layouts.includes.admin.index')

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
    <div class="row">
      {{-- 1st card --}}
            @livewire('scholarship-count-government')
        {{-- it ends here --}}


        {{-- 2nd card --}}
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
      {{-- it ends here --}}
    </div>


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
