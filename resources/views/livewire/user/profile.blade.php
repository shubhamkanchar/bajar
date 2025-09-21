@push('style')
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
@endpush

<div>
    <div class="container" x-data="{ tab: @entangle('tab') }">
        <div class="row">
            <div class="col-12 mt-4 position-relative">
                @if (auth()->user()->bg_image)
                    <img class="w-100 h-250 object-fit-cover rounded-4"
                        src="{{ asset('storage/' . auth()->user()->bg_image) }}">
                @else
                    <picture wire:ignore>
                        <source media="(max-width: 767px)"
                            srcset="{{ asset('assets/image/mobile/banner_0' . rand(1, 8) . '.png') }}">
                        <img class="w-100 h-250 object-fit-cover rounded-4"
                            src="{{ asset('assets/image/desktop/banner_0' . rand(1, 8) . '.png') }}" alt="Banner">
                    </picture>
                @endif
                {{-- <label role="button" class="position-absolute top-0 end-0 p-2 pe-4" style="z-index: 1"
                    wire:target="bgImage" for="bgImage">

                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect width="30" height="30" rx="15" transform="matrix(-1 0 0 1 30 0)"
                            fill="white" fill-opacity="0.8" />
                        <g clip-path="url(#clip0_1372_7414)">
                            <path
                                d="M19.2227 16.9219C18.3543 16.9219 17.589 17.3491 17.1084 17.9987L12.9528 15.8708C13.0218 15.6357 13.0703 15.3919 13.0703 15.1348C13.0703 14.786 12.9988 14.4543 12.8753 14.1493L17.2242 11.5323C17.7082 12.1003 18.4196 12.4688 19.2227 12.4688C20.6766 12.4688 21.8594 11.286 21.8594 9.83203C21.8594 8.37806 20.6766 7.19531 19.2227 7.19531C17.7687 7.19531 16.5859 8.37806 16.5859 9.83203C16.5859 10.1671 16.6549 10.4849 16.7694 10.78L12.4075 13.4047C11.9239 12.8536 11.2228 12.498 10.4336 12.498C8.97962 12.498 7.79688 13.6808 7.79688 15.1348C7.79688 16.5887 8.97962 17.7715 10.4336 17.7715C11.3163 17.7715 12.0945 17.3318 12.5733 16.6639L16.7152 18.7848C16.6389 19.0311 16.5859 19.2876 16.5859 19.5586C16.5859 21.0126 17.7687 22.1953 19.2227 22.1953C20.6766 22.1953 21.8594 21.0126 21.8594 19.5586C21.8594 18.1046 20.6766 16.9219 19.2227 16.9219Z"
                                fill="black" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1372_7414">
                                <rect width="15" height="15" fill="white"
                                    transform="translate(7.19531 7.19531)" />
                            </clipPath>
                        </defs>
                    </svg>

                </label> --}}
            </div>

            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-md-4 col-lg-3 col-xl-2 col-6 offset-3 offset-sm-0 position-relative"
                        style="margin-top:-70px">
                        @if (auth()->user()->profile_image)
                            <img class="ms-md-4 square-img-profile"
                                src="{{ asset('storage/' . auth()->user()->profile_image) }}">
                        @else
                            <img class="ms-md-4 square-img-profile"
                                src="{{ asset('assets/image/profile.png') }}">
                        @endif
                    </div>

                    <div class="col-md-5 p-3">
                        <div class="d-lg-flex align-items-center ms-md-2">
                            <span class="fw-bold fs-4 m-2">{{ auth()->user()->name }}</span>
                        </div>
                        <div class="ms-md-3 m-2">
                            Individual
                        </div>
                    </div>

                    <div class="col-md-5 p-3">
                        <div class="d-lg-flex justify-content-end align-items-end float-md-end">
                            <a href="{{ route('user.edit',['uuid' => auth()->user()->uuid]) }}" class="btn btn-dark">
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
                    class="btn rounded-pill fs-6 py-2 px-3 m-1">
                    Product Wishlist
                </button>
                <button x-on:click="tab = 'service'; $wire.set('tab', 'service')"
                    :class="tab === 'service' ? 'text-bg-dark' : 'text-bg-light'"
                    class="btn rounded-pill fs-6 py-2 px-3 m-1">
                    Service Wishlist
                </button>
            </div>

            <div class="col-12 mt-3 mb-5">
                <div class="row" x-show="tab === 'product'">
                    @if ($this->products->count() > 0)
                        @foreach ($this->products as $product)
                            <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-12 mb-4">
                                <div class="border rounded product-card my-2">
                                    <i class="fa fa-trash text-danger remove-btn"
                                        wire:click="removeFromWishlist({{ $product->id }})"></i>
                                    <div id="carouselProduct{{ $product->id }}" class="carousel slide product-carousel"
                                        data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($product->images as $key => $productImage)
                                                <div
                                                    class="carousel-item @if ($key == 0) active @endif ratio ratio-1x1">
                                                    <img src="{{ asset('storage/' . $productImage->path) }}"
                                                        class="d-block object-fit-cover w-100" alt="Product Image">
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
