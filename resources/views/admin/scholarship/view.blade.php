@extends('layouts.includes.admin.index')
@section('content')
    <section class="p-6">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12">
                <div class="card p-6">
                    <div class="card-body shadow-lg">
                        <livewire:view-form />
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
