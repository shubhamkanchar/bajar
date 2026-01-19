<div>
    <div class="row border-bottom px-2">
        <div x-data="{ orderBy: 'seller', showSearch: false, showCity: false, showState: false, showCategory: false, selectCity: @entangle('selectedCity'), selectedState: @entangle('selectedState'), selectedCategory: @entangle('selectedCategory'), search: @entangle('search') }" class="col-md-9 mt-2 pb-2">

            <!-- Search Icon & Input -->
            <div class="d-inline-block position-relative">
                <button class="btn rounded-circle border"
                    x-on:click="showSearch = !showSearch; if(search.length) { $wire.set('search', '') }"
                    style="background-color: #E8E8E8">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7.39687 14.7937C5.32954 14.7937 3.5799 14.0778 2.14794 12.6458C0.715979 11.2138 0 9.4642 0 7.39687C0 5.32954 0.715979 3.5799 2.14794 2.14794C3.5799 0.715979 5.32954 0 7.39687 0C9.4642 0 11.2138 0.715979 12.6458 2.14794C14.0778 3.5799 14.7937 5.32954 14.7937 7.39687C14.7937 8.23139 14.661 9.01849 14.3954 9.75818C14.1299 10.4979 13.7696 11.1522 13.3144 11.7212L19.6871 18.0939C19.8957 18.3025 20 18.568 20 18.8905C20 19.2129 19.8957 19.4784 19.6871 19.6871C19.4784 19.8957 19.2129 20 18.8905 20C18.568 20 18.3025 19.8957 18.0939 19.6871L11.7212 13.3144C11.1522 13.7696 10.4979 14.1299 9.75818 14.3954C9.01849 14.661 8.23139 14.7937 7.39687 14.7937ZM7.39687 12.5178C8.81935 12.5178 10.0284 12.0199 11.0242 11.0242C12.0199 10.0284 12.5178 8.81935 12.5178 7.39687C12.5178 5.9744 12.0199 4.76529 11.0242 3.76956C10.0284 2.77383 8.81935 2.27596 7.39687 2.27596C5.9744 2.27596 4.76529 2.77383 3.76956 3.76956C2.77383 4.76529 2.27596 5.9744 2.27596 7.39687C2.27596 8.81935 2.77383 10.0284 3.76956 11.0242C4.76529 12.0199 5.9744 12.5178 7.39687 12.5178Z"
                            fill="black" />
                    </svg>
                </button>
                <template x-if="showSearch" x-transition>
                    <input type="text" wire:model.live.debounce.250ms="search"
                        class="form-control d-inline-block ms-2 bg-secondary-subtle border-0 rounded-pill px-3 py-2"
                        placeholder="Search..." style="width: 200px;">
                </template>
            </div>

            <!-- Sorting Options -->


            <template x-if="selectedState">
                <span role="button"
                    class="badge rounded-pill text-dark border border-2 fs-6 px-4 py-2 m-1 border-dark bg-secondary-subtle">
                    <span x-text="selectedState"></span>
                    <span role="button" class="ms-2 text-white"
                        x-on:click="selectedState = ''; $wire.set('selectedState', '')">❌</span>
                </span>
            </template>

            <!-- State Dropdown -->
            <template x-if="!selectedState">
                <div class="d-inline-block position-relative">
                    <span role="button" class="badge rounded-pill text-dark border border-2 fs-6 px-4 py-2 m-1"
                        x-on:click="showState = !showState" x-on:click.away="showState = false">
                        Select State ▼
                    </span>
                    <div x-show="showState" x-transition
                        class="position-absolute bg-white border rounded p-2 shadow-sm z-3"
                        style="max-height: 50vh; overflow-y: auto;">
                        @foreach ($this->states as $state)
                            <div role="button" class="px-2 py-1 dropdown-item"
                                wire:click="$set('selectedState', '{{ $state }}')"
                                x-on:click="showState = false">
                                {{ $state }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </template>

            <!-- Selected City -->
            <template x-if="selectCity">
                <span role="button"
                    class="badge rounded-pill text-dark border border-2 fs-6 px-4 py-2 m-1 border-dark bg-secondary-subtle">
                    <span x-text="selectCity"></span>
                    <span role="button" class="ms-2 text-white"
                        x-on:click="selectCity = ''; $wire.set('selectedCity', '')">❌</span>
                </span>
            </template>

            <!-- City Dropdown -->
            <template x-if="!selectCity && selectedState">
                <div class="d-inline-block position-relative">
                    <span role="button"
                        class="badge word-wrap rounded-pill text-dark border border-2 fs-6 px-4 py-2 m-1"
                        x-on:click="showCity = !showCity" x-on:click.away="showCity = false">
                        Select City ▼
                    </span>
                    <div x-show="showCity" x-transition
                        class="position-absolute bg-white border rounded p-2 shadow-sm z-3"
                        style="max-height: 50vh; overflow-y: auto;">
                        @foreach ($this->cities as $city)
                            <div role="button" class="px-2 py-1 dropdown-item"
                                wire:click="$set('selectedCity', '{{ $city }}')" x-on:click="showCity = false">
                                {{ $city }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </template>

            @if($type == 'product' || $type == 'service')
            <!-- Selected Category -->
            <template x-if="selectedCategory">
                <span role="button"
                    class="badge rounded-pill text-dark border border-2 fs-6 px-4 py-2 m-1 border-dark bg-secondary-subtle">
                    <span x-text="$refs.categoryText ? $refs.categoryText.innerText : selectedCategory['title']"></span>
                    <span role="button" class="ms-2 text-white"
                        x-on:click="selectedCategory = ''; $wire.set('selectedCategory', '')">❌</span>
                </span>
            </template>

            <!-- Product Category Dropdown -->
            <template x-if="!selectedCategory">
                <div class="d-inline-block position-relative">
                    <span role="button" class="badge rounded-pill text-dark border border-2 fs-6 px-4 py-2 m-1"
                        x-on:click="showCategory = !showCategory">
                        Category ▼
                    </span>

                    <div x-show="showCategory" x-transition
                        class="position-absolute bg-white border rounded p-2 shadow-sm z-3"
                        x-on:click.away="showCategory = false">
                        @foreach ($this->categories as $category)
                            <div role="button" class="px-2 py-1 dropdown-item"
                                wire:click="$set('selectedCategory', {title:'{{ $category->title }}',id:'{{ $category->id }}'})"
                                x-on:click="showCategory = false">
                                {{ $category->title }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </template>
            @endif

            <span role="button"
                class="badge rounded-pill text-dark border border-2 fs-6 px-4 py-2 m-1 {{ $expert == 1 ? 'border-dark bg-secondary-subtle' : '' }}"
                wire:click="setExpert()">
                Expert Reviewer
            </span>
        </div>

        <!-- Pending Approvals & Download Button -->
        <div class="col-md-3">
            <div class="d-flex float-md-end m-2">
                <span class="text-end me-2">
                    <span class="d-block">Total 
                        @if($type == 'product')
                            Products
                        @elseif($type == 'service')
                            Services
                        @else
                            Individuals
                        @endif
                    </span>
                    <span class="d-block">{{ $this->productSellers['totalSellers'] }}</span>
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
        @if (count($this->productSellers['sellers']) > 0)
            @foreach ($this->productSellers['sellers'] as $key => $data)
                <div class="fw-bold text-secondary">
                    {{ $key }}
                </div>
                @foreach ($data as $seller)
                    <div class="col-12">
                        <div class="row bg-secondary-subtle rounded align-items-center m-2 p-2">
                            <div class="col-12 col-md-3 border-end border-secondary">
                                <div class="row">
                                    <div class="col-3">
                                        <span class="ratio ratio-1x1 w-100">
                                            <img src="{{ asset('storage/' . $seller->profile_image) }}"
                                                class="d-block w-100 rounded" alt="Service Image">
                                        </span>
                                    </div>
                                    <div class="text-secondary col-9">{{ $seller->name }}
                                        <span class="d-block fw-bold">
                                            @if ($type == 'product')
                                                <span>Product Seller</span>
                                            @elseif($type == 'service')
                                                <span>Service Provider</span>
                                            @else
                                                <span>Individual</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 border-end border-secondary">
                                <span class="fw-bold "> {{ $seller->phone }} </span>
                                <span class="d-block fw-bold text-wrap"> {{ $seller->email }} </span>
                            </div>

                            @if($type == 'product')
                            <div class="col-12 col-md-2 border-end border-secondary">
                                <span class="text-secondary">Total Products</span>
                                <span class="d-flex fw-bold">
                                    <span>{{ sprintf('%02d', $seller->product->count()) }}</span>
                                </span>
                            </div>
                            @endif
                            @if($type == 'service')
                            <div class="col-12 col-md-2 border-end border-secondary">
                                <span class="text-secondary">Total Services</span>
                                <span class="d-flex fw-bold">
                                    <span>{{ sprintf('%02d', $seller->service->count()) }}</span>
                                </span>
                            </div>
                            @endif
                            @if($type == 'product' || $type == 'service')
                            <div class="col-12 col-md-1 border-end border-secondary">
                                <span class="text-secondary">Categories</span>
                                <span class="d-flex fw-bold">
                                    <span>{{ sprintf('%02d', $seller->category->count()) }}</span>
                                </span>
                            </div>
                            @endif
                            <div class="col-12 col-md-2 border-end border-secondary">
                                <span class="text-secondary">Standard</span>
                                <span class="d-flex fw-bold">
                                    <span>{{ $seller->created_at }}</span>
                                </span>
                            </div>
                            <div class="col-12 col-md-1 text-end">
                                <div class="d-flex">
                                    @if($type == 'individual')
                                    <a href="{{ route('user.edit', ['uuid' => $seller->uuid]) }}">
                                        <i class="bg-custom-secondary rounded-5 fs-4 text-dark fa-regular fa-eye m-1 fw-normal p-2 slider-btn"
                                            role="button"></i>
                                    </a>
                                    @else
                                    <a href="{{ route('business.edit', ['uuid' => $seller->uuid]) }}">
                                        <i class="bg-custom-secondary rounded-5 fs-4 text-dark fa-regular fa-eye m-1 fw-normal p-2 slider-btn"
                                            role="button"></i>
                                    </a>
                                    @endif
                                    <i class="bg-custom-secondary rounded-5 fs-4 text-danger fa-regular fa-trash-can m-1 fw-normal p-2"
                                        role="button" wire:click="deleteProductSeller('{{ $seller->uuid }}')"
                                        wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        @else
            <div class="text-center h4 fw-bold">No data found</div>
        @endif
    </div>
</div>
