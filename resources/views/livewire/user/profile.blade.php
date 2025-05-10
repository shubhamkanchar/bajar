@section('style')
    <style>
        .product-card,
        .service-card {
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
        }

        .product-carousel,
        .service-carousel {
            height: 150px;
            overflow: hidden;
        }

        .product-carousel .carousel-item img,
        .service-carousel .carousel-item img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .product-details,
        .service-details {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 10px;
            font-size: 12px;
        }

        .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 10;
        }
    </style>
@endsection

<div>
    <div class="container" x-data="{ tab: @entangle('tab') }">
        <div class="row">
            <div class="col-12 mt-4">
                @if (auth()->user()->bg_image)
                    <img class="w-100 h-250 object-fit-cover rounded-4"
                        src="{{ asset('storage/' . auth()->user()->bg_image) }}">
                @else
                    <picture>
                        <source media="(max-width: 767px)" srcset="{{ asset('assets/image/mobile/banner_01.png') }}">
                        <img class="w-100 object-fit-cover rounded-4"
                            src="{{ asset('assets/image/desktop/banner_01.png') }}" alt="Banner">
                    </picture>
                @endif
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-lg-2 col-md-3 mb-3 col-6 position-relative" style="margin-top:-70px">
                        @if (auth()->user()->profile_image)
                            <img class="w-100 ms-md-4 h-100"
                                src="{{ asset('storage/' . auth()->user()->profile_image) }}">
                        @else
                            <img class="w-100 ms-md-4 h-100" src="{{ asset('assets/image/profile.png') }}">
                        @endif
                    </div>

                    <div class="col-md-5 p-3">
                        <div class="d-lg-flex align-items-center ms-md-2">
                            <span class="fw-bold fs-4 m-2">{{ auth()->user()->name }}</span>
                        </div>
                        <div class="ms-md-3 mt-2">
                            Individual
                        </div>
                    </div>

                    <div class="col-md-5 p-3">
                        <div class="d-lg-flex justify-content-end align-items-end float-md-end">
                            <a href="{{ route('user.edit') }}" class="btn btn-dark">
                                <svg class="me-2" width="21" height="21" viewBox="0 0 21 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.3203 19.7912H19.8751" stroke="white" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.3125 2.45291C12.1205 1.48728 13.5729 1.34568 14.5586 2.13722C14.6131 2.18016 16.364 3.5404 16.364 3.5404C17.4469 4.19499 17.7833 5.58657 17.114 6.64853C17.0784 6.7054 7.17911 19.088 7.17911 19.088C6.84977 19.4989 6.34983 19.7414 5.81553 19.7472L2.02451 19.7948L1.17034 16.1795C1.05069 15.6711 1.17034 15.1373 1.49969 14.7264L11.3125 2.45291Z"
                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M9.47656 4.75L15.156 9.11159" stroke="white" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="col-md-12">
                <button x-on:click="tab = 'product'; $wire.set('tab', 'product')"
                    :class="tab === 'product' ? 'text-bg-dark' : 'text-bg-light'"
                    class="badge rounded-pill fs-6 p-3 m-1">
                    Product Wishlist
                </button>
                <button x-on:click="tab = 'service'; $wire.set('tab', 'service')"
                    :class="tab === 'service' ? 'text-bg-dark' : 'text-bg-light'"
                    class="badge rounded-pill fs-6 p-3 m-1">
                    Service Wishlist
                </button>
            </div>

            <div class="col-12 mt-3 mb-5">
                <div class="row" x-show="tab === 'product'">
                    @if ($this->products->count() > 0)
                        @foreach ($this->products as $product)
                            <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-12 mb-4">
                                <div class="border rounded product-card">
                                    <i class="fa fa-trash text-danger remove-btn"
                                        wire:click="removeFromWishlist({{ $product->id }})"></i>
                                    <div id="carouselProduct{{ $product->id }}" class="carousel slide product-carousel"
                                        data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($product->images as $key => $productImage)
                                                <div
                                                    class="carousel-item @if ($key == 0) active @endif">
                                                    <img src="{{ asset('storage/' . $productImage->path) }}"
                                                        class="d-block w-100" alt="Product Image">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselProduct{{ $product->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselProduct{{ $product->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon"></span>
                                        </button>
                                    </div>
                                    <div class="product-details">
                                        <div>
                                            <span class="d-block p-1">{{ substr($product->description, 0, 50) }}</span>
                                            <span class="text-secondary fw-light p-1">{{ $product->brand_name }}</span>
                                            @if ($product->show_price)
                                                <span class="d-block p-1">Rs.{{ $product->price }}<span
                                                        class="p-1 text-secondary fw-light">per</span>Unit</span>
                                            @else
                                                <span class="d-block p-1">Contact Us for pricing</span>
                                            @endif
                                        </div>
                                        <a href="tel:{{ $product->user->phone }}" class="btn btn-dark w-100 mt-2">
                                            <i class="fa fa-phone"></i> Call Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/image/empty.png') }}" alt="Empty Wishlist">
                        </div>
                        <div class="text-center col-12">
                            <i class="d-block">Your wishlist is looking a little lonely!</i>
                            <i>Start exploring and add your favourites!</i>
                        </div>
                    @endif
                </div>
                <div class="row" x-show="tab === 'service'">
                    @if ($this->services->count() > 0)
                        @foreach ($this->services as $service)
                            <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-12 mb-4">
                                <div class="border rounded service-card">
                                    <i class="fa fa-trash text-danger remove-btn"
                                        wire:click="removeFromWishlist({{ $service->id }})"></i>
                                    <div id="carouselProduct{{ $service->id }}"
                                        class="carousel slide service-carousel" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($service->images as $key => $serviceImage)
                                                <div
                                                    class="carousel-item @if ($key == 0) active @endif">
                                                    <img src="{{ asset('storage/' . $serviceImage->path) }}"
                                                        class="d-block w-100" alt="Service Image">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselProduct{{ $service->id }}"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselProduct{{ $service->id }}"
                                            data-bs-slide="next">
                                            <span class="carousel-control-next-icon"></span>
                                        </button>
                                    </div>
                                    <div class="service-details">
                                        <div>
                                            <span
                                                class="d-block p-1">{{ substr($service->description, 0, 50) }}</span>
                                            <span class="text-secondary fw-light p-1">{{ $service->provider }}</span>
                                            @if ($service->show_price)
                                                <span class="d-block p-1">Rs.{{ $service->price }}<span
                                                        class="p-1 text-secondary fw-light">per</span>Service</span>
                                            @else
                                                <span class="d-block p-1">Contact Us for pricing</span>
                                            @endif
                                        </div>
                                        <a href="tel:{{ $service->user->phone }}" class="btn btn-dark w-100 mt-2">
                                            <i class="fa fa-phone"></i> Call Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/image/empty.png') }}" alt="Empty Wishlist">
                        </div>
                        <div class="text-center col-12">
                            <i class="d-block">Your wishlist is looking a little lonely!</i>
                            <i>Start exploring and add your favourites!</i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
