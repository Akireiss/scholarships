@extends('layouts.app')
@section('content')

<section class="vh-25 mt-5">
    <div class="container py-2 h-25 shadow-lg p-3 mb-5 bg-body rounded">
      <div class="row d-flex align-items-center justify-content-center h-25">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <img src=" {{ 'assets/images/updated.png' }} " class="img-fluid" alt="dmmmsu-logo">
        </div>
        <div class="col-md-7 col-lg-6 col-xl-4 offset-xl-1">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

          <form action="{{ route('login.action') }}" method="POST">
            @csrf

            <!-- Username input -->
            <div class="form-outline mb-4">
              <input type="text" id="username" class="form-control form-control-sm @error('username') is-invalid @enderror" name="username"/>
              <label class="form-label" for="username" name="username">Username</label>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" />
              <label class="form-label" for="password" >Password</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <!-- Submit button -->
            <button type="submit" class="btn btn-gradient-success btn-rounded btn-fw form-control fw-bold text-dark">Log in</button>

          </form>
        </div>
      </div>
    </div>
  </section>

@endsection

