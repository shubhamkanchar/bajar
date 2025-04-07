<div>
    <div class="row border-bottom">
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
                :class="orderBy === 'date-range' ? 'border-dark bg-secondary-subtle' : ''"
                x-on:click="if (orderBy !== 'date-range') { showDatePicker = true; orderBy = 'date-range'; }">
                Date Range
            </span>

            <div x-show="showDatePicker" class="position-relative">
                <div class="d-flex p-2 gap-2">
                    <div class="col-12 col-md-4">
                        <label for="startDate">Start Date</label>
                        <input type="date" id="startDate" wire:model.live="start_date" class="form-control mt-2"
                            placeholder="Select Start Range">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="endData">End Date</label>
                        <input type="date" id="endData" wire:model.live="end_date" class="form-control mt-2"
                            placeholder="Select End Range">
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>
    <div class="row product-list p-2">
        <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-12">
            <a>
                <div class="dashed-border ratio ratio-add-product" wire:click="openSlider()">
                    <span class="text-center p-4">
                        <i class="fa-regular fa-square-plus fs-1 text-secondary openSlider mt-5" role="button"></i>
                        <div class="fs-5 fw-bold">Add New Blog</div>
                        <small>Share new blogs with user</small>
                    </span>
                </div>
            </a>
        </div>
        @foreach ($this->products as $key => $data)
            <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-12">
                <div class="border rounded position-relative rounded-4">
                    <div class="ratio ratio-16x9" wire:click="editBlog({{$data->id}})">
                        <img src="{{ asset('storage/' . $data->blog_image) }}" class="d-block w-100 rounded-4"
                            alt="Product Image">
                    </div>
                    <p class="px-1 fw-bold"> {{ $this->textWrap($data->title) }}</p>
                    <p class="px-1"> {{ $this->textWrap($data->description) }}</p>
                    <a class="position-absolute top-0 end-0 p-2" style="z-index: 1" wire:click="deleteProductSeller('{{$data->id}}')"
                        wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect width="30" height="30" rx="15" transform="matrix(-1 0 0 1 30 0)"
                                fill="white" fill-opacity="0.6" />
                            <path
                                d="M20.4948 13.1016C20.4948 13.1016 20.0876 18.1528 19.8513 20.2806C19.7388 21.2968 19.1111 21.8923 18.0828 21.9111C16.1261 21.9463 14.1671 21.9486 12.2111 21.9073C11.2218 21.8871 10.6046 21.2841 10.4943 20.2858C10.2566 18.1393 9.85156 13.1016 9.85156 13.1016"
                                stroke="#EC1D25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M21.531 10.6797H8.8125" stroke="#EC1D25" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M19.0829 10.6793C18.4941 10.6793 17.9871 10.263 17.8716 9.68625L17.6894 8.77425C17.5769 8.3535 17.1959 8.0625 16.7616 8.0625H13.5869C13.1526 8.0625 12.7716 8.3535 12.6591 8.77425L12.4769 9.68625C12.3614 10.263 11.8544 10.6793 11.2656 10.6793"
                                stroke="#EC1D25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    @if ($this->totalPage > 1)
        <div class="d-flex justify-content-between align-items-center p-4" x-data="{ currentPage: @entangle('currentPage'), totalPage: @entangle('totalPage'), perPage: @entangle('perPage') }">

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
    @include('livewire.admin.partial.blog-slider')
</div>
