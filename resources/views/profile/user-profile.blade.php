@extends('layouts.profile-layout')

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
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <!-- Banner Section -->
            <div class="col-12 mt-4 position-relative">
                @if ($user->bg_image)
                    <img class="w-100 h-250 object-fit-cover rounded-4"
                        src="{{ asset('storage/' . $user->bg_image) }}">
                @else
                    <picture>
                        <source media="(max-width: 767px)"
                            srcset="{{ asset('assets/image/mobile/banner_0' . rand(1, 8) . '.png') }}">
                        <img class="w-100 h-250 object-fit-cover rounded-4"
                            src="{{ asset('assets/image/desktop/banner_0' . rand(1, 8) . '.png') }}" alt="Banner">
                    </picture>
                @endif
            </div>

            <!-- Profile Info Section -->
            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-md-4 col-lg-3 col-xl-2 col-6 offset-3 offset-sm-0 position-relative"
                        style="margin-top:-70px">
                        @if ($user->profile_image)
                            <img class="ms-md-4 square-img-profile"
                                src="{{ asset('storage/' . $user->profile_image) }}">
                        @else
                            <img class="ms-md-4 square-img-profile"
                                src="{{ asset('assets/image/profile.png') }}">
                        @endif
                    </div>

                    <div class="col-md-5 p-3">
                        <div class="d-lg-flex align-items-center ms-md-2">
                            <span class="fw-bold fs-4 m-2">{{ $user->name }}</span>
                        </div>
                        <div class="ms-md-3 m-2">
                            Individual
                        </div>
                    </div>

                    <div class="col-md-5 p-3">
                        <div class="d-lg-flex justify-content-end align-items-end float-md-end">
                            <a href="{{ route('user.edit',['uuid' => $user->uuid]) }}" class="btn btn-dark">
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

            <!-- Tabs -->
            <div class="col-md-12">
                <button type="button" class="btn rounded-pill fs-6 py-2 px-3 m-1 tab-btn text-bg-dark" data-tab="product">
                    Product Wishlist
                </button>
                <button type="button" class="btn rounded-pill fs-6 py-2 px-3 m-1 tab-btn text-bg-light" data-tab="service">
                    Service Wishlist
                </button>
            </div>

            <!-- Content -->
            <div class="col-12 mt-3 mb-5">
                <!-- Product Tab -->
                <div class="row tab-content" id="tab-product">
                    @if ($products->count() > 0)
                        @foreach ($products as $product)
                            <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-12 mb-4" id="item-product-{{ $product->id }}">
                                <div class="border rounded product-card my-2">
                                    <i class="fa fa-trash text-danger remove-btn"
                                        onclick="removeFromWishlist({{ $product->id }}, 'product')"></i>
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

                <!-- Service Tab -->
                <div class="row tab-content d-none" id="tab-service">
                    @if ($services->count() > 0)
                        @foreach ($services as $service)
                            <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-12 mb-4" id="item-service-{{ $service->id }}">
                                <div class="border rounded service-card">
                                    <i class="fa fa-trash text-danger remove-btn"
                                        onclick="removeFromWishlist({{ $service->id }}, 'service')"></i>
                                    <div id="carouselService{{ $service->id }}"
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
                                            data-bs-target="#carouselService{{ $service->id }}"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselService{{ $service->id }}"
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
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('.tab-btn').click(function(){
            var tab = $(this).data('tab');
            $('.tab-btn').removeClass('text-bg-dark').addClass('text-bg-light');
            $(this).removeClass('text-bg-light').addClass('text-bg-dark');
            
            $('.tab-content').addClass('d-none');
            $('#tab-'+tab).removeClass('d-none');
        });
    });

    function removeFromWishlist(id, type) {
        if(!confirm('Are you sure you want to remove this from wishlist?')) return;
        
        $.ajax({
            url: "{{ route('wishlist.remove') }}",
            method: 'POST',
            data: {
                id: id,
                type: type,
                _token: "{{ csrf_token() }}"
            },
            success: function(resp) {
                if(resp.success) {
                    $('#item-'+type+'-'+id).remove();
                     Toastify({
                        text: resp.message,
                        duration: 3000,
                        close: true,
                        gravity: "top", 
                        position: "right", 
                        stopOnFocus: true, 
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        },
                    }).showToast();
                } else {
                    alert('Error: ' + resp.message);
                }
            },
            error: function() {
                alert('Something went wrong');
            }
        });
    }
</script>
@endpush
