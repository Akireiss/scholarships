<div>
    <section class="p-5">
        <div class="card-body">
            {{-- message here --}}
            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
            {{-- it ends here --}}
            <div class="card-header">
                <h2>Back-up</h2>
            </div>
            <div class="row">
                <div class="col-md-12 m-2">
                    <h4></h4>
                </div>
                <div class="d-flex align-items-center justify-content-center m-2">
                    <button wire:click="backupDatabase"
                        class="btn btn-md text-dark bg-warning btn-outline-warning">Back-up</button>
                </div>
            </div>
        </div>
    </section>
</div>
