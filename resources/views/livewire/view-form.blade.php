<div>
    <div class="row justify-content-start align-items-start">
        <div class="col-2 mb-2">
            <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#exampleModal">Import</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Import Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Use Livewire's file uploader -->
                        <input type="file" name="csvfile" wire:model='csvfile'>
                    </div>
                    <div class="modal-footer">
                        <!-- Use wire:loading to disable the button during the import process -->
                        <button type="button" wire:click="importData" wire:loading.attr="disabled"
                            class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Display success or error messages -->
    @if (session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session()->has('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Livewire table to display students -->
    <livewire:student-table />

    <!-- JavaScript to close the modal -->
    <script>
        document.addEventListener('livewire:load', function () {
        Livewire.on('dataImported', () => {
            console.log('Data imported successfully');
            $('#exampleModal').modal('hide');
        });
    });
    </script>


    <!-- Styles -->
    <style>
        .btn-primary {
            background-color: blue;
            color: black
        }

        .btn-primary:hover {
            background-color: rgb(0, 0, 168);
            color: wheat;
        }

        .btn-warning {
            background-color: rgb(238, 238, 70);
            color: white
        }
    </style>
</div>
