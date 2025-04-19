<div>
    {{-- <div class="row border-bottom">
        <div x-data="{ orderBy: 'recent', showDatePicker: false }" class="col-md-9 mt-2 pb-2">
            <!-- Sorting Options -->
            <span role="button" class="badge rounded-pill text-dark border border-2 fs-6 px-4 py-2 m-1"
                :class="orderBy === 'recent' ? 'border-dark bg-secondary-subtle' : ''"
                x-on:click="if (orderBy !== 'recent') { orderBy = 'recent'; showDatePicker = false; $wire.set('orderBy', 'recent'); }">
                Recent
            </span>

            <span role="button" class="badge rounded-pill text-dark border border-2 fs-6 px-4 py-2 m-1"
                :class="orderBy === 'oldest' ? 'border-dark bg-secondary-subtle' : ''"
                x-on:click="if (orderBy !== 'oldest') { orderBy = 'oldest'; showDatePicker = false; $wire.set('orderBy', 'oldest'); }">
                Oldest
            </span>

            <span role="button" class="badge rounded-pill text-dark border border-2 fs-6 px-4 py-2 m-1"
                :class="orderBy === 'seller' ? 'border-dark bg-secondary-subtle' : ''"
                x-on:click="if (orderBy !== 'seller') { orderBy = 'seller'; showDatePicker = false; $wire.set('orderBy', 'seller'); }">
                By Seller
            </span>

            <span role="button" class="badge rounded-pill text-dark border border-2 fs-6 px-4 py-2 m-1"
                :class="orderBy === 'date-range' ? 'border-dark bg-secondary-subtle' : ''"
                x-on:click="if (orderBy !== 'date-range') { showDatePicker = true; orderBy = 'date-range'; }">
                Date Range
            </span>
            
            <div x-show="showDatePicker" class="position-relative">
                <div class="d-flex p-2 gap-2">
                    <div class="col-12 col-md-4">
                        <label for="startDate">Start Date</label>
                        <input type="date" id="startDate" wire:model.live="start_date" class="form-control mt-2" placeholder="Select Start Range">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="endData">End Date</label>
                        <input type="date" id="endData" wire:model.live="end_date" class="form-control mt-2" placeholder="Select End Range">
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="d-flex float-md-end mt-2">
                <span class="text-end me-2">
                    <span class="d-block">Pending Approvals</span>
                    <span class="d-block">{{ $this->pendingApproval }}</span>
                </span>
                <button class="btn btn-default rounded-5 bg-custom-secondary">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M14.7369 2.75784H8.08489C6.00489 2.74984 4.30089 4.40684 4.25089 6.48684V17.2238C4.20589 19.3258 5.87389 21.0658 7.97489 21.1108C8.01189 21.1108 8.04889 21.1118 8.08489 21.1108H16.0729C18.1629 21.0368 19.8149 19.3148 19.8029 17.2238V8.03384L14.7369 2.75784Z"
                            stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14.4766 2.75V5.659C14.4766 7.079 15.6256 8.23 17.0456 8.234H19.7996" stroke="black"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M11.6406 15.9472V9.90625" stroke="black" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9.29688 13.5938L11.6419 15.9488L13.9869 13.5938" stroke="black" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </button>
            </div>
        </div>
    </div> --}}
    <div class="row border-bottom align-items-center">
        <!-- Left Section: Sorting Options -->
        <div x-data="{ orderBy: 'recent', showDatePicker: false }" class="col-12 col-md-9">
            <!-- Sorting Options -->
            <div class="d-flex flex-wrap gap-2 p-2">
                <span role="button" class="badge rounded-pill text-dark border border-2 fs-6 px-4 py-2"
                    :class="orderBy === 'recent' ? 'border-dark bg-secondary-subtle' : ''"
                    x-on:click="if (orderBy !== 'recent') { orderBy = 'recent'; showDatePicker = false; $wire.set('orderBy', 'recent'); }">
                    Recent
                </span>
    
                <span role="button" class="badge rounded-pill text-dark border border-2 fs-6 px-4 py-2"
                    :class="orderBy === 'oldest' ? 'border-dark bg-secondary-subtle' : ''"
                    x-on:click="if (orderBy !== 'oldest') { orderBy = 'oldest'; showDatePicker = false; $wire.set('orderBy', 'oldest'); }">
                    Oldest
                </span>
    
                <span role="button" class="badge rounded-pill text-dark border border-2 fs-6 px-4 py-2"
                    :class="orderBy === 'seller' ? 'border-dark bg-secondary-subtle' : ''"
                    x-on:click="if (orderBy !== 'seller') { orderBy = 'seller'; showDatePicker = false; $wire.set('orderBy', 'seller'); }">
                    By Seller
                </span>
    
                <span role="button" class="badge rounded-pill text-dark border border-2 fs-6 px-4 py-2"
                    :class="orderBy === 'date-range' ? 'border-dark bg-secondary-subtle' : ''"
                    x-on:click="if (orderBy !== 'date-range') { showDatePicker = true; orderBy = 'date-range'; }">
                    Date Range
                </span>
            </div>
    
            <!-- Date Range Picker -->
            <div x-show="showDatePicker" class="mt-3">
                <div class="row g-2">
                    <div class="col-12 col-md-6 px-3">
                        <label for="startDate">Start Date</label>
                        <input type="date" id="startDate" wire:model.live="start_date" class="form-control mt-1"
                            placeholder="Select Start Range">
                    </div>
                    <div class="col-12 col-md-6 px-3">
                        <label for="endDate">End Date</label>
                        <input type="date" id="endDate" wire:model.live="end_date" class="form-control mt-1"
                            placeholder="Select End Range">
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Right Section: Pending Approvals -->
        <div class="col-12 col-md-3 mt-3 mt-md-2">
            <div class="d-flex justify-content-start justify-content-md-end align-items-center px-3">
                <div class="me-2 text-start text-md-end">
                    <div class="fw-bold">Pending Approvals</div>
                    <div>{{ $this->pendingApproval }}</div>
                </div>
                <button class="btn btn-default rounded-5 bg-custom-secondary">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M14.7369 2.75784H8.08489C6.00489 2.74984 4.30089 4.40684 4.25089 6.48684V17.2238C4.20589 19.3258 5.87389 21.0658 7.97489 21.1108C8.01189 21.1108 8.04889 21.1118 8.08489 21.1108H16.0729C18.1629 21.0368 19.8149 19.3148 19.8029 17.2238V8.03384L14.7369 2.75784Z"
                            stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14.4766 2.75V5.659C14.4766 7.079 15.6256 8.23 17.0456 8.234H19.7996" stroke="black"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M11.6406 15.9472V9.90625" stroke="black" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9.29688 13.5938L11.6419 15.9488L13.9869 13.5938" stroke="black" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <div wire:loading.delay>
        <div class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-white bg-opacity-75"
            style="z-index: 1050;">
            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div class="row justify-content-center product-list p-2">
        @foreach ($this->products as $key => $data)
           
            <div class="fw-bold text-secondary">
                {{ $key}}
            </div>
            @foreach ($data as $product)
                <div class="col-12">
                    <div class="row bg-secondary-subtle rounded align-items-center m-2 p-2">
                        <div class="col-12 col-md-2 border-end border-secondary">
                            <span class="text-secondary"> {{ $product->name }} </span>
                            <span class="d-block fs-5 fw-bold text-wrap"> {{ $product->description }} </span>
                        </div>
                        <div class="col-12 col-md-6 border-end border-secondary">
                            <div class="d-flex">
                                @foreach ($product->images as $image)
                                    <div class="ratio ratio-1x1 m-2">
                                        <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100 rounded"
                                            alt="Service Image" loading="lazy">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 col-md-2 border-end border-secondary">
                            <span class="text-secondary">Product Category </span>
                            <span class="d-flex fw-bold">
                                <span>{{ $product->category->title }}</span>
                                <i class="ms-4 fs-5 fas fa-angle-down align-self-center" style="color: #CCCCCC"></i>
                            </span>
                        </div>
                        <div class="col-12 col-md-1 text-end">
                            <div class="d-flex">
                                <i class="bg-custom-secondary rounded-5 fs-4 text-dark fa-regular fa-eye m-1 fw-normal p-2 slider-btn"
                                    role="button" data-id="{{ $product->id }}"></i>
                                <i class="bg-custom-secondary rounded-5 fs-4 text-danger fa-regular fa-trash-can m-1 fw-normal p-2"
                                    role="button"
                                    onclick="confirmAction('reject', {{ $product->id }})"></i>
                                <i class="bg-custom-secondary rounded-5 fs-4 text-dark fa-regular fa-square-check m-1 fw-normal p-2"
                                    role="button"
                                    onclick="confirmAction('approve', {{ $product->id }})"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>

    @if ($this->totalPage > 1)
        <div class="d-flex justify-content-between align-items-center p-4" 
            x-data="{ currentPage: @entangle('currentPage'), totalPage: @entangle('totalPage'), perPage: @entangle('perPage') }">
            
            <button class="btn border rounded border-2 px-3 py-2 d-flex align-items-center gap-2" 
                    x-on:click="currentPage > 1 ? $wire.set('currentPage', currentPage - 1) : null" 
                    :disabled="currentPage === 1">
                <i class="fa fa-arrow-left"></i> <!-- Bootstrap Icon -->
                <span>Previous</span>
            </button>

            <!-- Page Indicator -->
            <span class="fw-bold text-secondary">
                Page <span x-text="currentPage"></span> of <span x-text="totalPage"></span>
            </span>

            <!-- Next Button -->
            <button class="btn border rounded border-2 px-3 py-2 d-flex align-items-center gap-2" 
                    x-on:click="currentPage < totalPage ? $wire.set('currentPage', currentPage + 1) : null" 
                    :disabled="currentPage === totalPage">
                <span>Next</span>
                <i class="fa fa-arrow-right"></i> <!-- Bootstrap Icon -->
            </button>
        </div>
    @endif
    @include('livewire.admin.partial.product-slider')
