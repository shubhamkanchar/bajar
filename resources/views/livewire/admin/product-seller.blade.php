<div>
    <div class="row border-bottom">
        <div class="col-md-9 mt-2 pb-2 overflow-x-auto">
            <div class="d-flex align-items-center gap-2 p-2 ">
                <button class="btn btn-light border rounded-5 bg-secondary-subtle">
                    <i class="bi bi-search"></i>
                </button>
                <select class="form-select w-auto rounded-5 bg-secondary-subtle" wire:click="setCity()">
                    <option selected>Select City</option>
                    @foreach($this->cityOptions as $city)
                        <option value="{{$city}}">{{$city}}</option>
                    @endforeach
                </select>
                <select class="form-select w-auto rounded-5  bg-secondary-subtle" wire:model="state">
                    <option selected>Select State</option>
                    @foreach($this->stateOptions as $state)
                        <option value="{{$state}}">{{$state}}</option>
                    @endforeach
                </select>
                @if($type != 'individual')
                <select class="form-select w-auto rounded-5  bg-secondary-subtle">
                    <option selected>Product Category</option>
                </select>
                <select class="form-select w-auto rounded-5  bg-secondary-subtle">
                    <option selected>By Subscription</option>
                </select>
                @endif
                <button class="btn btn-light border rounded-5  bg-secondary-subtle">Expert Reviewer</button>
            </div>
        </div>
        <div class="col-md-3">
            <div class="d-flex float-md-end mt-2">
                <span class="text-end me-2">
                    <span class="d-block">Pending Approvals</span>
                    <span class="d-block">00</span>
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
    <div class="row justify-content-center product-list p-2">
        @foreach ($this->productSellers as $key => $data)
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
                                        @if($type == 'product')
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

                        <div class="col-12 col-md-2 border-end border-secondary">
                            <span class="text-secondary">Total Products</span>
                            <span class="d-flex fw-bold">
                                <span>{{ sprintf('%02d', $seller->product->count()) }}</span>
                            </span>
                        </div>
                        <div class="col-12 col-md-1 border-end border-secondary">
                            <span class="text-secondary">Categories</span>
                            <span class="d-flex fw-bold">
                                <span>{{ sprintf('%02d', $seller->category->count()) }}</span>
                            </span>
                        </div>
                        <div class="col-12 col-md-2 border-end border-secondary">
                            <span class="text-secondary">Standard</span>
                            <span class="d-flex fw-bold">
                                <span>{{ $seller->created_at }}</span>
                            </span>
                        </div>
                        <div class="col-12 col-md-1 text-end">
                            <div class="d-flex">
                                <a href="{{ route('business.edit', ['uuid' => $seller->uuid]) }}">
                                    <i class="bg-custom-secondary rounded-5 fs-4 text-dark fa-regular fa-eye m-1 fw-normal p-2 slider-btn"
                                        role="button"></i>
                                </a>
                                <i class="bg-custom-secondary rounded-5 fs-4 text-danger fa-regular fa-trash-can m-1 fw-normal p-2" role="button" wire:click="deleteProductSeller('{{$seller->uuid}}')"
                                wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>
