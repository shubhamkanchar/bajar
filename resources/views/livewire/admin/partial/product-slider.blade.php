<div class="slider-form" wire:ignore.self>
    <div class="slider-content">
        <div class="row">
            <div class="col-md-8">
                <p class="fw-bold fs-3">Product Details</p>
            </div>
            <div class="col-md-4 text-md-end mb-2">
                <a class="btn btn-default rounded-5 bg-custom-secondary" role="button" id="closeSliderBtn">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
        </div>
        @if ($selectedProduct)
            <form>
                <div class="row">
                    <div class="col-md-5 mb-3 position-relative">
                        <div class="dashed-border ratio ratio-1x1">
                            <img src="{{ asset('storage/' . $selectedProduct->images?->first()?->path) }}" class="img-fluid">
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="row">
                            @foreach ($selectedProduct->images as $image)
                                @if ($loop->index != 0)
                                    <div class="col-md-4 mb-3 position-relative">
                                        <div class="dashed-border ratio ratio-1x1">
                                            <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid">
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-2 mt-2">
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Product Name" value="{{ $selectedProduct->name }}">
                            <label for="name">Product Name</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-2 mt-2">
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Brand Name" value="{{ $selectedProduct->brand_name }}">
                            <label for="name">Brand Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-2 mt-2">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                @foreach ($this->categories as $category)
                                    <option value="{{ $category->id }}" @selected($category->id == $selectedProduct->category_id)>
                                        {{ $category->title }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Product Category</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating my-2" wire:ignore>
                            <select class="form-select" id="tagInput" multiple wire:model.live="product_tag">
                                @foreach($allTags as $tag)
                                    <option {{in_array($tag, $product_tag) ? 'selected' : '' }} value="{{ $tag }}">{{ $tag }}</option>
                                @endforeach
                            </select>
                            <label for="tagInput">Tags</label>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <div class="form-floating mb-2 mt-2 w-100">
                            <input type="text" name="name" class="form-control" id="price" placeholder="Price"
                                value="{{ $selectedProduct->price }}">
                            <label for="name">Price</label>
                        </div>
                        <span class="m-2">Per</span>
                        <div class="form-floating mb-2 mt-2 w-100">
                            <input type="number" min="0" class="form-control" placeholder="Qty" id="floatingSelect"  value="{{ $selectedProduct->quantity }}">
                            <label for="floatingSelect">Qty</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-2 d-flex justify-content-between bg-white rounded-5 p-2 border">
                            <button type="button" class="btn rounded-5 pt-2 pb-2 w-100 {{ $selectedProduct->show_price ? 'btn-dark': 'btn-light' }}">
                                Show Price
                            </button>

                            <!-- Hide Price Button -->
                            <button type="button" class="btn rounded-5 pt-2 pb-2 w-100 {{ !$selectedProduct->show_price ? 'btn-dark': 'btn-light' }}">
                                Hide Price
                            </button>
                        </div>
                    </div>
                    <div class="col-12">
                        <textarea class="form-control mt-3 mb-3" placeholder="Product Description" line="5">
                            {{ $selectedProduct->description}}
                        </textarea>

                    </div>
                    <div class="row">
                        <div class="text-secondary-subtle">Added by <a>{{$selectedProduct->user->name}}</a></div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="row">
                            @if ($selectedProduct->is_approved !== 1)  
                                <div class="col-md-5 mt-2 mb-2">
                                    <button type="button" class="btn btn-dark w-100"
                                        onclick="confirmAction('approve', {{ $selectedProduct->id }})"
                                        >Approve</button>
                                </div>
                            @endif
                            @if ($selectedProduct->is_approved !== 0)
                                <div class="col-md-5 mt-2 mb-2">
                                    <button type="button" onclick="confirmAction('reject', {{ $selectedProduct->id }})"
                                        class="btn btn-default bg-custom-secondary">
                                        <svg class="me-2" width="19" height="20" viewBox="0 0 19 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.3238 7.46875C16.3238 7.46875 15.7808 14.2037 15.4658 17.0407C15.3158 18.3957 14.4788 19.1898 13.1078 19.2148C10.4988 19.2618 7.88681 19.2648 5.27881 19.2098C3.95981 19.1828 3.13681 18.3788 2.98981 17.0478C2.67281 14.1858 2.13281 7.46875 2.13281 7.46875"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M17.708 4.24219H0.75" stroke="black" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M14.4386 4.239C13.6536 4.239 12.9776 3.684 12.8236 2.915L12.5806 1.699C12.4306 1.138 11.9226 0.75 11.3436 0.75H7.11063C6.53163 0.75 6.02363 1.138 5.87363 1.699L5.63063 2.915C5.47663 3.684 4.80063 4.239 4.01562 4.239"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        Reject
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
