@extends('layouts.includes.campus-NLUC.index')
@section('content')
<section class="p-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-2">
                <div class="card-body shadow-lg">
                    <livewire:student-table />
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .btn-primary {
        background-color: blue;
        color: white
    }
    .btn-primary:hover{
        background-color: rgb(0, 0, 168);
        color: wheat;
    }

    .btn-warning {
        background-color: rgb(238, 238, 70);
        color: white
    }
</style>
@endsection