</div>
<script>
    function confirmAction(action, productId) {
        
        let actionText = action === 'reject' ? 'reject this product' : 'approve this product';
        let confirmButtonText = action === 'reject' ? 'Yes, Reject' : 'Yes, Approve';
        let iconType = action === 'reject' ? 'warning' : 'success';

        Swal.fire({
            title: `Are you sure?`,
            text: `Do you really want to ${actionText}? This action cannot be undone.`,
            icon: iconType,
            showCancelButton: true,
            confirmButtonColor: action === 'reject' ? '#d33' : '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: confirmButtonText
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call(action === 'reject' ? 'rejectProduct' : 'approveProduct', productId);
            }
        });
    }
</script>
@script
    <script>
        const sliderForm = document.querySelector(".slider-form");
        const closeSliderBtn = document.getElementById("closeSliderBtn");

        document.querySelector(".product-list").addEventListener("click", function(event) {
            if (event.target.classList.contains("slider-btn")) {
                let productId = event.target.getAttribute('data-id');
                
                @this.call('setProduct', productId).then(function() {
                    sliderForm.classList.toggle("open");
                });
            }
        });

        closeSliderBtn.addEventListener("click", function() {
            sliderForm.classList.remove("open");
        });

        document.addEventListener('productStatusChanged', event => {
            Toastify({
                text: event.detail[0].message,
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: event.detail[0].type === 'success' ? "green" : "black",
            }).showToast();
            sliderForm.classList.remove("open");
        });
    </script>
@endscript
