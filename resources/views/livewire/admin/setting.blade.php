<div class="container p-4">

    {{-- Logged-in user section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <small class="text-muted">Logged in as,</small><br>
            <strong class="fs-5">{{ Auth::user()->name }}</strong><br>
            <span class="text-muted">{{ Auth::user()->email }}</span>
        </div>

        <form wire:submit.prevent="logout">
            <button class="btn btn-dark">Log Out</button>
        </form>
    </div>

    {{-- Admin accounts manager --}}
    <div class="bg-light p-3 rounded shadow-sm mb-3">
        <h5 class="mb-3">Manage admin accounts</h5>

        @foreach ($admins as $index => $admin)
            <div class="row g-2 align-items-center mb-3">
                <div class="col-md-5">
                    <input type="text" class="form-control" placeholder="User Name *"
                           wire:model="admins.{{ $index }}.name">
                </div>
                <div class="col-md-5">
                    <input type="email" class="form-control" placeholder="Email ID *"
                           wire:model="admins.{{ $index }}.email">
                </div>
                <div class="col-md-2 text-end">
                    @if ($index > 0)
                        <button type="button" class="btn btn-outline-danger" wire:click="removeAdmin({{ $index }})">
                            <i class="bi bi-trash"></i>
                        </button>
                    @endif
                </div>
            </div>
        @endforeach

        <button type="button" class="btn btn-outline-secondary mt-2" wire:click="addAdmin">
            <i class="bi bi-plus-circle me-1"></i> Add New
        </button>
    </div>

</div>
