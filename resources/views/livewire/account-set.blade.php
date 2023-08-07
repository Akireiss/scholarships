<div>
    <section class="p-5">
        <div class="row p-2">
            <div class="col-lg-12">
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
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>
                                            <button class="btn-gradient-primary btn-sm" type="button">View</button>
                                            <button class="btn-gradient-warning btn-sm" type="button"
                                                wire:click="openModal({{ $user->id }})">Edit</button>
                                        </td>
                                    </tr>
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
    <div class="modal fade" id="userEditModal" tabindex="-1" role="dialog" aria-labelledby="userEditModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userEditModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateUser" >
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Name</label>
                                <input type="text" wire:model="name" class="form-control form-control-sm">
                                @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="username">Username</label>
                                <input type="text" wire:model="username" class="form-control form-control-sm">
                                @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="newPassw">New Password</label>
                                <input type="password" wire:model="newPassw" class="form-control form-control-sm">
                                @error('newPassw') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="rePass">Re-enter Password</label>
                                <input type="password" wire:model="rePass" class="form-control form-control-sm">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="updateUser" class="btn btn-gradient-warning">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
