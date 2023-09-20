@extends('layouts.includes.staff.index')
@section('content')
    <section class="px-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body shadow-lg p-2">
                        <livewire:view-form />
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
