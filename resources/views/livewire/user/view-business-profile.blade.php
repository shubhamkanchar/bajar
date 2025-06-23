@push('meta')
    <meta property="og:title" content="{{ env('APP_NAME') }}" />
    <meta property="og:description" content="Find trusted building material traders offering a wide range of high quality products." />
    <meta property="og:image" content="{{ url('public/storage/' . $user->profile_image) }}" />
    <meta property="og:url" content="{{ route('view-shop', ['uuid' => $user->uuid]) }}" />
    <meta property="og:type" content="website" />

    <!-- Optional Twitter cards -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ env('APP_NAME') }}" />
    <meta name="twitter:description" content="Find trusted building material traders offering a wide range of high quality products."/>
    <meta name="twitter:image" content="{{ url('public/storage/' . $user->profile_image) }}" />
@endpush
<div>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4 position-relative">
                @if ($this->user->bg_image)
                    <img class="w-100 h-250 object-fit-cover rounded-4"
                        src="{{ asset('storage/' . $this->user->bg_image) }}">
                @else
                    <picture wire:ignore>
                        <source media="(max-width: 767px)" srcset="{{ asset('assets/image/mobile/banner_01.png') }}">
                        <img class="w-100 h-250 object-fit-cover rounded-4"
                            src="{{ asset('assets/image/desktop/banner_01.png') }}" alt="Banner">
                    </picture>
                @endif
                @php
                    $profileLink = route('view-shop', ['uuid' => $user->uuid]);
                    $message = $profileLink;
                @endphp
                {{-- <label role="button" class="position-absolute top-0 end-0 p-2 pe-4" style="z-index: 1"
                    onclick="copyCurrentUrl()"> --}}
                <a role="button" class="position-absolute top-0 end-0 p-2 pe-4" style="z-index: 1"
                    href="https://wa.me/?text={{ urlencode($message) }}" target="_blank" rel="noopener noreferrer">

                    <svg width="40" height="40" viewBox="0 0 30 30" fill="none"
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

                </a>
            </div>
            <div class="col-12 mb-3 mt-2">
                <div class="row">
                    <div class="col-md-4 col-lg-3 col-xl-2 col-6 offset-3 offset-sm-0 position-relative"
                        style="margin-top:-70px">
                        @if ($this->user->profile_image)
                            <img class="ms-md-4 p-3 p-sm-0 square-img-profile"
                                src="{{ asset('storage/' . $this->user->profile_image) }}">
                        @else
                            <img class="ms-md-4 p-3 p-sm-0 square-img-profile"
                                src="{{ asset('assets/image/profile.png') }}">
                        @endif
                    </div>
                    <div class="col-md-4 col-lg-5 col-xl-5 col-12">
                        <div class="d-xl-flex align-items-center ms-xl-2 text-md-start text-center p-md-2">
                            <span class="fw-bold fs-4">{{ $this->user->name }}</span>
                            @if ($user->gst && !empty($user->gst))
                                <span class="badge text-bg-light fs-6 ms-xl-2"><span class="fw-light">GST Number :
                                    </span>
                                    {{ $this->user->gst }}</span>
                            @endif
                        </div>
                        <div class="ms-xl-2 mt-2 d-flex p-md-2">
                            <span class="me-2">
                                <svg width="18" height="20" viewBox="0 0 18 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.5 8.50051C11.5 7.11924 10.3808 6 9.00051 6C7.61924 6 6.5 7.11924 6.5 8.50051C6.5 9.88076 7.61924 11 9.00051 11C10.3808 11 11.5 9.88076 11.5 8.50051Z"
                                        stroke="#808080" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.99951 19C7.80104 19 1.5 13.8984 1.5 8.56329C1.5 4.38664 4.8571 1 8.99951 1C13.1419 1 16.5 4.38664 16.5 8.56329C16.5 13.8984 10.198 19 8.99951 19Z"
                                        stroke="#808080" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span>
                                {{ $this->user->address->address }}, {{ $this->user->address->city }},
                                {{ $this->user->address->state }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-5 col-12 text-md-end">
                        <div class="d-lg-flex float-md-end text-md-end w-100 justify-content-md-end">
                            {{-- <span
                                class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-2 me-2">
                                Free
                            </span> --}}
                            @if ($this->user?->ratings?->total_score)
                                <span
                                    class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-light-emphasis bg-light-subtle border border-light-subtle rounded-2 me-2">
                                    <svg class="me-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.9189 12.32C15.6599 12.571 15.5409 12.934 15.5999 13.29L16.4889 18.21C16.5639 18.627 16.3879 19.049 16.0389 19.29C15.6969 19.54 15.2419 19.57 14.8689 19.37L10.4399 17.06C10.2859 16.978 10.1149 16.934 9.93988 16.929H9.66888C9.57488 16.943 9.48288 16.973 9.39888 17.019L4.96888 19.34C4.74988 19.45 4.50188 19.489 4.25888 19.45C3.66688 19.338 3.27188 18.774 3.36888 18.179L4.25888 13.259C4.31788 12.9 4.19888 12.535 3.93988 12.28L0.328876 8.78C0.0268758 8.487 -0.0781242 8.047 0.0598758 7.65C0.193876 7.254 0.535876 6.965 0.948876 6.9L5.91888 6.179C6.29688 6.14 6.62888 5.91 6.79888 5.57L8.98888 1.08C9.04088 0.98 9.10788 0.888 9.18888 0.81L9.27888 0.74C9.32588 0.688 9.37988 0.645 9.43988 0.61L9.54888 0.57L9.71888 0.5H10.1399C10.5159 0.539 10.8469 0.764 11.0199 1.1L13.2389 5.57C13.3989 5.897 13.7099 6.124 14.0689 6.179L19.0389 6.9C19.4589 6.96 19.8099 7.25 19.9489 7.65C20.0799 8.051 19.9669 8.491 19.6589 8.78L15.9189 12.32Z"
                                            fill="#22B14D" />
                                    </svg>
                                    {{ $this->user->ratings->total_score }}
                                </span>
                            @endif

                            @if ($this->bussinessRatingsCount())
                                <span
                                    class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-light-emphasis bg-light-subtle border border-light-subtle rounded-2 me-2">
                                    <svg class="me-2" width="18" height="20" viewBox="0 0 18 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.7281 19.9137C8.83884 19.9715 8.96266 20.0009 9.08649 20C9.21032 19.999 9.33314 19.9686 9.44489 19.9097L13.0128 18.0025C14.0245 17.4631 14.8168 16.8601 15.435 16.1579C16.779 14.6282 17.5129 12.6758 17.4998 10.6626L17.4575 4.02198C17.4535 3.25711 16.9511 2.57461 16.2082 2.32652L9.57073 0.0995642C9.17106 -0.0357592 8.73313 -0.0328174 8.3405 0.106428L1.72824 2.41281C0.989299 2.67071 0.495998 3.35811 0.500024 4.12396L0.542307 10.7597C0.555395 12.7758 1.31448 14.7194 2.68062 16.2334C3.3048 16.9258 4.10415 17.52 5.12699 18.0505L8.7281 19.9137ZM7.78119 12.1106C7.93019 12.2538 8.12348 12.3244 8.31678 12.3225C8.51007 12.3215 8.70236 12.2489 8.84934 12.1038L12.7484 8.25981C13.0414 7.97053 13.0384 7.50572 12.7424 7.22037C12.4454 6.93501 11.9672 6.93697 11.6742 7.22625L8.3057 10.5466L6.92647 9.2208C6.62949 8.93545 6.15229 8.93839 5.85832 9.22767C5.56536 9.51694 5.56838 9.98175 5.86537 10.2671L7.78119 12.1106Z"
                                            fill="#4285F4" />
                                    </svg>
                                    {{ $this->bussinessRatingsCount() }}
                                </span>
                            @endif
                            <span
                                class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-light-emphasis bg-light-subtle border border-light-subtle rounded-2 me-2">

                                <svg class="me-2" width="20" height="20" viewBox="0 0 20 20"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_287_3784)">
                                        <path
                                            d="M10.0026 0.828125C8.18961 0.828125 6.41733 1.36574 4.90988 2.37299C3.40243 3.38023 2.22752 4.81187 1.53371 6.48686C0.839909 8.16185 0.658379 10.005 1.01208 11.7831C1.36577 13.5613 2.23881 15.1946 3.5208 16.4766C4.80278 17.7586 6.43612 18.6316 8.21428 18.9853C9.99244 19.339 11.8356 19.1575 13.5105 18.4637C15.1855 17.7699 16.6172 16.595 17.6244 15.0875C18.6317 13.5801 19.1693 11.8078 19.1693 9.99479C19.1664 7.56452 18.1997 5.23461 16.4813 3.51615C14.7628 1.79768 12.4329 0.830992 10.0026 0.828125ZM10.0026 17.4948C8.51925 17.4948 7.0692 17.0549 5.83583 16.2308C4.60246 15.4067 3.64117 14.2354 3.07351 12.8649C2.50585 11.4945 2.35733 9.98647 2.64672 8.53161C2.93611 7.07676 3.65041 5.74038 4.69931 4.69149C5.7482 3.6426 7.08457 2.92829 8.53943 2.6389C9.99429 2.34951 11.5023 2.49804 12.8727 3.0657C14.2432 3.63335 15.4145 4.59465 16.2386 5.82801C17.0627 7.06138 17.5026 8.51143 17.5026 9.99479C17.5002 11.9832 16.7092 13.8894 15.3032 15.2954C13.8972 16.7014 11.991 17.4924 10.0026 17.4948Z"
                                            fill="#808080" />
                                        <path
                                            d="M10.8307 9.66021V5.00521C10.8307 4.78419 10.7429 4.57223 10.5867 4.41595C10.4304 4.25967 10.2184 4.17188 9.9974 4.17188C9.77638 4.17188 9.56442 4.25967 9.40814 4.41595C9.25186 4.57223 9.16406 4.78419 9.16406 5.00521V10.0052C9.16411 10.2262 9.25194 10.4381 9.40823 10.5944L11.9082 13.0944C12.0654 13.2462 12.2759 13.3302 12.4944 13.3283C12.7129 13.3264 12.9219 13.2387 13.0764 13.0842C13.2309 12.9297 13.3186 12.7207 13.3205 12.5022C13.3224 12.2837 13.2384 12.0732 13.0866 11.916L10.8307 9.66021Z"
                                            fill="#808080" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_287_3784">
                                            <rect width="20" height="20" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                {{ $this->bussinessTime() }}
                            </span>
                        </div>
                        <div class="d-lg-flex gap-1 float-md-end w-100 justify-content-md-end">
                            @if ($user->address && $user->address->map_link)
                                <a href="{{ $user->address->map_link }}" target="_blank"
                                    class="btn btn-dark text-white text-decoration-none my-2">
                                    <svg width="25" height="26" viewBox="0 0 25 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.4922 9.01524L10.5302 15.0408L3.74941 10.7997C2.77786 10.1918 2.97996 8.71608 4.07888 8.39471L20.1784 3.67997C21.1846 3.38503 22.1172 4.32587 21.8183 5.33541L17.0553 21.4237C16.729 22.5242 15.2617 22.7208 14.6596 21.7451L10.5271 15.0419"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Get Direction
                                </a>
                            @endif

                            <a href="tel:{{ $user->phone }}" class="btn btn-dark my-2">
                                <svg width="25" height="26" viewBox="0 0 25 26" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12.0096 13.4895C16.1649 17.6436 17.1076 12.8377 19.7533 15.4816C22.3039 18.0315 23.7699 18.5424 20.5383 21.7731C20.1335 22.0985 17.5616 26.0122 8.52302 16.9762C-0.516644 7.93906 3.39488 5.36453 3.72028 4.95984C6.95976 1.72015 7.46184 3.19467 10.0125 5.74461C12.6582 8.38958 7.85433 9.33533 12.0096 13.4895Z"
                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Call
                            </a>
                            @if (Auth::user()?->is_reviewer)
                                <button class="btn btn-dark my-2" x-data
                                    x-on:click="$wire.set('showReviewForm', true)">
                                    Review {{ $user->offering === 'product' ? 'Seller' : 'Service Provider' }}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="col-md-9">
                <span
                    class="badge rounded-pill {{ $selectedCategory == 'all' ? 'text-bg-dark' : 'text-bg-light' }} fs-6 p-3 m-1"
                    wire:click="changeCategory('all')" role="button" tabindex="0">All</span>
                @foreach ($this->businessCategories as $cat)
                    <span
                        class="badge rounded-pill {{ $selectedCategory == $cat->id ? 'text-bg-dark' : 'text-bg-light' }}  fs-6 p-3 m-1"
                        role="button" tabindex="0"
                        wire:click="changeCategory({{ $cat->id }})">{{ $cat->title }}</span>
                @endforeach
            </div>
            <div class="col-12 mt-3 product-list">
                @if (!$isLoaded)
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                @endif

                @if ($user->offering === 'product')
                    @foreach ($this->allItems as $key => $products)
                        <h6 class="fw-bold">{{ $key }}</h6>
                        <div class="row mb-2">
                            @foreach ($products as $product)
                                <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-6 mb-3">
                                    <div class="border rounded position-relative h-100 d-flex flex-column my-2">
                                        {{-- Carousel --}}
                                        <div id="carouselProduct{{ $product->id }}" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($product->images as $key => $productImage)
                                                    <div
                                                        class="carousel-item @if ($key == 0) active @endif ratio ratio-1x1">
                                                        <img src="{{ asset('storage/' . $productImage->path) }}"
                                                            class="d-block object-fit-cover rounded w-100"
                                                            alt="Product Image">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselProduct{{ $product->id }}"
                                                data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselProduct{{ $product->id }}"
                                                data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>

                                        {{-- Product Info --}}
                                        <div class="p-2 text-start fw-bold flex-grow-1 d-flex flex-column"
                                            style="font-size: 12px;">
                                            <span class="d-block p-1" style="min-height: 20px;">
                                                {{ substr($product->description, 0, 50) }}
                                            </span>
                                            <span
                                                class="text-secondary fw-light text-start p-1">{{ $product->brand_name }}</span>

                                            @if ($product->show_price)
                                                <span class="d-block p-1">
                                                    Rs.{{ $product->price }}
                                                    <span class="p-1 text-secondary fw-light">per</span>Unit
                                                </span>
                                            @else
                                                <span class="d-block p-1">Contact Us for pricing</span>
                                            @endif

                                            {{-- Action Buttons Pinned to Bottom --}}
                                            <div class="d-flex gap-2 justify-content-between mt-auto pt-2">
                                                <a href="tel:{{ $user->phone }}" class="w-50 btn btn-dark">
                                                    <i class="fas fa-phone me-2"></i>
                                                </a>
                                                <button class="w-50 btn btn-secondary view-product"
                                                    data-id="{{ $product->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>

                                        {{-- Wishlist Icon --}}
                                        @php
                                            $inWishlist = !empty($this->wishlistIds)
                                                ? in_array($product->id, $this->wishlistIds)
                                                : null;
                                        @endphp
                                        @if (auth()->user()?->role == 'individual')
                                            <a class="position-absolute top-0 end-0 m-2 bg-white bg-opacity-75 rounded-pill d-flex align-items-center justify-content-center shadow"
                                                style="width: 40px; height: 40px; z-index: 1; text-decoration: none;"
                                                wire:click.prevent="toggleWishlist({{ $product->id }})">
                                                <i
                                                    class="fs-5 {{ $inWishlist ? 'fa-solid fa-heart text-danger' : 'fa-regular fa-heart text-dark' }}"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @else
                    @foreach ($this->allItems as $key => $services)
                        <h6 class="fw-bold">{{ $key }}</h6>
                        <div class="row mb-2">
                            @foreach ($services as $service)
                                <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-6 mb-3">
                                    <div class="border rounded position-relative h-100 d-flex flex-column">
                                        <div id="carouselService{{ $service->id }}" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($service->images as $key => $serviceImage)
                                                    <div
                                                        class="carousel-item @if ($key == 0) active @endif ratio ratio-4x3">
                                                        <img src="{{ asset('storage/' . $serviceImage->path) }}"
                                                            class="d-block w-100" alt="Service Image">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselService{{ $service->id }}"
                                                data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselService{{ $service->id }}"
                                                data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                        <div class="p-2 text-start fw-bold flex-grow-1" style="font-size: 12px;">
                                            <span class="d-block p-1" style="min-height: 20px;">
                                                {{ substr($service->description, 0, 50) }}
                                            </span>
                                            <span
                                                class="text-secondary fw-light text-start p-1">{{ $service->work_brief }}</span>
                                            <div class="d-flex gap-2 justify-content-between mt-auto">
                                                <a href="tel:{{ $user->phone }}" class="w-50 btn btn-dark">
                                                    <i class="fas fa-phone me-2"></i>
                                                </a>
                                                <button class="w-50 btn btn-secondary view-product"
                                                    data-id="{{ $service->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>

                                        @php
                                            $inWishlist = in_array($service->id, $this->wishlistIds);
                                        @endphp
                                        @if (auth()->user()->role == 'individual')
                                            <a class="position-absolute top-0 end-0 m-2 bg-white bg-opacity-75 rounded-pill d-flex align-items-center justify-content-center shadow"
                                                style="width: 40px; height: 40px; z-index: 1; text-decoration: none;"
                                                wire:click.prevent="toggleWishlist({{ $service->id }})">
                                                <i
                                                    class="fs-5 {{ $inWishlist ? 'fa-solid fa-heart text-danger' : 'fa-regular fa-heart text-dark' }}"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="slider-overlay @if ($showDetailSlider) open @endif"
        x-on:click="showReviewForm = false; $wire.set('showReviewForm', false);showDetailSlider = false;$wire.set('showDetailSlider', false)">
    </div>
    <div class="slider-form" wire:ignore.self x-cloak x-data="{ showDetailSlider: @entangle('showDetailSlider') }" x-show="showDetailSlider"
        x-on:click.away="showDetailSlider = false; $wire.set('showDetailSlider', false)">
        <div class="slider-content">
            <div class="row">
                <div class="col-md-8">
                    <p class="fw-bold fs-3">
                        {{ $user->offering === 'product' ? 'Product Details' : 'Service Details' }}</p>
                </div>
                <div class="col-md-4 text-md-end mb-2">
                    <a class="btn btn-default rounded-5 bg-custom-secondary" role="button" id="closeSliderBtn">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
            </div>

            @if ($user->offering === 'product')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner ratio">
                                @foreach ($product_images as $key => $image)
                                    @if ($image && (gettype($image) == 'string' || $image->getClientOriginalName()))
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ is_string($image) ? asset('storage/' . $image) : $image->temporaryUrl() }}"
                                                class="d-block w-100 rounded carousel-fixed-image"
                                                alt="Product Image">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @if (count(array_filter($product_images)) > 1)
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#productCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#productCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="product-details">
                            <h4 class="fw-bold">{{ $product_name }}</h4>
                            <p class="text-muted">{{ $brand_name }}</p>
                            <hr>

                            <div class="mb-3">
                                <h6>Description</h6>
                                <p>{{ $description }}</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <h6>Category</h6>
                                    <p>
                                        @foreach ($this->categories as $cat)
                                            @if ($cat->id == $category)
                                                {{ $cat->title }}
                                            @endif
                                        @endforeach
                                    </p>
                                </div>

                                @if ($showPrice && $price)
                                    <div class="col-md-6 mb-3">
                                        <h6>Price</h6>
                                        <p>Rs. {{ number_format($price, 2) }} per {{ $quantity }}</p>
                                    </div>
                                @endif
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <a href="tel:{{ $user->phone }}" class="btn btn-dark btn-lg">
                                    <i class="fas fa-phone me-2"></i> Call Us
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div id="serviceCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner ratio">
                                @foreach ($service_images as $key => $image)
                                    @if ($image && (gettype($image) == 'string' || $image->getClientOriginalName()))
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ is_string($image) ? asset('storage/' . $image) : $image->temporaryUrl() }}"
                                                class="d-block w-100 rounded carousel-fixed-image"
                                                alt="Service Image">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @if (count(array_filter($service_images)) > 1)
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#serviceCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#serviceCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="service-details">
                            <h4 class="fw-bold">{{ $work_brief }}</h4>
                            <hr>

                            <div class="mb-3">
                                <h6>Description</h6>
                                <p>{{ $service_description }}</p>
                            </div>

                            <div class="mb-3">
                                <h6>Category</h6>
                                <p>
                                    @foreach ($this->categories as $cat)
                                        @if ($cat->id == $service_category)
                                            {{ $cat->title }}
                                        @endif
                                    @endforeach
                                </p>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <a href="tel:{{ $user->phone }}" class="btn btn-dark btn-lg">
                                    <i class="fas fa-phone me-2"></i> Call Us
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if (Auth::user())
        <div class="slider-overlay @if ($showReviewForm) open @endif"
            x-on:click="showReviewForm = false; $wire.set('showReviewForm', false);showDetailSlider = false;$wire.set('showDetailSlider', false)">
        </div>
        <div class="slider-review-form" x-cloak x-data="{ showReviewForm: @entangle('showReviewForm') }" x-show="showReviewForm"
            x-on:click.away="showReviewForm = false; $wire.set('showReviewForm', false)" wire:ignore.self>
            <div class="slider-content">
                <div class="row">
                    <div class="col-md-8">
                        <p class="fw-bold fs-3">Review Product Seller</p>
                    </div>
                    <div class="col-md-4 text-md-end mb-2">
                        <a class="btn btn-default rounded-5 bg-custom-secondary" role="button"
                            x-on:click="showReviewForm = false; $wire.set('showReviewForm', false)">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 p-0">
                        <div class="d-flex border rounded-4 p-2 gap-3">
                            @if ($this->user->bg_image)
                                <img style="height: 75px; width: 100px;" class="object-fit-cover rounded-4"
                                    src="{{ asset('storage/' . $this->user->bg_image) }}">
                            @else
                                <img style="height: 75px; width: 100px;" class="object-fit-cover rounded-4"
                                    src="{{ asset('assets/bg/bg_profile.png') }}">
                            @endif

                            <div class="d-flex flex-column justify-content-center">
                                <span class="fw-bold fs-4">{{ $this->user->name }}</span>
                                <div class="d-flex align-items-start mt-1 text-muted" style="font-size: 0.9rem;">
                                    <span class="me-2">
                                        <svg width="18" height="20" viewBox="0 0 18 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M11.5 8.50051C11.5 7.11924 10.3808 6 9.00051 6C7.61924 6 6.5 7.11924 6.5 8.50051C6.5 9.88076 7.61924 11 9.00051 11C10.3808 11 11.5 9.88076 11.5 8.50051Z"
                                                stroke="#808080" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M8.99951 19C7.80104 19 1.5 13.8984 1.5 8.56329C1.5 4.38664 4.8571 1 8.99951 1C13.1419 1 16.5 4.38664 16.5 8.56329C16.5 13.8984 10.198 19 8.99951 19Z"
                                                stroke="#808080" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span>
                                        {{ $this->user->address->address }}, {{ $this->user->address->city }},
                                        {{ $this->user->address->state }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 p-4">
                    <!-- Question 1: Is the contact information accurate? -->
                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label text-secondary">
                            Is the contact information accurate?
                        </label>
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="square-checkbox" name="is_contact_accurate" type="radio"
                                    id="contactYes" value="yes" wire:model="is_contact_accurate">
                                <label class="form-check-label" for="contactYes">Yes</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="square-checkbox" name="is_contact_accurate" type="radio"
                                    id="contactNo" value="no" wire:model="is_contact_accurate">
                                <label class="form-check-label" for="contactNo">No</label>
                            </div>
                            @error('is_contact_accurate')
                                <div class="text-danger mt-1" style="font-size: 0.85rem;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Question 2: Is the location accurate? -->
                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label text-secondary">
                            Is the location accurate?
                        </label>
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="square-checkbox" name="is_location_accurate" type="radio"
                                    id="locationYes" value="yes" wire:model="is_location_accurate">
                                <label class="form-check-label" for="locationYes">Yes</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="square-checkbox" name="is_location_accurate" type="radio"
                                    id="locationNo" value="no" wire:model="is_location_accurate">
                                <label class="form-check-label" for="locationNo">No</label>
                            </div>
                        </div>
                        @error('is_contact_accurate')
                            <div class="text-danger mt-1" style="font-size: 0.85rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Question 1: Rate the contact information -->
                    <div class="col-12 col-md-12 mb-3" x-data="{ rating: @entangle('communication_and_professionalism') }" style="user-select: none;">
                        <label class="form-label text-secondary"
                            style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; line-height: 14px;">
                            How would you rate communication and professionalism?
                        </label>
                        <div class="rating fs-5">
                            <template x-for="i in 5" :key="i">
                                <span x-on:click="rating = i; $wire.set('communication_and_professionalism', i)"
                                    style="cursor: pointer;">
                                    <i
                                        :class="rating >= i ? 'fas fa-star star-color' : 'far fa-star star-color-outer'"></i>
                                </span>
                            </template>
                        </div>
                        @error('communication_and_professionalism')
                            <div class="text-danger mt-1" style="font-size: 0.85rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-12 mb-3" x-data="{ rating: @entangle('quality_or_service') }" style="user-select: none;">
                        <label class="form-label text-secondary"
                            style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; line-height: 14px;">
                            How satisfied are you with the quality of the products or services provided?
                        </label>
                        <div class="rating fs-5">
                            <template x-for="i in 5" :key="i">
                                <span x-on:click="rating = i; $wire.set('quality_or_service', i)"
                                    style="cursor: pointer;">
                                    <i
                                        :class="rating >= i ? 'fas fa-star star-color' : 'far fa-star star-color-outer'"></i>
                                </span>
                            </template>
                        </div>
                        @error('quality_or_service')
                            <div class="text-danger mt-1" style="font-size: 0.85rem;">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="col-12 col-md-12 mb-3" x-data="{ rating: @entangle('recommendation') }" style="user-select: none;">
                        <label class="form-label text-secondary"
                            style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; line-height: 14px;">
                            How likely are you to recommend this seller/service provider to others?
                        </label>
                        <div class="rating fs-5">
                            <template x-for="i in 5" :key="i">
                                <span x-on:click="rating = i; $wire.set('recommendation', i)"
                                    style="cursor: pointer;">
                                    <i
                                        :class="rating >= i ? 'fas fa-star star-color' : 'far fa-star star-color-outer'"></i>
                                </span>
                            </template>
                        </div>
                        @error('recommendation')
                            <div class="text-danger mt-1" style="font-size: 0.85rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Question 2: Rate the location -->
                </div>
                <div class="row p-4">
                    <div class="col-12">
                        <button class="btn px-4 btn-dark" wire:click.prevent="submitReview">Submit review</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <input type="hidden" value="{{ route('view-shop', ['uuid' => $this->user->uuid]) }}" id="businessLink">
</div>
@section('style')
    <style>
        /* Initially set the slider to be hidden off-screen on the right */
        .slider-form {
            position: fixed;
            top: 0;
            right: 0;
            /* Hide off-screen initially */
            width: 100%;
            height: 100%;
            background-color: #f8f9fa;
            transition: right 0.3s ease;
            z-index: 1050;
            box-shadow: -4px 0px 8px rgba(0, 0, 0, 0.2);
            overflow: scroll;
        }

        .slider-review-form {
            position: fixed;
            top: 0;
            right: 0;
            /* Hide off-screen initially */
            width: 100%;
            height: 100%;
            background-color: #f8f9fa;
            transition: right 0.3s ease;
            z-index: 1050;
            box-shadow: -4px 0px 8px rgba(0, 0, 0, 0.2);
            overflow: scroll;
        }

        .slider-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* dark semi-transparent overlay */
            z-index: 1049;
            /* just below the slider */
            display: none;
            /* hidden by default */
            /* transition: opacity 0.3s ease; */
        }

        .slider-overlay.open {
            display: block;
        }

        @media (min-width: 768px) {
            .slider-overlay {
                width: 25%;
                /* overlay only the non-slider portion on desktop */
            }
        }

        /* Show the slider when active (slide in from the right) */
        /* Form content styling */
        .slider-content {
            padding: 30px;
        }


        /* Adjust the width of the form based on screen size */
        @media (max-width: 767px) {

            .slider-form,
            .slider-review-form {
                width: 100%;
                /* Full width on small screens */
            }

            .carousel-fixed-image,
            .carousel-inner.ratio {
                height: 250px;
            }
        }

        @media (min-width: 768px) {

            .slider-form,
            .slider-review-form {
                width: 75%;
                /* 75% width on medium and larger screens */
            }
        }

        /* Square, rounded, black-filled radio buttons */
        .square-checkbox {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #000;
            /* White border */
            border-radius: 6px;
            /* Rounded square */
            background-color: #fff;
            /* Black background */
            cursor: pointer;
            position: relative;
            display: inline-block;
            vertical-align: middle;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .square-checkbox:checked {
            background-color: #000;
            /* Still black when checked */
            border-color: #fff;
            outline: 2px solid #000;
            /* Keep white border */
        }

        .square-checkbox:checked::after {
            content: '';
            display: none;
            /* No inner icon or tick */
        }

        .star-color {
            color: #22B14D;
            /* Gold color for filled stars */
        }

        .star-color-outer {
            color: #CCCCCC;
            /* Gray color for unfilled stars */
        }

        .carousel-fixed-image {
            height: 400px;
            object-fit: cover;
        }

        .carousel-inner.ratio {
            height: 400px;
            /* Ensures the wrapper doesn't stretch too much */
        }
    </style>
@endsection

<script>
    // Toggle slider form on button click
    // const openSliderBtn = document.getElementById("openSliderBtn");
    const sliderForm = document.querySelector(".slider-form");
    const closeSliderBtn = document.getElementById("closeSliderBtn");

    closeSliderBtn.addEventListener("click", function() {
        @this.set('showDetailSlider', false);
        @this.call('resetProduct')
    });

    document.addEventListener('click', function(event) {
        let target = event.target.closest('.view-product');
        if (target) {
            event.stopPropagation();
            let productId = target.getAttribute('data-id');

            @this.call('editProduct', productId).then(function() {
                @this.set('showDetailSlider', true);
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            @this.set('isLoaded', true);
        }, 500);

        setTimeout(() => {
            @this.set('showReviewForm', true);
        }, 15000);
    });



    function copyCurrentUrl() {
        const url = $('#businessLink').val();
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(url)
                .then(() => alert("URL copied!"))
                .catch(err => console.error("Failed to copy with clipboard API:", err));
        } else {
            // Fallback method for unsupported browsers
            const textarea = document.createElement("textarea");
            textarea.value = url;
            document.body.appendChild(textarea);
            textarea.select();
            try {
                document.execCommand("copy");
                alert("URL copied!");
            } catch (err) {
                console.error("Fallback copy failed", err);
            }
            document.body.removeChild(textarea);
        }
    }
</script>
