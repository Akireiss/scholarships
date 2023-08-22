<div>
    <section class="p-5">
        <div class="row">
            <div class="col-lg-12">
                @if (session()->has('message'))
                <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h2>Users</h2>
                    </div>
                    <div class="card-body shadow-lg">
                        <div class="table-responsive">
                            <table id="students" class="table table-striped data-table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    {{-- @if ($user->id === $user_id) --}}
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>
                                            <button class="btn-primary btn-sm text-dark fw-900"
                                                type="button">View</button>
                                            <button class="btn-warning btn-sm text-dark fw-900" type="button"
                                                data-bs-toggle="modal" data-bs-target="#updateUser"
                                                wire:click="$emit('updateUser', {{ $user->id }})">Edit</button>
                                        </td>
                                    </tr>
                                    {{-- @endif --}}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="updateUser" tabindex="-1" role="dialog"
        aria-labelledby="updateUserLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUserLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"
                        wire:click="$emit('closeModal')"></button>
                </div>
                <form wire:submit.prevent="$emit('updateUser')">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" wire:model.defer="user_id">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="name">Name</label>
                                <input type="text" wire:model.defer="name" class="form-control form-control-sm">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="username">Username</label>
                                <input type="text" wire:model.defer="username" class="form-control form-control-sm">
                                @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="password">New Password</label>
                                <input type="password" wire:model.defer="password" class="form-control form-control-sm">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="rePass">Re-enter Password</label>
                                <input type="password" wire:model.defer="rePass" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-gradient-warning text-dark fw-700"
                            wire:click="$emit('updateUser')">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('script')
    <script>
        window.addEventListener('close-modal', event => {
    $('#updateUser').modal('hide');
})
    </script>
    @endsection

</div>
