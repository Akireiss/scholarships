@extends('layouts.includes.admin.index')
@section('content')
<section class="p-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card-header text-center">
                    <h3>School Year</h3>
                </div>
                <form action="{{ route('school-year.save') }}" method="post">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <label for="year" class="form-label m-2 fw-bold">School Year</label>
                            <input type="text" class="form-control form-control-lg @error('year') is-invalid @enderror"
                                name="year" id="year" maxlength="9">
                            @error('year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <small class="mx-3">Note: <span class="text-danger">eg.(2020-2021)</span></small>
                            {{-- script --}}
                            <script>
                                document.addEventListener("DOMContentLoaded", function()
                                        {
                                                                const yearInput = document.getElementById("year");
                                                                yearInput.addEventListener("input", function() {
                                                                        let inputText = this.value.replace(/\D/g, "").substring(0, 10);
                                                                        let formattedText = inputText.replace(/(\d{4})(\d{4})/, "$1-$2");
                                                                        this.value = formattedText;
                                            });
                                        });
                            </script>
                            {{-- ends --}}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-md btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>
<style>
    .btn-primary {
        background-color: rgb(1, 1, 196);
        color: black;
        border-radius: 10px;
    }
</style>
@endsection
