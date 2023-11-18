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

       <div class="row">
            @livewire('nluc-dash')
       </div>

        {{-- it ends here --}}

    </div>
@endsection
