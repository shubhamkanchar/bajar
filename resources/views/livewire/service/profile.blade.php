<div>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                @if(auth()->user()->bg_image)
                    <img class="w-100 h-250" src="{{ asset('storage/'.auth()->user()->bg_image) }}">
                @else
                    <img class="w-100 h-250" src="{{ asset('assets/bg/bg_profile.png') }}">
                @endif
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-2 mb-3 position-relative" style="margin-top:-70px">
                        @if(auth()->user()->profile_image)
                            <img class="w-100 ms-md-4 h-100" src="{{ asset('storage/'.auth()->user()->profile_image) }}">
                        @else
                            <img class="w-100 ms-md-4 h-100" src="{{ asset('assets/image/profile.png') }}">
                        @endif
                    </div>
                    <div class="col-md-5 p-3">
                        <div class="d-lg-flex align-items-center ms-md-2">
                            <span class="fw-bold fs-4 m-2">{{$this->user->name}}</span>
                            <span class="badge text-bg-light fs-6"><span class="fw-light">GST Number : </span>
                                {{$this->user->gst}}</span>
                        </div>
                        <div class="ms-md-3 mt-2 d-flex">
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
                    <div class="col-md-5 p-3">
                        <div class="d-lg-flex float-md-end">
                            <span
                                class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-2 me-2">Premium</span>

                            <span
                                class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-light-emphasis bg-light-subtle border border-light-subtle rounded-2 me-2">
                                <svg class="me-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.9189 12.32C15.6599 12.571 15.5409 12.934 15.5999 13.29L16.4889 18.21C16.5639 18.627 16.3879 19.049 16.0389 19.29C15.6969 19.54 15.2419 19.57 14.8689 19.37L10.4399 17.06C10.2859 16.978 10.1149 16.934 9.93988 16.929H9.66888C9.57488 16.943 9.48288 16.973 9.39888 17.019L4.96888 19.34C4.74988 19.45 4.50188 19.489 4.25888 19.45C3.66688 19.338 3.27188 18.774 3.36888 18.179L4.25888 13.259C4.31788 12.9 4.19888 12.535 3.93988 12.28L0.328876 8.78C0.0268758 8.487 -0.0781242 8.047 0.0598758 7.65C0.193876 7.254 0.535876 6.965 0.948876 6.9L5.91888 6.179C6.29688 6.14 6.62888 5.91 6.79888 5.57L8.98888 1.08C9.04088 0.98 9.10788 0.888 9.18888 0.81L9.27888 0.74C9.32588 0.688 9.37988 0.645 9.43988 0.61L9.54888 0.57L9.71888 0.5H10.1399C10.5159 0.539 10.8469 0.764 11.0199 1.1L13.2389 5.57C13.3989 5.897 13.7099 6.124 14.0689 6.179L19.0389 6.9C19.4589 6.96 19.8099 7.25 19.9489 7.65C20.0799 8.051 19.9669 8.491 19.6589 8.78L15.9189 12.32Z"
                                        fill="#22B14D" />
                                </svg>
                                400
                            </span>

                            <span
                                class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-light-emphasis bg-light-subtle border border-light-subtle rounded-2 me-2">

                                <svg class="me-2" width="18" height="20" viewBox="0 0 18 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.7281 19.9137C8.83884 19.9715 8.96266 20.0009 9.08649 20C9.21032 19.999 9.33314 19.9686 9.44489 19.9097L13.0128 18.0025C14.0245 17.4631 14.8168 16.8601 15.435 16.1579C16.779 14.6282 17.5129 12.6758 17.4998 10.6626L17.4575 4.02198C17.4535 3.25711 16.9511 2.57461 16.2082 2.32652L9.57073 0.0995642C9.17106 -0.0357592 8.73313 -0.0328174 8.3405 0.106428L1.72824 2.41281C0.989299 2.67071 0.495998 3.35811 0.500024 4.12396L0.542307 10.7597C0.555395 12.7758 1.31448 14.7194 2.68062 16.2334C3.3048 16.9258 4.10415 17.52 5.12699 18.0505L8.7281 19.9137ZM7.78119 12.1106C7.93019 12.2538 8.12348 12.3244 8.31678 12.3225C8.51007 12.3215 8.70236 12.2489 8.84934 12.1038L12.7484 8.25981C13.0414 7.97053 13.0384 7.50572 12.7424 7.22037C12.4454 6.93501 11.9672 6.93697 11.6742 7.22625L8.3057 10.5466L6.92647 9.2208C6.62949 8.93545 6.15229 8.93839 5.85832 9.22767C5.56536 9.51694 5.56838 9.98175 5.86537 10.2671L7.78119 12.1106Z"
                                        fill="#4285F4" />
                                </svg>
                                10
                            </span>

                            <span
                                class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-light-emphasis bg-light-subtle border border-light-subtle rounded-2 me-2">

                                <svg class="me-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
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
                                {{$this->bussinessTime()}}
                            </span>
                        </div>
                        <div class="d-lg-flex justify-content-end align-items-end float-md-end" style="height:60%">
                            <a id="openReviewSliderBtn" class="btn bg-secondary-subtle me-2">

                                <svg class="me-2" width="18" height="20" viewBox="0 0 18 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.7281 19.9137C8.83884 19.9715 8.96266 20.0009 9.08649 20C9.21032 19.999 9.33314 19.9686 9.44489 19.9097L13.0128 18.0025C14.0245 17.4631 14.8168 16.8601 15.435 16.1579C16.779 14.6282 17.5129 12.6758 17.4998 10.6626L17.4575 4.02198C17.4535 3.25711 16.9511 2.57461 16.2082 2.32652L9.57073 0.0995642C9.17106 -0.0357592 8.73313 -0.0328174 8.3405 0.106428L1.72824 2.41281C0.989299 2.67071 0.495998 3.35811 0.500024 4.12396L0.542307 10.7597C0.555395 12.7758 1.31448 14.7194 2.68062 16.2334C3.3048 16.9258 4.10415 17.52 5.12699 18.0505L8.7281 19.9137ZM7.78119 12.1106C7.93019 12.2538 8.12348 12.3244 8.31678 12.3225C8.51007 12.3215 8.70236 12.2489 8.84934 12.1038L12.7484 8.25981C13.0414 7.97053 13.0384 7.50572 12.7424 7.22037C12.4454 6.93501 11.9672 6.93697 11.6742 7.22625L8.3057 10.5466L6.92647 9.2208C6.62949 8.93545 6.15229 8.93839 5.85832 9.22767C5.56536 9.51694 5.56838 9.98175 5.86537 10.2671L7.78119 12.1106Z"
                                        fill="black" />
                                </svg>
                                Expert Review
                            </a>
                            <a href="{{ route('business.edit', ['uuid' => auth()->user()->uuid ]) }}" class="btn btn-dark">
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
            <div class="col-md-9">
                <span class="badge rounded-pill {{$selectedCategory == 'all' ? 'text-bg-dark' : 'text-bg-light'}} fs-6 p-3 m-1" wire:click="changeCategory('all')"  role="button" tabindex="0">All</span>
                @foreach ($this->businessCategories as $cat)                    
                    <span class="badge rounded-pill {{$selectedCategory == $cat->id ? 'text-bg-dark' : 'text-bg-light'}}  fs-6 p-3 m-1"  role="button" tabindex="0" wire:click="changeCategory({{$cat->id}})">{{$cat->title}}</span>
                @endforeach
            </div>
            <div class="col-md-3">
                <div class="d-flex float-md-end mt-3">
                    <span class="text-end me-2">
                        <span class="d-block">Total work Added</span>
                        <span class="d-block">{{count($this->allServices) }}</span>
                    </span>
                    <button class="btn btn-default rounded-5 bg-custom-secondary">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M14.7369 2.75784H8.08489C6.00489 2.74984 4.30089 4.40684 4.25089 6.48684V17.2238C4.20589 19.3258 5.87389 21.0658 7.97489 21.1108C8.01189 21.1108 8.04889 21.1118 8.08489 21.1108H16.0729C18.1629 21.0368 19.8149 19.3148 19.8029 17.2238V8.03384L14.7369 2.75784Z"
                                stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14.4766 2.75V5.659C14.4766 7.079 15.6256 8.23 17.0456 8.234H19.7996"
                                stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11.6406 15.9472V9.90625" stroke="black" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.29688 13.5938L11.6419 15.9488L13.9869 13.5938" stroke="black"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                    </button>
                </div>
            </div>
            <div class="col-12 mt-3 service-list">
                @if(count($this->allServices) == 0)
                    <div class="row mb-2">
                        <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-12" class="openSlider">
                            <a id="openSliderBtn">
                                {{-- <img src="{{ asset('assets/image/add_product.png') }}"> --}}
                                <div class="dashed-border ratio ratio-add-product">
                                    <span class="text-center p-4" style="padding-top: 30% !important;">
                                        <i class="fa-regular fa-square-plus fs-1 text-secondary openSlider" role="button"></i>
                                        <div class="fs-5 fw-bold">Add Previous Work</div>
                                        <small>Adding more products improve your search rankings</small>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
                @foreach ($this->allServices as $categoryName => $services) 
                    <h6 class="fw-bold">{{$categoryName}}</h6> 
                    <div class="row mb-2">
                        <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-12">
                            <a id="openSliderBtn">
                                <div class="dashed-border ratio ratio-add-product">
                                    <span class="text-center p-4" style="padding-top: 30% !important;">
                                        <i class="fa-regular fa-square-plus fs-1 text-secondary openSlider" role="button"></i>
                                        <div class="fs-5 fw-bold">Add Previous Work</div>
                                        <small>Adding more products improve your search rankings</small>
                                    </span>
                                </div>
                            </a>
                        </div>   
                        @foreach ($services as $service)
                            <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-12">
                                <div class="border rounded position-relative">
                                    <div id="carouselService{{ $service->id }}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($service->images as $key => $serviceImage)
                                                <div class="carousel-item @if($key == 0) active @endif ratio ratio-4x3">
                                                    <img src="{{ asset('storage/' . $serviceImage->path) }}" class="d-block w-100" alt="Service Image">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselService{{ $service->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselService{{ $service->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                    <div class="ratio ratio ratio-16x9">
                                        <div class="p-2 fw-bold"> {{ $this->limitText($service->description) }}</div>
                                    </div>
                                    
                                    <a class="position-absolute top-0 end-0 p-2" style="z-index: 1">
                                        <i class="fa-regular fa-pen-to-square fs-5 text-secondary editService" data-id="{{ $service->id }}"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('livewire.service.partial.service-slider')
    @include('livewire.service.partial.review-slider')
</div>

@section('style')
    <style>
        /* Initially set the slider to be hidden off-screen on the right */
        .slider-form {
            position: fixed;
            top: 0;
            right: -100%;
            /* Hide off-screen initially */
            width: 100%;
            height: 100%;
            background-color: #f8f9fa;
            transition: right 0.3s ease;
            z-index: 1050;
            box-shadow: -4px 0px 8px rgba(0, 0, 0, 0.2);
            overflow: scroll;
        }

        /* Show the slider when active (slide in from the right) */
        .slider-form.open {
            right: 0;
        }

        /* Form content styling */
        .slider-content {
            padding: 30px;
        }

        /* Adjust the width of the form based on screen size */
        @media (max-width: 767px) {
            .slider-form {
                width: 100%;
                /* Full width on small screens */
            }
        }

        @media (min-width: 768px) {
            .slider-form {
                width: 75%;
                /* 75% width on medium and larger screens */
            }
        }
        .star-rating {
            font-size: 24px;
            cursor: pointer;
            color: #ccc;
        }
        
    </style>
@endsection
<script>
    // Toggle slider form on button click
    //product slider
    // const openSliderBtn = document.getElementById("openSliderBtn");
    const sliderForm = document.querySelector(".slider-form");
    const closeSliderBtn = document.getElementById("closeSliderBtn");

    document.querySelector(".service-list").addEventListener("click", function (event) {
        if (event.target.classList.contains("openSlider")) {
            sliderForm.classList.toggle("open");
        }
    });

    closeSliderBtn.addEventListener("click", function() {
        sliderForm.classList.remove("open");
        @this.call('resetService')
    });

    //review slider
    const openReviewSliderBtn = document.getElementById("openReviewSliderBtn");
    const reviewSliderForm = document.getElementById("reviewSlider");
    const closeReviewSliderBtn = document.getElementById("closeReviewSliderBtn");

    openReviewSliderBtn.addEventListener("click", function() {
        reviewSliderForm.classList.toggle("open");
    });

    closeReviewSliderBtn.addEventListener("click", function() {
        reviewSliderForm.classList.remove("open");
        @this.call('resetService');
    });

    const stars = document.querySelectorAll('.star-rating i');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            let value = this.getAttribute('data-value');
            // ratingValue.innerText = value;

            // Update star colors
            stars.forEach((s, index) => {
                if (index < value) {
                    s.classList.add('text-success');
                    // s.classList.remove('fa-star-o');
                } else {
                    // s.classList.add('fa-star-o');
                    s.classList.remove('text-success');
                }
            });
        });
    });

    document.addEventListener('click', function(event) {
        let target = event.target.closest('.editService'); 
        if (target) {
            event.stopPropagation();
            let serviceId = target.getAttribute('data-id');
            
            @this.call('editService', serviceId).then(function() {
                sliderForm.classList.toggle("open");
            });
        }
    });


    document.addEventListener('serviceUpdated', event => {
        Toastify({
            text: event.detail[0].message,
            duration: 3000,
            gravity: "top",
            position: "right",
            backgroundColor: event.detail[0].type === 'success' ? "green" : "black",
        }).showToast();

        sliderForm.classList.remove("open");
    });

    document.addEventListener('serviceDeleted', event => {
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
