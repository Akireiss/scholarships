@extends('layouts.includes.admin.index')
@section('content')
    <section class="px-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body shadow-md p-3">
                        {{-- Data table --}}
                        <livewire:view-form />
                        {{-- ends here --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
