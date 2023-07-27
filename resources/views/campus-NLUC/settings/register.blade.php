@extends('layouts.includes.admin.index')
@section('content')

<section class="vh-100 mt-5 px-3">
    <div class="container py-2 h-75 shadow-lg p-3 mb-5 bg-body rounded">
        {{-- message here --}}
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        {{-- it ends here --}}
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-4 col-lg-3 ">
          <img src="{{ asset('assets/images/updated.png') }}" class="img-fluid" alt="dmmmsu-logo">
        </div>
        <div class="col-md-6 col-lg-6 col-xl-6 offset-xl-1">
          <form action="{{ route('register.save') }}" onsubmit="return validateForm()" method="POST">
            @csrf

            <div class="row g-3 mb-3">
                <div class="col">
                    <input type="text" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                    <label class="form-label" for="name">Name</label>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="col">
                    <input type="text" id="username" class="form-control form-control-sm @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" />
                    <label class="form-label" for="username" >Username</label>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
              </div>
              </div>

              <div class="row g-3 mb-3">
                <div class="col" style="position: relative;">
                        <input type="password" id="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" />
                        <label class="form-label" for="password">Password</label>
                            <i class="mdi mdi-eye" id="passwordToggle" style="position:absolute; top:20%; right:10px; transform:translateY(-50); cursor: pointer;" onclick="togglePasswordVisibility('password')"></i>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="col" style="position: relative;">
                        <input type="password" id="cpassword" class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('cpassword') }}" />
                        <label class="form-label" for="cpassword" >Confirm password</label>
                        <i class="mdi mdi-eye" id="cpasswordToggle" style="position:absolute; top:20%; right:10px; transform:translateY(-50); cursor: pointer;" onclick="togglePasswordVisibility('cpassword')"></i>
                        @error('cpassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
            </div>

            {{-- script here --}}

            <script>
    function togglePasswordVisibility(fieldId) {
        const field = document.getElementById(fieldId);

        if (field.type === 'password') {
            field.type = 'text';
        } else {
            field.type = 'password';
        }
    }

            </script>

            {{-- it ends here --}}

              <div class="col-md-6 mb-3 mx-auto text-center">
                    <select id="role" class="form-select mb-1 @error('role') is-invalid @enderror" name="role">
                    <option value="0">Staff</option>
                    <option value="1">Admin</option>
                    <option value="2">Campus In-charge</option>
                    </select>
                    <label class="form-label px-3" for="role">User type</label>
                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>



            <!-- Submit button -->
            <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-gradient-success btn-rounded btn-fw text-dark">Register</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>

@endsection

{{-- scripts --}}

<script>
    function validateForm() {
      var password = document.getElementById("password").value;
      var cPassword = document.getElementById("cpassword").value;

      if (password !== cPassword) {
        alert("Passwords do not match!");
        return false;
      }
    }
  </script>

  {{-- scripts end --}}

