<div>
    <section class="p-5">
        <div class="row">
            {{-- message here --}}
            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
            {{-- it ends here --}}
            <livewire:user-table />
        </div>
    </section>
</div>
