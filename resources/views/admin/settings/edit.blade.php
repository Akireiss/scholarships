@extends('layouts.includes.admin.index')
@section('content')
<section class="vh-100 mt-2 p-5">
    <div class="container py-2 shadow-lg p-3 mb-5 bg-body rounded">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Settings</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.update', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <label for="name" class="mb-1">Name</label>
                                    <input type="text" name="name" wire:model="name" value="{{$user->name}}"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-4">
                                    <label for="username" class="mb-1">Username</label>
                                    <input type="text" name="username" wire:model="username" value="{{$user->username}}"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-4" class="mb-1">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" wire:model="email" value="{{$user->email}}"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" class="mb-1">
                                    <label for="password">Password</label>
                                    <input type="password" id="password"
                                        class="form-control form-control-sm"
                                        name="password" wire:model='password' />
                                </div>
                                <div class="col-md-4" class="mb-1">
                                    <label for="cpassword">Confirm password</label>
                                    <input type="password" id="cpassword"
                                        class="form-control form-control-sm"
                                        name="password_confirmation" wire:model='password_confirmation' />
                                </div>
                            </div>
                            <div class="d-flex align-items-start justify-content-start mt-3 p-2">
                                <button type="submit" class="btn-sm btn-warning btn text-dark">Save</button>
                                <a class="btn-sm btn-danger btn text-dark" href="{{ route('admin.settings.accountSettings') }}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
